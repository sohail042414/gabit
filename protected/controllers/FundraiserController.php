<?php
//set_time_limit(0);

class FundraiserController extends FrontCoreController
{

    public function actionTest_donation(){

        // echo "Herere"; exit;
        // $id = 610;
        // $donation = Donations::model()->findByPk($id);
        // $this->sendDonationEmail($donation);

    }

    /*
     * Action for common page template for all setup fundraiser
     */
    public function actionIndex($id)
    {
    
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/grid.css');

        $fundraiser = Fundraiser::model()->findByPk($id);

        if($fundraiser->status == 'N'){
            throw new CHttpException(404,'This request Cannot be processed, invalid token');
        }

        $slider_images = $fundraiser->getSliderImages();

        $title = $fundraiser->getTitleSlug();

        $fundraiserUri = "fundraiser/$id/$title/";

        $requestUri = Yii::app()->request->requestUri;

        $requestUri = ltrim($requestUri,'/index.php/');

        if($this->checkLogin()){

            $user_id = Yii::app()->frontUser->id;

            RewardPoints::model()->addPoints($fundraiser->id,'visit_fundraiser',0,$user_id);      

            $user = Users::model()->findByPk($user_id);
            $user->checkReferralCode();
            $user_slug = str_replace('-','_',$user->referral_code);

            $fundraiserUri = "fundraiser/$id/$title/$user_slug";

            if($requestUri != $fundraiserUri){
                $this->redirect(Yii::app()->createUrl($fundraiserUri));
            }
        }
        
        $fb_share_url = Yii::app()->createAbsoluteUrl($fundraiserUri);

        $case_updates = CaseUpdates::model()->findAll(array(
            'order'=>'id DESC', 
            'condition' => 'fundraiser_id = :fundraiser_id',
            'params' => array(
                'fundraiser_id'=>$fundraiser->id
            ),
            'limit' => 2,
        ));

        $total_case_updates = CaseUpdates::model()->count('fundraiser_id = :fundraiser_id',array('fundraiser_id'=>$fundraiser->id));
    
        $corporates = $fundraiser->corporates; 

        $this->render('index', array(
            //'fundraiser_object' => $fundraiser_object,
            //'fb_share_url' => $fb_share_url,
            'slider_images' => $slider_images,
            'case_updates' => $case_updates,
            'total_case_updates' => $total_case_updates,
            'fundraiser'=> $fundraiser,
            'supporters' => $fundraiser->supporters,
            'corporates' => $corporates,
            )
        );
    }

    public function actionReward_program(){

        
        if (!$this->checkLogin()) {
            $this->redirect(Yii::app()->createUrl('site/login'));
            Yii::app()->end();
        }

        $user_id = Yii::app()->frontUser->id;
        $fundraisers_list= Fundraiser::model()->findAll("user_id = $user_id ");

        $this->render('reward_program', array('fundraisers_list' => $fundraisers_list));

    }


    public function actionJoin_reward_program(){

        $fundraiser_id = $_POST['fundraiser'];
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);
        
        if(is_object($fundraiser)){
            $fundraiser->reward_program = 1;
            $fundraiser->update();
        }

    }



    public function actionLeave_reward_program(){

        $fundraiser_id = $_POST['fundraiser'];
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);
        
        if(is_object($fundraiser)){
            $fundraiser->reward_program = 0;
            $fundraiser->update();
        }

    }


    public function actionLoad_case_updates(){

        $data = [];
        $data['status'] = true;
        $data['html'] = '';

        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);
        
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);

        if(!is_object($fundraiser)){
            $data['status'] = false;
            echo json_encode($data);
            Yii::app()->end();
        }

        $total_case_updates = CaseUpdates::model()->count('fundraiser_id = :fundraiser_id',array('fundraiser_id'=>$fundraiser->id));

        $limit = 2;
        $page = Yii::app()->request->getParam('page',0);
        $offset = ($page - 1)  * $limit;

        $case_updates = CaseUpdates::model()->findAll(array(
            'order'=>'id DESC', 
            'condition' => 'fundraiser_id = :fundraiser_id',
            'params' => array(
                'fundraiser_id'=>$fundraiser->id,
            ),
            'limit' => $limit,
            'offset' => $offset 
        ));

        if(empty($case_updates)){
            $data['status'] = false;
            echo json_encode($data);
            Yii::app()->end();
        }

        $data['html'] =  $this->renderPartial('/fundraiser/_case_updates',array(
            'case_updates' => $case_updates,
        ),true,true);  

        $data['offset'] = $offset;

        echo json_encode($data);
        Yii::app()->end();

    }
    
    /*
     * Action for add donation data of the specific fundraiser
     */
    public function actionDonations($id)
    {
     
        $this->layout = 'main_popup';
        //$model = new Donations();
        $model = new Transactions();
        $model->transaction_amount = '';
        $model->age = null;
        $model->sex = null;

        $fundraiser = Fundraiser::model()->findByPk($id);

        if (isset($_POST['Transactions'])) {

            $trans_ref = base64_encode("giveyourbit".time()).time();
            $_POST['Transactions']['donor_phone_no']="+".$_POST['Transactions']['country_code']." ".$_POST['Transactions']['donor_phone_no'];            
            $model->setAttributes($_POST['Transactions']);   

            if($this->checkLogin()){
                $model->user_id  = Yii::app()->frontUser->id;
            }else{
                $donor_user = Users::model()->find('email = :email',array('email' => $model->donor_email));
                if(is_object($donor_user)){
                    $model->user_id = $donor_user->id;          
                }
            }

            if($_POST['Transactions']['checked_bx'] == 1 || empty($_POST['Transactions']['donor_name'])){
                $model->donor_name = 'Anonymous';                
            }

            $model->donor_message = '--';
            $model->status = 'N';
            $model->trans_ref = $trans_ref;
            $model->fundraiser_id = $id;

            $payment_mode = 'live';

            //make sure if there is no setting, payment mode should always be live. 
            $setting = Yii::app()->params['flutterwave_settings']['mode'];
            if($setting == 'test'){
                $payment_mode = 'test';
            }

            $model->payment_mode = $payment_mode;
            $model->save();

            if($model->signup_check ==1){
                
                $user = Users::model()->find('email = :email',array(
                    'email' => $model->donor_email
                ));

                if(is_object($user)){

                    $identity = new UserIdentity($user->username, $user->password);
                    $identity->directLogin();

                }else{

                    $token = time()."gabit".time();
                    $user = new Users();
                    $user->user_type = 1;
                    $user->role = 'donor';
                    $user->email = $model->donor_email;
                    $user->username = $model->donor_name;
                    $user->age = $model->age;
                    $user->sex = $model->sex;
                    $user->agree_to_terms = 1;
                    $user->password = Yii::app()->params['default_password'];
                    $user->confirm_password = Yii::app()->params['default_password'];
                    $user->status = 'Y';
                    $user->status_new = 'Y';
                    $user->email_verification = 'N';
                    $user->user_token = urlencode($token);

                    if($user->save()){
                        $identity = new UserIdentity($user->username, $user->password);
                        $identity->directLogin(true);
                    }
                }

                //associate donation to user. 
                if(is_object($user)){
                    $model->user_id = $user->id;
                    $model->save(FALSE);

                    if(!empty($model->referral_code)){

                        $ref_user = Users::model()->findByReferralCode($model->referral_code);
                        
                        if(is_object($ref_user) && ($ref_user->id != $model->user_id)){
                            $user->referrer_id = $ref_user->id;
                            $user->save(FALSE);
                            $rewardModel = new RewardPoints();
                            $rewardModel->addPoints($model->fundraiser_id,'referral_code_entry',$model->transaction_amount,$ref_user->id);
                        }
                    }

                }


            }

            $this->redirect(array('payment',  
                    'trans_ref' => $trans_ref
                )
            );

            // to test without going to payment gateway. 
            
            // $this->redirect(array('complete_flutterwave_payment',  
            //         'tx_ref' => $trans_ref
            //     )
            // );

        }
        
        $this->render('donations', array(
            'model' => $model, 
            'fundraiser' => $fundraiser, 
            'fundraiser_name' => $_REQUEST['fundraiser_name'],
            'trans_ref' => $trans_ref,
        ));

    }

    /*
     * Options how user wants to donate.
     * This method has been skipped. 
     * Left here , as USSD payment may be required in future. 
     */
    public function actionOptions()
    {
        /*
        $this->layout = 'main_popup';        
        $trans_ref = $_REQUEST['trans_ref'];

        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        $payment_url = Yii::app()->createUrl('fundraiser/payment',array('trans_ref' => $trans_ref));
        $uss_form_action = Yii::app()->createUrl('fundraiser/completeussd',array('trans_ref' => $trans_ref));

        $show_amount = number_format($transaction->transaction_amount,0,'','');
        $merchant_code = '10578';
        $donation_messag = DonationMessage::model()->find(array('select' => 'messge'));
        $message_html = $donation_messag->messge;
        $message_html = str_replace('{donation_amount}',$show_amount,$message_html);
        $message_html = str_replace('{merchant_code}',$merchant_code,$message_html);

        $this->render('options', array(
                'transaction' => $transaction,
                'fundraiser_id' => $transaction->fundraiser_id,                 
                'payment_url' => $payment_url,
                'message_html' => $message_html,
                'uss_form_action' => $uss_form_action
            )
        );
        */
    }

    /*
     * Payment Gateway Interswitch
     */
    public function actionPayment()
    {

        $this->layout = 'main_popup';

        $trans_ref = $_REQUEST['trans_ref'];

        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        /*
        $interswitch_return_url = Yii::app()->createAbsoluteUrl('fundraiser/complete_interswitch_payment');
        $settings = Yii::app()->params['interswitch_settings'];
        
        if($settings['mode'] =='live'){
            $interswitch_settings = $settings['live'];
        }else{
            $interswitch_settings = $settings['test'];
        }
        */

        $flutterwave_return_url = Yii::app()->createAbsoluteUrl('fundraiser/complete_flutterwave_payment');
        $settings = Yii::app()->params['flutterwave_settings'];

        if($settings['mode'] =='live'){
            $flutterwave_settings = $settings['live'];
        }else{
            $flutterwave_settings = $settings['test'];
        }

        $this->render('payment-flutterwave', array(
            'transaction' => $transaction, 
            //'interswitch_return_url' => $interswitch_return_url,
            //'interswitch_settings' => $interswitch_settings,
            'flutterwave_settings' => $flutterwave_settings,
            'flutterwave_return_url' => $flutterwave_return_url        
        ));
    }

    public function actionComplete_flutterwave_payment()
    { 

        /**
         * On successfully return $_REQUEST has this data. 
         * Array
        (
            [status] => successful
            [tx_ref] => Z2l2ZXlvdXJiaXQxNjk0OTc0Njgx1694974681
            [transaction_id] => 4603016
        )
         * 
         *  On successfully return $_REQUEST has this data. 
         * Array
            (
                [status] => cancelled
                [tx_ref] => Z2l2ZXlvdXJiaXQxNjk0OTc0Nzg31694974787
            )
         */

        $payment_status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

        $status = 'success';

        $message = '';

        $trans_ref = $_REQUEST['tx_ref'];

        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        if(is_object($transaction)){

            $payment_response = json_encode($_REQUEST);
            $transaction->payment_response = $payment_response;
            $transaction->save(false);

            if(($payment_status =='successful' || $payment_status == 'completed')){

                $existing = Donations::model()->find('trans_ref = :trans_ref',array(
                    'trans_ref' => $trans_ref
                ));            
                
                if(!is_object($existing)){

                    $donation = new Donations();
                    $donation->fundraiser_id = $transaction->fundraiser_id;
                    $donation->transaction_amount = $transaction->transaction_amount;
                    $donation->interswitch_fee = $transaction->interswitch_fee;
                    $donation->giveyourbit_fee = $transaction->giveyourbit_fee;                
                    $donation->donation_amount = $transaction->donation_amount;
                    $donation->donor_name = $transaction->donor_name;
                    $donation->donor_email = $transaction->donor_email;
                    $donation->donor_phone_no = $transaction->donor_phone_no; 
                    $donation->donor_message = $transaction->donor_message;
                    $donation->user_id = $transaction->user_id;
                    $donation->sex = $transaction->sex;
                    $donation->age = $transaction->age;
                    $donation->status = 'Y';
                    $donation->status_new = 'Y';
                    $donation->payment_type = 'card';   
                    $donation->trans_ref = $transaction->trans_ref;
                    $donation->reward_program = $transaction->reward_program;
                    $donation->referral_code = $transaction->referral_code;
                    $donation->payment_mode = $transaction->payment_mode;
                    $donation->processed_by = 'redirct';
                    $donation->save(false);
                    
                    $rewardModel = new RewardPoints();

                    $rewardModel->addPoints($transaction->fundraiser_id,'donation',$donation->transaction_amount,$donation->user_id);

                    //This is the case when a user makes a donation, i.e logged in user. this user was a referral, 
                    //now the referrer user gets poinnts. 
                    if(!empty($donation->user_id)){
                                        
                        $donor_user = Users::model()->findByPk($donation->user_id);

                        if(is_object($donor_user)){

                            if(!empty($donor_user->referrer_id)){

                                $ref_user = Users::model()->findByPk($donor_user->referrer_id);

                                if(is_object($ref_user) && ($ref_user->id != $donation->user_id)){
                                    $rewardModel->addPoints($transaction->fundraiser_id,'referral_donation',$donation->transaction_amount,$ref_user->id);
                                }
                            }
                        }
                    }else if(!empty($donation->referral_code)){
                        $ref_user = Users::model()->findByReferralCode($donation->referral_code);                    
                        //1 entry for referral donation. 
                        if(is_object($ref_user) && ($ref_user->id != $donation->user_id)){
                            $rewardModel->addPoints($transaction->fundraiser_id, 'referral_donation', $donation->transaction_amount, $ref_user->id);
                        }
                    }

                    if(!empty($donation->referral_code) && empty($transaction->signup_check)){

                        $ref_user = Users::model()->findByReferralCode($donation->referral_code);
                        //1 entry for referral code entry , when there is no signup check. the case of signup check is already covered.
                        if(is_object($ref_user) && ($ref_user->id != $donation->user_id)){
                            $rewardModel->addPoints($transaction->fundraiser_id,'referral_code_entry',$donation->transaction_amount,$ref_user->id);
                        }
                    }

                    $message = 'Transaction is successfully done';

                    $this->sendDonationEmail($donation);

                }else{
                    $message = 'Trransactio ID already exists!';
                    $status = 'error';
                }

            }else{
                $message = 'Transaction Failed Or Canceled By User , Status: '.$_REQUEST['status'];
                $status = 'error';
            }
            
        }else{
            $message = 'No Transaction Found with trans ref :'.$trans_ref;
            $status = 'error';
        }

        $fundraiser = SetupFundraiser::model()->findByPK($donation->fundraiser_id);

        $this->layout = 'main_popup';

        $this->render('complete_ussd',array(
            'transaction' => $transaction,
            'fundraiser'=> $fundraiser,
            'message' => $message,
            'status' => $status
        ));    
        
    }

    private function donorSignupEmail($model){

        $email_model = EmailTemplates::model()->find("short_code = 'donor_account_activate'");

        $email_template = $email_model->template;
        $email_template = str_replace('#USRFULLNAME#', ucfirst($model->username), $email_template);
        
        $link = Yii::app()->createAbsoluteUrl('account/activate', array('token' => $model->user_token));
        $email_template = str_replace('#ACTIVATE_ACCOUNT_LINK#', $link, $email_template);

        $mail = new PHPMailer(true);

        try {

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'giveyourbit.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            //$mail->Username   = 'information@giveyourbit.com';                     //SMTP username
            //$mail->Password   = 'MPrRhUC2ORB4';             
            $mail->Username   = 'donotreply@giveyourbit.com';                     //SMTP username
            $mail->Password   = 'b7pqzaX9nUNg'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //From Email Address
            $mail->setFrom('donotreply@giveyourbit.com', 'Giveyoubit');
            //Recepients            
            //$mail->addAddress('daja@dajed.com', 'DJ Akporero');  
            $mail->addAddress($model->email, $model->username);  
            //$mail->addReplyTo('info@giveyourbit.com', 'Giveyourbit');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            //$mail->Subject = 'This is test Email';
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->Subject = $email_model->subject;

            $mail->Body = $email_template;
            $mail->AltBody = $email_template;

            $mail->send();
            //echo 'Message has been sent';
        } catch (\Exception $e) {
            // echo '<pre>';
            // print_r($e);
            // exit; 
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    
    /**
     * This action is responsible for handing updates on payments using trans_ref.
     * Do not change this url, it has been set as hook on fultterwave. 
     * $hook_url = 'https://giveyourbit.com/index.php/fundraiser/flutterwave_hook';
     * Expected post payload is. 
     * {
  "event": "charge.completed",
  "data": {
    "id": 285959875,
    "tx_ref": "Z2l2ZXlvdXJiaXQxNjk0NTUxMjEx1694551211",
    "flw_ref": "PeterEkene/FLW270177170",
    "device_fingerprint": "a42937f4a73ce8bb8b8df14e63a2df31",
    "amount": 100,
    "currency": "NGN",
    "charged_amount": 100,
    "app_fee": 1.4,
    "merchant_fee": 0,
    "processor_response": "Approved by Financial Institution",
    "auth_model": "PIN",
    "ip": "197.210.64.96",
    "narration": "CARD Transaction ",
    "status": "successful",
    "payment_type": "card",
    "created_at": "2020-07-06T19:17:04.000Z",
    "account_id": 17321,
    "customer": {
      "id": 215604089,
      "name": "Yemi Desola",
      "phone_number": null,
      "email": "user@gmail.com",
      "created_at": "2020-07-06T19:17:04.000Z"
    },
    "card": {
      "first_6digits": "123456",
      "last_4digits": "7889",
      "issuer": "VERVE FIRST CITY MONUMENT BANK PLC",
      "country": "NG",
      "type": "VERVE",
      "expiry": "02/23"
    }
  }
}
     */
    public function actionFlutterwave_hook()
    { 

        //$secret_hash = 'asdfasdfasdalsj_23423ljasld';
        $secret_hash = 'asdfasdfasdalsj_23423ljasld_2034';

        $headers = apache_request_headers();

        $post = file_get_contents('php://input');

        $post_data = json_decode($post,true);

        $this->sendHookLogEmail($post_data);

        $verify_hash = isset($headers['verif-hash']) ? $headers['verif-hash'] : '';
        
        if(empty($verify_hash) || $verify_hash != $secret_hash){ 
            http_response_code(400);
            exit;  
        }

        $status_code = 200;

        $message = '';

        $trans_ref = isset($post_data['data']['tx_ref']) ? $post_data['data']['tx_ref'] : '';
        //$trans_ref = isset($post_data['txRef']) ? $post_data['txRef'] : '';


        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        //if(is_object($transaction) && $post_data['status'] == 'successful'){
        if(is_object($transaction) && $post_data['data']['status'] == 'successful'){

            $transaction->payment_response = $post_data;
            $transaction->processed_by = 'hook';
            $transaction->status = 'Y';
            $transaction->save(false);

            /*
            $payment_type = '';
            if($post_data['event.type'] == 'USSD_TRANSACTION'){
                $payment_type = 'ussd';
            }else if($post_data['event.type'] == 'BANK_TRANSFER_TRANSACTION'){
                $payment_type = 'bank transfer';
            }else if($post_data['event.type'] == 'CARD_TRANSACTION'){
                $payment_type = 'card';
            }else if($post_data['event.type'] == 'ACCOUNT_TRANSACTION'){
                $payment_type = 'bank account';
            }
            */

            $payment_type = $post_data['data']['payment_type'];


            $existing = Donations::model()->find('trans_ref = :trans_ref',array(
                'trans_ref' => $trans_ref
            ));            

            if(is_object($existing)){  
                
                if(!empty($payment_type)){
                    $existing->payment_type = $payment_type;
                    $existing->update();
                }

                $message = 'Transaction already processed!';
                $status_code = 200;

            }else{

                $donation = new Donations();
                $donation->fundraiser_id = $transaction->fundraiser_id;
                $donation->transaction_amount = $transaction->transaction_amount;
                $donation->interswitch_fee = $transaction->interswitch_fee;
                $donation->giveyourbit_fee = $transaction->giveyourbit_fee;                
                $donation->donation_amount = $transaction->donation_amount;
                $donation->donor_name = $transaction->donor_name;
                $donation->donor_email = $transaction->donor_email;
                $donation->donor_phone_no = $transaction->donor_phone_no; 
                $donation->donor_message = $transaction->donor_message;
                $donation->user_id = $transaction->user_id;
                $donation->sex = $transaction->sex;
                $donation->age = $transaction->age;
                $donation->status = 'Y';
                $donation->status_new = 'Y';
                $donation->payment_type = $payment_type;   
                $donation->trans_ref = $transaction->trans_ref;

                $donation->reward_program = $transaction->reward_program;
                $donation->referral_code = $transaction->referral_code;
                $donation->payment_mode = $transaction->payment_mode;
                $donation->processed_by = 'hook';
                $donation->save(false);

                $rewardModel = new RewardPoints();
                $rewardModel->addPoints($transaction->fundraiser_id,'donation',$transaction->donation_amount,$donation->user_id);                    

                //$this->sendDonationEmail($donation);
                $status_code = 200;

                $message = 'Transaction processed successfully!';

            }


        }else{
            $message = 'Transaction Not found , trans ref : '.$trans_ref;
            $status_code = 400;
        }

        echo $message;

        http_response_code($status_code);
        exit;  

        
    }

    public function sendHookLogEmail($data){


        $email = 'sohail042414@gmail.com';
        $email2 = 'rollouttech@dajed.com';
        // $emails = array();
        // $emails['sohail042414@gmail.com'] = 'Sohail Maroof';
        // $emails['rollouttech@dajed.com'] = 'Daj Akperaro';
                
        $subject = 'Hook Response Log';
        $output = "<pre><br>".print_r($data,1);
        $this->send_email($email,$subject,$output);
        $this->send_email($email2,$subject,$output);
    }

    public function actionComplete_transaction()
    { 
       
        $message = '';

        $trans_ref = isset($_GET['trans_ref']) ? $_GET['trans_ref'] : '------------';

        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        if(is_object($transaction)){

            $payment_response = json_encode($_REQUEST);
            $transaction->payment_response = 'done';
            $transaction->status = 'Y';
            $transaction->save(false);

            $existing = Donations::model()->find('trans_ref = :trans_ref',array(
                'trans_ref' => $trans_ref
            ));            
            
            if(!is_object($existing)){

                $donation = new Donations();
                $donation->fundraiser_id = $transaction->fundraiser_id;
                $donation->transaction_amount = $transaction->transaction_amount;
                $donation->interswitch_fee = $transaction->interswitch_fee;
                $donation->giveyourbit_fee = $transaction->giveyourbit_fee;                
                $donation->donation_amount = $transaction->donation_amount;
                $donation->donor_name = $transaction->donor_name;
                $donation->donor_email = $transaction->donor_email;
                $donation->donor_phone_no = $transaction->donor_phone_no; 
                $donation->donor_message = $transaction->donor_message;
                $donation->user_id = $transaction->user_id;
                $donation->status = 'Y';
                $donation->payment_type = 'flutterwave';   
                $donation->trans_ref = $transaction->trans_ref;
                $donation->save(false);

                $message = 'Transaction is successfully processed';

            }else{
                $message = 'Transaction Already processed';
            }

        }else{
            $message = 'Transaction Not found : '.$trans_ref;
        }

        echo "Message is : ".$message; 
        exit;
        
    }



    public function actionComplete_interswitch_payment()
    { 
       
        /**
         * Below is the sample response from interswtich server. 
         * Array
            (
                [payRef] => GTB|WEB|MX70046|26-01-2022|3585916|282095
                [txnref] => Z2l2ZXlvdXJiaXRfXzE2NDMyMDAzNjE=
                [amount] => 109000
                [apprAmt] => 109000
                [resp] => 00
                [desc] => Approved by Financial Institution
                [retRef] => 000106923853
                [cardNum] => 
                [mac] => 
            )
         * 
         */
  
        $trans_ref = $_REQUEST['txnref'];

        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        if(is_object($transaction)){

            $payment_response = json_encode($_REQUEST);
            $transaction->payment_response = $payment_response;
            $transaction->save(false);

            $existing = Donations::model()->find('trans_ref = :trans_ref',array(
                'trans_ref' => $trans_ref
            ));            
            
            if(!is_object($existing) && isset($_REQUEST['amount']) && isset($_REQUEST['apprAmt'])){
                $donation = new Donations();
                $donation->fundraiser_id = $transaction->fundraiser_id;
                $donation->transaction_amount = $transaction->transaction_amount;
                $donation->interswitch_fee = $transaction->interswitch_fee;
                $donation->giveyourbit_fee = $transaction->giveyourbit_fee;                
                $donation->donation_amount = $transaction->donation_amount;
                $donation->donor_name = $transaction->donor_name;
                $donation->donor_email = $transaction->donor_email;
                $donation->donor_phone_no = $transaction->donor_phone_no; 
                $donation->donor_message = $transaction->donor_message;
                $donation->user_id = $transaction->user_id;
                $donation->status = 'Y';
                $donation->payment_type = 'card';   
                $donation->trans_ref = $transaction->trans_ref;
                $donation->save();
            }

            //$this->sendDonationEmail();
        }

        $fundraiser = SetupFundraiser::model()->findByPK($donation->fundraiser_id);

        $this->layout = 'main_popup';

        // $this->render('complete_payment',array(
        //     'donation' => $transaction,
        //     'fundraiser'=> $fundraiser
        // ));   

        $this->render('complete_ussd',array(
            'donation' => $transaction,
            'fundraiser'=> $fundraiser
        ));    
        
    }

    public function actionCompleteUssd()
    { 
        $trans_ref = $_REQUEST['trans_ref'];

        $transaction = Transactions::model()->find('trans_ref = :trans_ref',array(
            'trans_ref' => $trans_ref
        ));

        if(is_object($transaction)){

            $existing = Donations::model()->find('trans_ref = :trans_ref',array(
                'trans_ref' => $trans_ref
            ));   

            if(!is_object($existing)){

                $donation = new Donations();
                $donation->fundraiser_id = $transaction->fundraiser_id;
                $donation->user_id = $transaction->user_id;
                $donation->trans_ref = $transaction->trans_ref;
                $donation->donor_message = $transaction->donor_message;
                $donation->donation_amount = $transaction->donation_amount;
                $donation->transaction_amount = $transaction->transaction_amount;
                $donation->donor_name = $transaction->donor_name;
                $donation->donor_email = $transaction->donor_email;
                $donation->donor_phone_no = $transaction->donor_phone_no; 
                $donation->payment_type = 'ussd';   
                $donation->status = 'Y';
                $donation->save();

                $this->sendDonationEmail($donation);
            }
        }

        $fundraiser = SetupFundraiser::model()->findByPK($transaction->fundraiser_id);

        $message = 'Transaction is successfully done';
        $status = 'success';

        $this->layout = 'main_popup';

        $this->render('complete_ussd',array(
            'transaction' => $transaction,
            'fundraiser'=> $fundraiser,
            'message' => $message,
            'status' => $status
        ));    
        
    }


    private function sendDonationEmail($donation){

        $email_model = EmailTemplates::model()->find("short_code = 'donation_confirmation'");
        
        $reward_url = Yii::app()->createAbsoluteUrl('rewards');
        $reward_link = CHtml::link('HERE',$reward_url);
        
        $email_template = $email_model->template;
        $email_template = str_replace('#USSERNAME#', ucfirst($donation->donor_name), $email_template);
        $email_template = str_replace('#REWARD_LINK#', $reward_link, $email_template);

        $this->send_email($donation->donor_email, $email_model->subject, $email_template);

    }


    public function actionCase_video(){

        $this->layout = 'main_popup';

        $case_id = Yii::app()->request->getParam('case_id',0);

        $case_update = CaseUpdates::model()->findByPK($case_id);
        
        if($this->checkLogin()){
            $user_id = Yii::app()->frontUser->id;
            RewardPoints::model()->addPoints($case_update->fundraiser_id,'view_case_update',0,$user_id);        
        }

        $video_url = $case_update->video;

        if (strpos($video_url, 'youtu.be') == true) {
            //Sample URL is below
            //https://youtu.be/MJOFUdXomN4

            $pos = strpos($video_url,'youtu.be');

            if($pos){
                $video_string = substr($video_url,($pos+9));
                $video_url = 'https://www.youtube.com/embed/'.$video_string;
            }
        } else if (strpos($video_url, 'watch') == true) {
            //Sample URL is below.
            //https://www.youtube.com/watch?v=cxp5IrEkS1k
            $pos = strpos($video_url,'?v=');
            if($pos){
                $video_string = substr($video_url,($pos+3));
                $video_url = 'https://www.youtube.com/embed/'.$video_string;
            }

        }else if (strpos($video_url, 'shorts') == true) {
            //Sample URL is below
            //https://www.youtube.com/shorts/NB5a3YKc1rI
            $pos = strpos($video_url,'shorts');

            if($pos){
                $video_string = substr($video_url,($pos+7));
                $video_url = 'https://www.youtube.com/embed/'.$video_string;
            }
        }

        $this->render('case_video',array(
            'video_url' => $video_url,
            'case_update' => $case_update,
        ));    
    }

    public function actionCase_docs(){

        $this->layout = 'main_popup';

        $case_id = Yii::app()->request->getParam('case_id',0);
        $case_update = CaseUpdates::model()->findByPK($case_id);
        
        // echo 'Herer<br>'.__FILE__;
        // echo '<br>'.__LINE__;
        // echo '<pre>';
        // print_r($case_update);
        // exit; 

        RewardPoints::model()->addPoints($case_update->fundraiser,'view_case_update');

        $this->render('case_docs',array(
            'case_update' => $case_update,
        ));    
    }



    public function actionResponsemessage()
    { 

        $phn = $_REQUEST['phone_no'] ;
        $this->layout = 'main_popup';
        if($_REQUEST['txnref']==""){
            //pass all data to view here. 
            //REquest contains all this. 
            /**
             * Array
            (
                [id_value] => 427
                [phone_no] => +234 5454
                [fundraiser_id] => 14
                [donation_amount] => 1000
                [donor_email_address] => kamal@gmail.com
                [donor_name] => Kamal
                [user_id] => 0
                [country_code] => 
                [donation_titl] => Kidney and pancreas transplant
            ) */           
             



            $this->render('response_message');
        } else {  
            $tl_mm = $_REQUEST['amount']/100;
            $data_amunt = ($_REQUEST['amount']-(5*$_REQUEST['amount']/100))/100;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
        // $to = "neha@infobot-technologies.com";
            $to = $_SESSION['front_email']; 
            $subject = "Your Donation Receipt";
            $message = '<div class="content-box" style="max-width:700px; display:block; overflow:hidden; margin:0 auto; border:1px solid #000; padding:10px 10px;">
            <section class="row-section" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div class="left-part" style="float:left;">
            <h3 style="font-size:16px; margin:0;">Transaction No. ' . $_REQUEST['txnref'] .  '</h3>
            </div>

            <div class="right-part" style="float:right;">
            <p style="margin:0; line-height: 22px;"><span>Print Receipt</span><br>
            Giveyourbit.com<br>
            VAT: 29766547</p>
            </div>

            </section>

            <section class="row-section rs2" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
            <li><strong>Billed to:</strong> Name:' .$_SESSION['front_username'].'</li>
            <li>Email:'. $_SESSION['front_email'].'</li>
            <li>Phone No.:'. $phn.'</li>
            </ul>
            </div>

            <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
            <li style="padding-left:37px;"><strong>Date:</strong></li>
            <li style="padding-left:37px;"><strong>Transaction Total:</strong></li>
            <li style="padding-left:37px;"><strong>Receipt #:</strong></li>
            </ul>
            </div>

            <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
            <li style="text-align:right;">05/06/2017</li>
            <li style="text-align:right;"><span>&#8358</span>'.$tl_mm .' NGN</li>
            <li style="text-align:right;">'.$_REQUEST['retRef'].'</li>
            </ul>
            </div>
            </section>

            <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div class="left-part" style="float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding:0;">
            <li style="display:inline-block; border-right:2px solid #CCC; padding:10px 10px;">Item</li>
            <li style="display:inline-block; padding:10px 10px;">Description</li>
            </ul>
            </div>

            <div class="right-part" style="float:right;">
            <ul style="display:block; overflow:hidden; list-style:none; padding:0;">
            <li style="border-left:2px solid #CCC; padding:10px 10px;">Amount</li>
            </ul>
            </div>

            </section>

            <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div class="left-part" style="float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding:0;">
            <li style="display:inline-block; padding:10px 20px;">1</li>
            <li style="display:inline-block; padding:10px 10px;">Donation to Save Joe from Cancer Fundraiser</li>
            </ul>
            </div>

            <div class="right-part" style="float:right;">
            <p style="text-align:right"><span>&#8358</span>'. $data_amunt. 'NGN<br>
            +5% VAT</p>
            </div>

            </section>

            <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; padding: 5px 0 15px 0;">


            <div class="right-part" style="float:right; width:50%">
            <ul style="list-style:none; display:block; overflow:hidden; padding-left:0;">
            <li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
            <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Transaction Total:</p>
            <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span>'.$tl_mm.' NGN</p>
            </li>
            <li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
            <p style="float:left; margin:0; font-size:13px;">Payment:</p>
            <p style="float:right; margin:0; color:#F00; font-size:13px;">(US$'. $tl_mm.')</p>
            </li>
            <li style="display:block; overflow:hidden; padding-bottom:5px;">
            <p style="float:left; margin:0; font-weight:bold; font-size:13px;">VAT:</p>
            <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span>'. (5*$_REQUEST['amount']/100)/100 .' NGN</p>
            </li>
            </ul>
            </div>

            </section>

            </div>';
            $form = "giveyourbit.com";
            mail($to, $subject, $message, $headers, $from ); 
            $this->render('response_message');    
        }
    }

     public function actionResponsemessagepayment()
        {
        //$current_donner_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;  
            $this->layout = 'main_popup';
        // $this->render('responsemessagepayment', array('id_value_b' => $_REQUEST['id_value_a'], 'phone_no_a'=> $_REQUEST['phone_no_a'], 'fundraiser_id_b'=> $_REQUEST['fundraiser_id_a'], 'donation_amount_b'=> $_REQUEST['donation_amount_a'], 'donor_email_address_b'=> $_REQUEST['donor_email_address_a'], 'donor_name_b'=> $_REQUEST['donor_name_a'], 'user_id_b'=> $_REQUEST['user_id_a'], 'country_code_b'=> $_REQUEST['country_code_a']));
            $this->render('responsemessagepayment');
        }

    /*
     * Action for find fundraiser based on a fundraiser type
     */
    public function actionFindfundraiser()
    {
        if (!empty($_REQUEST['fundraiser_id'])) {
            $getcount = 0;

            if($_REQUEST['fundraiser_id'] == 'all'){
                $featured_fundraiser = Fundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND status = \'Y\' ','order' => 'fundr_timeline_to DESC'));
            }else{
                $featured_fundraiser = Fundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND status = \'Y\' AND ftype_id = "' . $_REQUEST['fundraiser_id'] . '" AND status = "Y" ','order' => 'fundr_timeline_to DESC'));
            }

            $temp = '';

            foreach ($featured_fundraiser as $fundraiser) {

                $temp .= '<a href=' . $fundraiser->getURL() . '>
                        <div class="slide">
                            <h4 class="teg-h4">' . $fundraiser->getTypeName() . '</h4>

                            <div class="section-img"><img style="height:221px;"
                                    src=' . $fundraiser->getImageURL() . '></div>
                            <h4 class="teg1-h4 teg1-color">' . $fundraiser->getGoalAmount(). '</h4>

                            <div class="slider-bottom-img ">
                                <div class="percent_line" style="width:' . $fundraiser->getDonationPercentage() . '"></div>
                            </div>
                            <div class="parsen">
                                <p class="left-teg">' . $fundraiser->getDonationPercentage() . '</p>

                                <p class="right-teg"> ' .$fundraiser->getDaysLeft() . '
                            </div>
                            <h4 class="teg1-h4 teg4-h4">Case No. ' . $fundraiser->id . '<br>' . $fundraiser->fundraiser_title . '</h4>
                        </div>
                    </a>';
            }
            
            $temp .= '###' . $getcount;
            echo $temp;

        }
    }

    /*
     * Action for the comment of the specific fundraiser
     */
    public function actionFundraiserComment($id)
    {
        $this->layout = 'main_popup';
        $model = new FundraiserComment();
        if (isset($_POST['FundraiserComment'])) {
            $model->setAttributes($_POST['FundraiserComment']);
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                    $this->redirect(array('CommentMessage'));
                }
            }
        }
        $this->render('fundraiser_comment', array('model' => $model, 'fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name']));
    }

    /*
     * Action for response message of the comment of fundraiser
     */
    public function actionCommentMessage()
    {
        $this->layout = 'main_popup';
        $this->render('comment_message');
    }

    /*
     * Action for latest comment of the fundraiser
     */
    public function actionFundraiserViewComment()
    {
        if (!empty($_POST['fundraiser_id'])) {
            $latest_comment = FundraiserComment::model()->findAll(array('select' => 'fundraiser_reference_id, name, email, comment, created_date', 'condition' => 'fundraiser_reference_id = ' . $_POST['fundraiser_id'] . ' AND status = "Y" ', 'order' => 'id DESC' /*, 'limit' => '5'*/));
            $this->renderPartial('comment_Fundraiser', array('latest_comment' => $latest_comment));
        }
    }

    /*
     * Action for count hug of the fundraiser
     */
    public function actionHugcounter()
    {
        $output = array();
        $output['hug_count'] = 0;

        if (!empty($_POST['fundraiser_id'])) {
            $Client_ip = $_SERVER['REMOTE_ADDR'];

            $new_hug = new FundraiserHug();
            $new_hug->fundraiser_id = $_POST['fundraiser_id'];
            $new_hug->ip_address = $Client_ip;
            $new_hug->status = 'Y';
            $new_hug->save(false);
            
            if($this->checkLogin()){
                $user_id = Yii::app()->frontUser->id;
                RewardPoints::model()->addPoints($new_hug->fundraiser_id,'send_hug',0,$user_id);       
            }

            

            $total_hug = FundraiserHug::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = '.$_POST['fundraiser_id']));
            $output['hug_count'] = $total_hug;
            
        }

        echo json_encode($output);
    }

    /*
     * Action for count hug of the fundraiser
     */
    /*
    public function actionHugcounter()
    {
        if (!empty($_POST['fundraiser_id'])) {
            $Client_ip = $_SERVER['REMOTE_ADDR'];
            $check_exits = FundraiserHug::model()->find(array('select' => 'id', 'condition' => 'ip_address = "' . $Client_ip . '"  AND fundraiser_id = ' . $_POST['fundraiser_id'] . ' '));
            $hug = array();
            $hug_count = 0;
            if (!empty($check_exits)) {
                $hug['hug_count'] = FundraiserHug::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = ' . $_POST['fundraiser_id'] . ' '));
                $hug['already_hug'] = 1;
            } else {
                $check_exits = new FundraiserHug();
                $check_exits->fundraiser_id = $_POST['fundraiser_id'];
                $check_exits->ip_address = $_SERVER['REMOTE_ADDR'];
                if ($check_exits->save(false)) {
                    $total_hug = FundraiserHug::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = ' . $_POST['fundraiser_id'] . ' '));
                    if (!empty($total_hug)) {
                        $hug['hug_count'] = $total_hug;
                    } else {
                        $hug['hug_count'] = 0;
                    }
                    $hug['already_hug'] = 0;
                }
            }
            echo json_encode($hug);
        }
    }
    */


    public function actionSupporter_login()
    {   
        if($this->checkLogin()){
            $this->redirect(array('become_supporter','fundraiser_id' => $_REQUEST['fundraiser_id']));
        }

        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);

        $this->layout = 'main_popup';
        $model = new LoginForm();
        
        if (!empty($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(array('become_supporter','fundraiser_id' => $fundraiser_id));
            }
        }

        $this->render('supporter_login', array(
            'model' => $model,
            'fundraiser' => $fundraiser,
        ));
    }

    public function actionSupporter_signup()
    {   
        if($this->checkLogin()){
            $this->redirect(array('become_supporter','fundraiser_id' => $_REQUEST['fundraiser_id']));
        }

        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);

        $this->layout = 'main_popup';
        $model = new Users();

        if (!empty($_POST['Users'])) {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            $model->attributes = $_POST['Users'];
            $digits = 5;
            $random_digit = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            $model->user_token = $random_digit;
            $model->email_verification = 'N';
            $model->status_new = 'Y';
            $model->request_verification = ' ';
            $model->user_type = '2';
            $model->role = 'supporter';
            $model->password = md5(trim($_POST['Users']['password']));
            if ($model->save(false)) {

                $email_model = EmailTemplates::model()->find("short_code = 'ACTIVATE_ACCOUNT'");
                $email_template = $email_model->template;
                $email_template = str_replace('#USRFULLNAME#', ucfirst($model->username), $email_template);
                $encrypted = $this->encrypt($model->id, ENCRYPTION_KEY);
                $fundraiser_id = $this->encrypt($_POST['Users']['fundraiser_id'], ENCRYPTION_KEY);
                $link = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('Fundraiser/Authenticate', array('pk' => base64_encode($encrypted), 'user_code' => $random_digit, 'fundraiser_code' => base64_encode($fundraiser_id)));
                $email_template = str_replace('#ACTLINK#', $link, $email_template);
                $email_template = str_replace('#LINKONLY#', $link, $email_template);
                $email_template = str_replace('#CUR_YEAR#', date('Y'), $email_template);
                $this->send_email($model->email, $email_model->subject, $email_template);
                Yii::app()->user->setFlash('success', Yii::t("success", "Please check your email (including your spambox) to complete your registration."));
                $this->redirect(Yii::app()->createUrl('fundraiser/become_supporter', array('fundraiser_id' => $fundraiser->id)));                
            }
        }

        $this->render('supporter_signup', array(
            'model' => $model, 
            'fundraiser' => $fundraiser
        ));
    }



    public function actionBecome_supporter()
    {   
        if(!$this->checkLogin()){
            $this->redirect(array('supporter_login','fundraiser_id' => $_REQUEST['fundraiser_id']));
        }

        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);

        $supporter_added = Yii::app()->user->getFlash('supporter_added');

        if((int)$supporter_added == 1){
            $this->render('become_supporter', array(
                'supporter_added' => $supporter_added
            ));    
        }

        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);
        
        $fundraiser_owner = Users::model()->findByPK($fundraiser->user_id);

        $new_supporter = Users::model()->findByPk(Yii::app()->frontUser->id);

        $page_link = $fundraiser->getAbsoluteURL();
        $supporter_added = false;

        $this->layout = 'main_popup';
        $model = new Supporter();

        $model->supporter_email = $new_supporter->email;

        if (!empty($_POST['Supporter'])) {

            $model->setAttributes($_POST['Supporter']);
            $model->supporter_message = $_POST['Supporter']['supporter_message'];
                        
            if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                $model->supporter_image = $_FILES['Supporter']['name']['supporter_image'];
                $model->supporter_image = CUploadedFile::getInstance($model, 'supporter_image');
            } else {
                $model->supporter_image = $_POST['Supporter']['supporter_image'];
            }

            if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                $file_extension = $model->supporter_image->getExtensionName();
                $random_filename = time() . rand(99999, 888888);
                $image_name = $random_filename . "." . $file_extension;
                $original_path = SUPPORTER_IMAGE_ORIGINAL . $image_name;

                $model->supporter_image->saveAs($original_path);
                EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(SUPPORTER_IMAGE_THUMBNAIL . SUPPORTER_IMAGE_THUMB_NAME . $image_name);
                $model->supporter_image = $image_name;
            }

            $model->user_id = $new_supporter->id;
            $model->fundraiser_id = $fundraiser->id;
            $model->status_new = 'Y';

            if($model->save()){

                if($this->checkLogin()){
                    $user_id = Yii::app()->frontUser->id;
                    RewardPoints::model()->addPoints($model->fundraiser_id,'supporter',0,$user_id);        
                }

                if ($_POST['Supporter']['supporter_email']) {

 
                    $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                    $email_model->subject = str_replace('#FUNDRAISER_TITLE#',  $fundraiser->fundraiser_title, $email_model->subject);
                    $email_template = $email_model->template;
                    $email_template = str_replace('#SUPPORTER_NAME#', $new_supporter->username, $email_template);
                    $email_template = str_replace('#FUNDRAISER_TITLE#', $fundraiser->fundraiser_title, $email_template);
                    $this->send_email($model->supporter_email, $email_model->subject, $email_template);
                                            
                    $email_model1 = EmailTemplates::model()->find("short_code = 'LEAD_SUPPORTER_ALERT'");
                    $email_model1->subject = str_replace('#FUNDRAISER_TITLE#',  $fundraiser->fundraiser_title, $email_model1->subject);
                    $email_template1 = $email_model1->template;
                    $email_template1 = str_replace('#SUPPORTER_NAME#', $new_supporter->username, $email_template1);
                    $email_template1 = str_replace('#FUNDRAISER_TITLE#', $fundraiser->fundraiser_title, $email_template1);
                    $email_template1 = str_replace('#LINK#', $page_link, $email_template1);
                    $this->send_email($fundraiser_owner->email, $email_model1->subject, $email_template1);
                    
                    if($fundraiser_owner->id != $new_supporter->id ){

                        $notification = new Notifications();
                        $notification->subject = "New Supporter for ".$fundraiser->fundraiser_title." Fundraiser.";
                        $notification->name = $fundraiser_owner->username;
                        $notification->email = Null;
                        $notification->message ="I would like to be a supporter of ". $fundraiser->fundraiser_title." fundraiser! I would also like to help to promote it to achieve its goal. "."<br><br>Check out my details on the fundraiser page. <br><a href=".$page_link.">Click Here</a>";
                        $notification->from_id = $new_supporter->id;
                        $notification->from_admin = 'N';
                        $notification->is_read = 'N';
                        $notification->to_admin = 'N';
                        $notification->to_id = $fundraiser->user_id;
                        $notification->to_type = 'L';
                        $notification->from_type = 'S';
                        $notification->status = 'Y';
                        $notification->save(false);
                        
                        $notification_supporter = new Notifications();
                        $notification_supporter->subject = "Thank you for supporting ".$fundraiser->fundraiser_title." Fundraiser.";
                        $notification_supporter->name = "Admin";
                        $notification_supporter->email = Null;
                        $notification_supporter->message ="Hello ".$new_supporter->username.",<br><br>"
                                                . "Your support goal is to help promote this fundraiser to all your contacts (email, phone, social media and even physical contacts) and encourage them to do same, so that the goal of this fundraiser can be achieved.<br>"
                                                . "Your support will give the beneficiary of this fundraiser a chance to hold out hope in the face of a challenging situation. Thank you very much for your kindness and humanity.<br><br>"
                                                . "Regards <br>"
                                                . "The ".$fundraiser->fundraiser_title." Fundraising Team";
                        $notification_supporter->from_id = $fundraiser->user_id;
                        $notification_supporter->from_admin = 'N';
                        $notification_supporter->is_read = 'N';
                        $notification_supporter->to_admin = 'N';
                        $notification_supporter->to_id = Yii::app()->frontUser->id;
                        $notification_supporter->to_type = 'S';
                        $notification_supporter->from_type = 'L';
                        $notification_supporter->status = 'Y';
                        $notification_supporter->save(false);
                    }                                 
                }

                Yii::app()->user->setFlash('supporter_added','1');
                Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
                $this->redirect(array('become_supporter','fundraiser_id' => $fundraiser->id));
                //$this->redirect(array('supporter_message','fundraiser_id' => $fundraiser->id));
            }            
        }
  
        $this->render('become_supporter', array(
            'model' => $model, 
            'supporter_added' => $supporter_added,
            'fundraiser' => $fundraiser,
            'fundraiser_owner' => $fundraiser_owner,
        ));       
    }
    
    public function actionSupporter_message()
    {
        $this->layout = 'main_popup';
     
        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);
        
        $this->render('supporter_message', array(
            'fundraiser' => $fundraiser            
        ));
    }
    

    
    public function actionSupporter_message_old()
    {
        if (!empty($_REQUEST['fundraiser'])) {
            $fundraiser = SetupFundraiser::model()->findByPk($_REQUEST['fundraiser']);
            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
            $title = str_replace("'", '', $title);
            $title = strtolower($title);
            $page_link = 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title));
        }

        $supporter_added = false;

        $this->layout = 'main_popup';
        $model = new Supporter();
        if (!empty($_POST['Supporter'])) {
            $model->setAttributes($_POST['Supporter']);
            $model->supporter_message = $_POST['Supporter']['supporter_message'];
                        
            if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                $model->supporter_image = $_FILES['Supporter']['name']['supporter_image'];
                $model->supporter_image = CUploadedFile::getInstance($model, 'supporter_image');
            } else {
                $model->supporter_image = $_POST['Supporter']['supporter_image'];
            }

            if ($model->validate()) {
                if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                    $file_extension = $model->supporter_image->getExtensionName();
                    $random_filename = time() . rand(99999, 888888);
                    $image_name = $random_filename . "." . $file_extension;
                    $original_path = SUPPORTER_IMAGE_ORIGINAL . $image_name;

                    $model->supporter_image->saveAs($original_path);
                    EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(SUPPORTER_IMAGE_THUMBNAIL . SUPPORTER_IMAGE_THUMB_NAME . $image_name);

                    $model->supporter_image = $image_name;
                }
                if ($_POST['Supporter']['supporter_email']) {
                    $emails = explode(',', $_POST['Supporter']['supporter_email']);
                    if(!empty($emails)){
                       // $emails_frontname = explode('@',$emails);
                        // $emails_frontname = explode('@',$_POST['Supporter']['supporter_email']);
                        $emails = $_POST['Supporter']['supporter_email'];
                        $exp    = explode('@',$emails);
                        $char   = array('.','_','-');
                        $supporter_name    = str_replace($char, '', $exp[0]);
                        
                    }
                    $fundraiser_detail=  SetupFundraiser::model()->find('id='.$_REQUEST['fundraiser']);
                    $lead_supporter_detail= Users::model()->find('id='.$fundraiser_detail->user_id);
                    
                    if(is_array($emails)){
                        foreach ($emails as $email) {
                                //Supporter MESSage 30 JUN 16
                                /*
                                $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                                $email_template = $email_model->template;
                                $email_template = str_replace('#EMAIL#', trim($email), $email_template);
                                $email_template = str_replace('#MSG#', $_POST['Supporter']['supporter_message'], $email_template);
                                $email_template = str_replace('#LINK#', $page_link, $email_template);
                                $this->send_email(trim($email), $email_model->subject, $email_template);*/
                        }
                    }else{
                        if(!empty($emails)){
                            
                            $new_supporter= Users::model()->find('id='.Yii::app()->frontUser->id);
                            
                            $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                            $email_model->subject = str_replace('#FUNDRAISER_TITLE#',  $fundraiser_detail->fundraiser_title, $email_model->subject);
                            $email_template = $email_model->template;
                            $email_template = str_replace('#SUPPORTER_NAME#', $new_supporter->username, $email_template);
                            $email_template = str_replace('#FUNDRAISER_TITLE#', $fundraiser_detail->fundraiser_title, $email_template);
                            $this->send_email($emails, $email_model->subject, $email_template);
                           
                            
                            $email_model1 = EmailTemplates::model()->find("short_code = 'LEAD_SUPPORTER_ALERT'");
                            $email_model1->subject = str_replace('#FUNDRAISER_TITLE#',  $fundraiser_detail->fundraiser_title, $email_model1->subject);
                            $email_template1 = $email_model1->template;
                            $email_template1 = str_replace('#SUPPORTER_NAME#', $new_supporter->username, $email_template1);
                            $email_template1 = str_replace('#FUNDRAISER_TITLE#', $fundraiser_detail->fundraiser_title, $email_template1);
                            $email_template1 = str_replace('#LINK#', $page_link, $email_template1);
                            $this->send_email($lead_supporter_detail->email, $email_model1->subject, $email_template1);
                            
			    if($fundraiser_detail->user_id != $new_supporter->id ){
		                    $notification = new Notifications();
		                    $notification->subject = "New Supporter for ".$fundraiser_detail->fundraiser_title." Fundraiser.";
		                    $notification->name = $lead_supporter_detail->username;
		                    $notification->email = Null;
		                    $notification->message ="I would like to be a supporter of ". $fundraiser_detail->fundraiser_title." fundraiser! I would also like to help to promote it to achieve its goal. "."<br><br>Check out my details on the fundraiser page. <br><a href=".$page_link.">Click Here</a>";
		                    $notification->from_id = Yii::app()->frontUser->id;
		                    $notification->from_admin = N;
		                    $notification->is_read = N;
		                    $notification->to_admin = N;
		                    $notification->to_id = $fundraiser_detail->user_id;
		                    $notification->to_type = 'L';
		                    $notification->from_type = 'S';
		                    $notification->status = Y;
		                    $notification->save(false);
		                    
		                    $notification_supporter = new Notifications();
		                    $notification_supporter->subject = "Thank you for supporting ".$fundraiser_detail->fundraiser_title." Fundraiser.";
		                    $notification_supporter->name = "Admin";
		                    $notification_supporter->email = Null;
		                    $notification_supporter->message ="Hello ".$new_supporter->username.",<br><br>"
		                                            . "Your support goal is to help promote this fundraiser to all your contacts (email, phone, social media and even physical contacts) and encourage them to do same, so that the goal of this fundraiser can be achieved.<br>"
		                                            . "Your support will give the beneficiary of this fundraiser a chance to hold out hope in the face of a challenging situation. Thank you very much for your kindness and humanity.<br><br>"
		                                            . "Regards <br>"
		                                            . "The ".$fundraiser_detail->fundraiser_title." Fundraising Team";
		                    $notification_supporter->from_id = $fundraiser_detail->user_id;
		                    $notification_supporter->from_admin = N;
		                    $notification_supporter->is_read = N;
		                    $notification_supporter->to_admin = N;
		                    $notification_supporter->to_id = Yii::app()->frontUser->id;
		                    $notification_supporter->to_type = 'S';
		                    $notification_supporter->from_type = 'L';
		                    $notification_supporter->status = Y;
		                    $notification_supporter->save(false);
			    }
                        }
                    }
                }

                if ($model->save(false)) {
                    $supporter_added = true;
                    //Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
                    //echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title)));
                    //$this->redirect(array('supporter_message', 'flag' => '1'));
                }
            }else{

            }
        }

        
        $this->render('supporter_message', array('model' => $model, 'supporter_added' => $supporter_added));
    }
    

    
    public function actionAddReview()
    {
        
        $this->layout = 'main_popup';
        //$model = new LoginForm();
        $model = new UserReview();
        // echo Yii::app()->frontUser->id;die;
        
        
        //p($_POST);
        if (!empty($_POST['UserReview'])) {
                /*
                $model->setAttributes($_POST['user_id']);
                $model->setAttributes($_POST['email']);
                $model->setAttributes($_POST['message']);
                */
                $signup->attributes = $_POST['Users'];
                
                //p($model->save(false));
                if ($model->save(false)) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                        Yii::app()->end();
                    } else {
                        Yii::app()->adminUser->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
                        $this->redirect(array('supporter_review', 'id' => $id));
                    }
                }
                
                $this->redirect(array('supporter_review', 'id' => $exist_user->id, 'name' => $exist_user->username, 'fundraiser' => $_REQUEST['id']));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Sorry, the email and password you entered do not match. Please try again."));
                $this->redirect(array('become_review', 'model' => $model, 'id' => $_REQUEST['id'], 'fundraiser_name' => $_REQUEST['fundraiser_title'], 'fundraiser_image' => $_REQUEST['fundraiser_image'], 'flag' => '1'));
            }
        //}
            
        if (!empty(Yii::app()->frontUser->id)) {
            $model_users = Users::model()->find('id="' . Yii::app()->frontUser->id . '"');
            $this->render('supporter_review', array('model' => $model,'model_users'=>$model_users));
        }else{
             $this->render('supporter_review', array('model' => $model));
        }
    }

    /*
     * function for the user authentication
     */
    public function actionAuthenticate($pk, $user_code = "", $fundraiser_code = "")
    {

        $decrypted = $this->decrypt(base64_decode($pk), ENCRYPTION_KEY);
        $fundraiser_id = $this->decrypt(base64_decode($fundraiser_code), ENCRYPTION_KEY);
        if ($user_code != "") {
            $user_model = Users::model()->findByPk($decrypted);
            $user_verified_data = Users::model()->find(array("select" => "id", "condition" => "id = '" . $user_model->id . "' AND user_token = '" . $user_code . "' AND email_verification='N' "));
            if (!empty($user_verified_data)) {
                $user_verified_data->email_verification = 'Y';
                $user_verified_data->save(false);
                $fundraiser_data = SetupFundraiser::model()->findByPk($fundraiser_id);
                $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser_data->fundraiser_title);
                $title = str_replace("'", '', $title);
                $title = strtolower($title);
                Yii::app()->user->setFlash('success', Yii::t("success", "Thank You! Your account has been verified successfully."));
                $this->redirect(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser_data->id, 'fundraiser_name' => $title, 'fundraiser_code' => $fundraiser_code)));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Oops, Verification link has been expired."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        } else {
            Yii::app()->frontUser->setFlash('success', Yii::t("success", "Oops, Verification link has been expired."));
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

    }

    public function actionSupporter_success_message(){
        $this->layout = 'main_popup';
        $this->render('supporter_added_message');
    }
    
    public function actionSupporter_review(){
        if (!empty($_REQUEST['fundraiser'])) {
            $fundraiser = SetupFundraiser::model()->findByPk($_REQUEST['fundraiser']);
            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
            $title = str_replace("'", '', $title);
            $title = strtolower($title);
            $page_link = 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title));
        }

        $this->layout = 'main_popup';
        $model = new Supporter();
        if (!empty($_POST['Supporter'])) {
                $model->setAttributes($_POST['Supporter']);
                $model->supporter_message = $_POST['Supporter']['supporter_message'];
                if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                    $model->supporter_image = $_FILES['Supporter']['name']['supporter_image'];
                    $model->supporter_image = CUploadedFile::getInstance($model, 'supporter_image');
                } else {
                    $model->supporter_image = $_POST['Supporter']['supporter_image'];
                }
                if ($model->validate(array('supporter_image'))) {
                    if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                        $file_extension = $model->supporter_image->getExtensionName();
                        $random_filename = time() . rand(99999, 888888);
                        $image_name = $random_filename . "." . $file_extension;
                        $original_path = SUPPORTER_IMAGE_ORIGINAL . $image_name;

                        $model->supporter_image->saveAs($original_path);
                        EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(SUPPORTER_IMAGE_THUMBNAIL . SUPPORTER_IMAGE_THUMB_NAME . $image_name);

                        $model->supporter_image = $image_name;
                    }
                    if ($_POST['Supporter']['supporter_email']) {
                        $emails = explode(',', $_POST['Supporter']['supporter_email']);
                        foreach ($emails as $email) {
                            $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                            $email_template = $email_model->template;
                            $email_template = str_replace('#EMAIL#', trim($email), $email_template);
                            $email_template = str_replace('#MSG#', $_POST['Supporter']['supporter_message'], $email_template);
                            $email_template = str_replace('#LINK#', $page_link, $email_template);
                            $this->send_email(trim($email), $email_model->subject, $email_template);
                        }
                    }

                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
                        echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title,'sendflag' => '1')));
                    //  $this->redirect(array('supporter_message', 'flag' => '1'));
                    }
            }
        }
        $this->render('supporter_review', array('model' => $model, 'data' => $_REQUEST));
    }

    public function actionLocatefundraiser()
    {
        $fundraiser = SetupFundraiser::model()->findAll();
        $fundraiser_id = isset($fundraiser[0]) ? $fundraiser[0]->id : 0;
        if($this->checkLogin()){
            $user_id = Yii::app()->frontUser->id;
            RewardPoints::model()->addPoints($fundraiser_id,'explore_fundraisers',0,$user_id);        
        }

        $this->render('locatefundraiser', array('fundraiser' => $fundraiser));
    }

    public function actionViewmore()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;

        $fundraisers = Fundraiser::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);

        $this->renderPartial('/layouts/viewmore', array(
            'fundraisers' => $fundraisers, 
            'max_id' => $max_id
        ));
    }

    public function actionCategory()
    {
        $id = $_REQUEST['id'];

        $category = FundraiserType::model()->findByPk($id);

        //All categories for menu
        $categories = FundraiserType::model()->findAll();

        $this->render('category', array(                
            'category' => $category,
            'categories' => $categories,         
        ));
    }

    public function actionViewmorecategory()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;
        $fundraiser = Yii::app()->db->createCommand()
            ->select('*')
            ->from('setup_fundraiser')
            ->where('ftype_id = "' . $_REQUEST['type_id'] . '"')//where($condition, $params)
            ->order('id ASC')
            ->offset($page_start)
            ->limit($page_end)
            ->queryAll();
        $this->renderPartial('/layouts/viewmoreCategory', array('fundraiser' => $fundraiser, 'max_id' => $max_id));
    }

    public function actionViewmoretestimonial()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;
        $testimonials_object = Testimonial::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);
        $this->renderPartial('/layouts/viewmoreTestimonial', array('testimonials_object' => $testimonials_object, 'max_id' => $max_id));
    }
    
    public function actionManagefundraiser(){
        
        if (!$this->checkLogin()) {
            $this->redirect(Yii::app()->createUrl('site/login'));
            Yii::app()->end();
        }

        $user_id = Yii::app()->frontUser->id;
        $user = Users::model()->findByPK($user_id);
        $tab = Yii::app()->request->getParam('tab','reports');

        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);   

        if($fundraiser->user_type == 'community'){
            $edit_model = CommunityFundraiser::model()->findByPk($fundraiser_id);
        }else if($fundraiser->user_type == 'corporate'){
            $edit_model = CorporateFundraiser::model()->findByPk($fundraiser_id);
        }else if($fundraiser->user_type == 'non_profit'){
            $edit_model = NonprofitFundraiser::model()->findByPk($fundraiser_id);
        }else {
            $edit_model = OtherFundraiser::model()->findByPk($fundraiser_id);   
        }

        $edit_model->scenario = 'update';
        
        //$model=  new SetupFundraiser();
        $model=  new Fundraiser();        
        $notification = new Notifications();

        if(isset($_POST['Fundraiser'])){
            
            $model->fundraiser_id = $_POST['Fundraiser']['fundraiser_id'];
            $tab = 'photo';

            if(empty($_POST['Fundraiser']['fundraiser_id'])){
                $model->addError('fundraiser_id','Please select a fundraiser');
            }

            if(empty($_FILES['Fundraiser']['name']['uplod_fun_img'])){
                $model->addError('uplod_fun_img','Fundraiser image cannot be empty.');
            }

            if(!$model->hasErrors()){
                $update_model = Fundraiser::model()->findByPk($model->fundraiser_id);
                $update_model->uploadFundraiserImage();
                $update_model->update();
                Yii::app()->user->setFlash('success', "Fundraiser image changed successfully."); 
            }

        }
               
        if (isset($_POST['CommunityFundraiser'])) {
            
            $edit_model->fundraiser_title = $_POST['CommunityFundraiser']['fundraiser_title'];
            $edit_model->fundraiser_description = $_POST['CommunityFundraiser']['fundraiser_description'];
            $edit_model->tell_ur_fund_story = $_POST['CommunityFundraiser']['tell_ur_fund_story'];
            $edit_model->project_name = $_POST['CommunityFundraiser']['project_name'];
            $edit_model->lead_supptr_name = $_POST['CommunityFundraiser']['lead_supptr_name'];
            $edit_model->lead_supptr_email = $_POST['CommunityFundraiser']['lead_supptr_email'];
            $edit_model->lead_supptr_phone = $_POST['CommunityFundraiser']['lead_supptr_phone'];
            $edit_model->fundr_timeline_to = $_POST['CommunityFundraiser']['fundr_timeline_to'];
            $edit_model->fund_can_achiv = $_POST['CommunityFundraiser']['fund_can_achiv'];
            $edit_model->search_yes = $_POST['CommunityFundraiser']['search_yes'];
            $edit_model->search_no = $_POST['CommunityFundraiser']['search_no'];
            $edit_model->reward_program = $_POST['CommunityFundraiser']['reward_program'];

            $edit_model->uploadFundraiserImage();
            $edit_model->uploadLeadSupporterImage();

  
            if ($edit_model->validate()) {
                if($edit_model->save()){
                    Yii::app()->user->setFlash('success', "Fundraiser information updated successfully."); 
                    $this->redirect(Yii::app()->createUrl('fundraiser/managefundraiser',array('tab'=>'edit','fundraiser_id' => $edit_model->id))); 
                }
            }
        }

        if (isset($_POST['CorporateFundraiser'])) {
            
            $tab = 'edit';

            $edit_model->fundraiser_title = $_POST['CorporateFundraiser']['fundraiser_title'];
            $edit_model->fundraiser_description = $_POST['CorporateFundraiser']['fundraiser_description'];
            $edit_model->tell_ur_fund_story = $_POST['CorporateFundraiser']['tell_ur_fund_story'];
            $edit_model->project_name = $_POST['CorporateFundraiser']['project_name'];
            $edit_model->lead_supptr_name = $_POST['CorporateFundraiser']['lead_supptr_name'];
            $edit_model->lead_supptr_email = $_POST['CorporateFundraiser']['lead_supptr_email'];
            $edit_model->lead_supptr_phone = $_POST['CorporateFundraiser']['lead_supptr_phone'];
            $edit_model->fundr_timeline_to = $_POST['CorporateFundraiser']['fundr_timeline_to'];
            $edit_model->fund_can_achiv = $_POST['CorporateFundraiser']['fund_can_achiv'];
            $edit_model->search_yes = $_POST['CorporateFundraiser']['search_yes'];
            $edit_model->search_no = $_POST['CorporateFundraiser']['search_no'];
            $edit_model->reward_program = $_POST['CorporateFundraiser']['reward_program'];

            $edit_model->uploadFundraiserImage();
            $edit_model->uploadLeadSupporterImage();
            $edit_model->uploadLeadSupporterBgImage();           
  
            if ($edit_model->validate()) {
                if($edit_model->save()){
                    Yii::app()->user->setFlash('success', "Fundraiser information updated successfully."); 
                    $this->redirect(Yii::app()->createUrl('fundraiser/managefundraiser',array('tab'=>'edit','fundraiser_id' => $edit_model->id))); 
                }
            }
        }

        if (isset($_POST['NonprofitFundraiser'])) {
            
            $tab = 'edit';

            $edit_model->fundraiser_title = $_POST['NonprofitFundraiser']['fundraiser_title'];
            $edit_model->fundraiser_description = $_POST['NonprofitFundraiser']['fundraiser_description'];
            $edit_model->tell_ur_fund_story = $_POST['NonprofitFundraiser']['tell_ur_fund_story'];
            $edit_model->project_name = $_POST['NonprofitFundraiser']['project_name'];
            
            $edit_model->fund_mange_name = $_POST['NonprofitFundraiser']['fund_mange_name'];
            $edit_model->fund_mange_email = $_POST['NonprofitFundraiser']['fund_mange_email'];
            $edit_model->fund_mange_phone = $_POST['NonprofitFundraiser']['fund_mange_phone'];

            $edit_model->lead_supptr_name = $_POST['NonprofitFundraiser']['lead_supptr_name'];
            $edit_model->lead_supptr_email = $_POST['NonprofitFundraiser']['lead_supptr_email'];
            $edit_model->lead_supptr_phone = $_POST['NonprofitFundraiser']['lead_supptr_phone'];
            $edit_model->fundr_timeline_to = $_POST['NonprofitFundraiser']['fundr_timeline_to'];
            $edit_model->fund_can_achiv = $_POST['NonprofitFundraiser']['fund_can_achiv'];
            $edit_model->search_yes = $_POST['NonprofitFundraiser']['search_yes'];
            $edit_model->search_no = $_POST['NonprofitFundraiser']['search_no'];
            $edit_model->reward_program = $_POST['NonprofitFundraiser']['reward_program'];

            $edit_model->uploadFundraiserImage();
            $edit_model->uploadLeadSupporterImage();
            $edit_model->uploadLeadSupporterBgImage();     
            $edit_model->uploadBenificaryBgImage();    
            $edit_model->uploadFundManagerImage();
                 

            if ($edit_model->validate()) {
                if($edit_model->save()){
                    Yii::app()->user->setFlash('success', "Fundraiser information updated successfully."); 
                    $this->redirect(Yii::app()->createUrl('fundraiser/managefundraiser',array('tab'=>'edit','fundraiser_id' => $edit_model->id))); 
                }
            }
        }

        if (isset($_POST['OtherFundraiser'])) {
            $tab = 'edit';
            $edit_model->fundraiser_title = $_POST['OtherFundraiser']['fundraiser_title'];
            $edit_model->fundraiser_description = $_POST['OtherFundraiser']['fundraiser_description'];
            $edit_model->tell_ur_fund_story = $_POST['OtherFundraiser']['tell_ur_fund_story'];
            $edit_model->project_name = $_POST['OtherFundraiser']['project_name'];

            $edit_model->lead_supporter_i_am = isset($_POST['OtherFundraiser']['lead_supporter_i_am']) && (int) $_POST['OtherFundraiser']['lead_supporter_i_am']==1 ? 1 :0;
            $edit_model->lead_supporter_not_sure = isset($_POST['OtherFundraiser']['lead_supporter_not_sure']) && (int)$_POST['OtherFundraiser']['lead_supporter_not_sure'] == 1 ? 1 :0;
            
            $edit_model->lead_supptr_name = $_POST['OtherFundraiser']['lead_supptr_name'];
            $edit_model->lead_supptr_email = $_POST['OtherFundraiser']['lead_supptr_email'];
            $edit_model->lead_supptr_sex = $_POST['OtherFundraiser']['lead_supptr_sex'];
            $edit_model->lead_supptr_age = $_POST['OtherFundraiser']['lead_supptr_age'];
            $edit_model->lead_supptr_relationshp = $_POST['OtherFundraiser']['lead_supptr_relationshp'];                        
            $edit_model->lead_supptr_phone = $_POST['OtherFundraiser']['lead_supptr_phone'];
            $edit_model->fundr_timeline_to = $_POST['OtherFundraiser']['fundr_timeline_to'];
            $edit_model->fund_can_achiv = $_POST['OtherFundraiser']['fund_can_achiv'];
            $edit_model->search_yes = $_POST['OtherFundraiser']['search_yes'];
            $edit_model->search_no = $_POST['OtherFundraiser']['search_no'];
            $edit_model->reward_program = $_POST['OtherFundraiser']['reward_program'];




            $edit_model->fund_mange_name = $_POST['OtherFundraiser']['fund_mange_name'];
            $edit_model->fund_manager_phone = $_POST['OtherFundraiser']['fund_manager_phone'];
            $edit_model->fund_mange_email = $_POST['OtherFundraiser']['fund_mange_email'];
            $edit_model->fund_mange_age = $_POST['OtherFundraiser']['fund_mange_age']; 
            $edit_model->fund_mange_sex = $_POST['OtherFundraiser']['fund_mange_sex'];                       
            $edit_model->fund_mange_relationshp = $_POST['OtherFundraiser']['fund_mange_relationshp'];


            $edit_model->uploadFundraiserImage();
            $edit_model->uploadFundraiserBgImage();
            $edit_model->uploadBenificaryImage();
            $edit_model->uploadLeadSupporterImage();
            $edit_model->uploadLeadSupporterBgImage();     
            $edit_model->uploadFundManagerImage();      
  
            if ($edit_model->validate()) {
                if($edit_model->save()){
                    Yii::app()->user->setFlash('success', "Fundraiser information updated successfully."); 
                    $this->redirect(Yii::app()->createUrl('fundraiser/managefundraiser',array('tab'=>'edit','fundraiser_id' => $edit_model->id))); 
                }
            }
        }
  
        if($_POST['Notifications']){

            $tab = 'messages';

            $notice_fundraiser = Fundraiser::model()->findByPk($_POST['Notifications']['fundraiser_id']);
                        
            $reciever_user = Users::model()->findByPk((int)$_POST['Notifications']['receiver_name']);

            $notification->name = Yii::app()->frontUser->username;
            $notification->from_id = Yii::app()->frontUser->id;
            $notification->to_id = $reciever_user->id;
            $notification->fundraiser_id = $_POST['Notifications']['fundraiser_id'];
            $notification->receiver_type = $_POST['Notifications']['receiver_type'];
            $notification->receiver_name = $reciever_user->username;
            $notification->subject = $_POST['Notifications']['subject'];
            $notification->message = $_POST['Notifications']['message'];
            $notification->is_read = "N";
            $notification->from_admin = "N";
            $notification->to_admin = "N";
            $notification->from_type = "S";
            $notification->to_type = "S";
            $notification->is_sent_to_all = "N";
            $notification->status = "Y";
            if($notification->save()){
                Yii::app()->user->setFlash('success', "Message has been sent.");
                $this->redirect(Yii::app()->createUrl('fundraiser/managefundraiser',array('tab'=>'messages'))); 
            }else{
                // echo '<pre>';
                // print_r($notification->errors);
                // exit; 
            }
                        
        }


        
        $case_id =  isset($_GET['case_id']) && !empty($_GET['case_id']) ? (int) $_GET['case_id'] : 0;
        
        $case_update = CaseUpdates::model()->findByPk($case_id);

        if(empty($case_update)){
            $case_update = new CaseUpdates();
        }


        if($_POST['CaseUpdates']) {

            $tab = 'case';

            $case_update->attributes = $_POST['CaseUpdates'];

            $case_update->user_id = $user_id;   
            $case_update->user_name = $user->username;
            $case_update->user_email = $user->email;
   
            $case_update->uploadImage();
            $case_update->uploadDocuments();


            if($case_update->save()){
                if(empty($case_id)){
                    Yii::app()->user->setFlash('success', "Case update created successfully!");
                }else{
                    Yii::app()->user->setFlash('success', "Case update information updated successfully!");
                }

                $this->redirect(Yii::app()->createUrl('/fundraiser/managefundraiser', array('tab' => 'case')));
            }

        }
        
        $ftype_list = array();
        if($tab =='edit' && !empty($fundraiser_id)){
            $sub_types= FundraiserSubType::model()->findAll('p_id='.$fundraiser->ftype_id);
            $ftype_list= CHtml::listData($sub_types,'id','fundraiser_subtyp');
        }

        $fundraisers_list= Fundraiser::model()->findAll("user_id = $user_id ");
        
        $chart_stats = array(
            'donation_count' => Fundraiser::model()->getUserDonationCount($user_id),
            'fb_counts' => Fundraiser::model()->getUserFbShareCount($user_id),
            'hug_count' => Fundraiser::model()->getUserHugCount($user_id),
            'fundraiser_sentinviation_count' => Fundraiser::model()->getUserSentInviteCount($user_id),
            'supporter_count' => Fundraiser::model()->getUserSupporterCount($user_id),
            'supporter_messaging_count' => Fundraiser::model()->getUserSupporterMessageCount($user_id),
            'total_embed_site_count' => Fundraiser::model()->getUserSiteEmbedCount($user_id),
        );


        $case_updates_list = CaseUpdates::model()->findAll('user_id = :user_id',array(
            'user_id' => $user_id
        ));

        $this->render('_manage',array(
            'model'=>$model,
            'tab' =>$tab,
            'fundraisers_list' => $fundraisers_list,
            'fundraiser' => $fundraiser,
            'notification'=>$notification, 
            'case_update' => $case_update,
            'case_updates_list' => $case_updates_list,
            'edit_model' => $edit_model,
            'ftype_list' => $ftype_list,
            'chart_stats' => $chart_stats,
            'fundraiser_id' => $fundraiser_id,
        ));
                
    }

    public function actionGetForm(){

        $fundraiser_id = Yii::app()->request->getParam('fundraiser_id',0);
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);        

        $view = 'edit_community';
        if($fundraiser->user_type == 'community'){
            $model = CommunityFundraiser::model()->findByPk($fundraiser_id);
            $view = '_edit_community';
        }else if($fundraiser->user_type == 'corporate'){
            $model = CorporateFundraiser::model()->findByPk($fundraiser_id);
            $view = '_edit_corporate';
        }else if($fundraiser->user_type == 'non_profit'){
            $model = NonprofitFundraiser::model()->findByPk($fundraiser_id);
            $view = '_edit_non_profit';
        }else {
            $model = OtherFundraiser::model()->findByPk($fundraiser_id);
            $view = '_edit_other';    
        }

        $sub_types= FundraiserSubType::model()->findAll('p_id='.$fundraiser->ftype_id);
        $ftype_list= CHtml::listData($sub_types,'id','fundraiser_subtyp');

        $this->renderPartial($view,array(
            'model' => $model,
            'ftype_list' => $ftype_list
        ),false,true);
        
    }
    

    public function actionGetReceivers(){

        $fundraiser_id = $_GET['Notifications']['fundraiser_id'];   
        $fundraiser = Fundraiser::model()->findByPk($fundraiser_id);
        $receiver_type = $_GET['Notifications']['receiver_type'];   

        $data = [];

        if($receiver_type =='manager'){
            $user = Users::model()->find('email = :email',array('email' => $fundraiser->fund_mange_email));
            if(is_object($user)){
                $data[] = array(
                    'id' => $user->id ,
                    'name' =>  $user->username,
                );
            }
        }else if($receiver_type =='beneficiary'){

            $user = Users::model()->find('email = :email',array('email' => $fundraiser->benifi_email));
            if(is_object($user)){
                $data[] = array(
                    'id' => $user->id ,
                    'name' =>  $user->username,
                );
            }

        }else if($receiver_type == 'supporter'){
            
            $supporters = Supporter::model()->findAll('fundraiser_id = :fundraiser_id',array('fundraiser_id' => $fundraiser_id));
            foreach($supporters as $supporter){
                $user = Users::model()->find('email = :email',array('email' => $supporter->supporter_email));
                
                if(is_object($user)){
                    $data[] = array(
                        'id' => $user->id ,
                        'name' =>  $user->username,
                    );
                }

            }

        }

        foreach($data as $user)
        {
            echo CHtml::tag('option', array(
                'value'=>$user['id'
            ]),CHtml::encode($user['name']),true);
        }
        
    }


    public function actionEvent_invitation(){
        
        $model = new EventInvitation();
        if (isset($_POST['EventInvitation'])) {
                
                    $model->setAttributes($_POST['EventInvitation']);
                    if($_POST['EventInvitation']['country']=='1'){
                        $_POST['EventInvitation']['country']='Nigeria';
                    }
                    
                    if($_POST['EventInvitation']['state']=='1'){
                        $_POST['EventInvitation']['state']='Kano';
                    }elseif($_POST['EventInvitation']['state']=='2'){
                        $_POST['EventInvitation']['state']='Lagos';
                    }elseif($_POST['EventInvitation']['state']=='3'){
                        $_POST['EventInvitation']['state']='Kaduna';
                    }
                    /*
                    if($_POST['EventInvitation']['event_type']=='1'){
                        $_POST['EventInvitation']['event_type']='Child';
                    }elseif($_POST['EventInvitation']['event_type']=='2'){
                        $_POST['EventInvitation']['event_type']='Social';
                    }elseif($_POST['EventInvitation']['event_type']=='3'){
                        $_POST['EventInvitation']['event_type']='Awareness';
                    }*/
                    
                    $model->created_date= time();  
                    //$model->user_id= $_POST['EventInvitation']['user_id'];
		    if(!empty($_POST['EventInvitation']['user_id'])){
                        $model->user_id= $_POST['EventInvitation']['user_id'];  
                    }else{
                        $model->user_id= '1';   
                    }
			
                    $model->event_name= $_POST['EventInvitation']['event_name'];
                    $model->event_cordinator= $_POST['EventInvitation']['event_cordinator'];
                    $model->email= $_POST['EventInvitation']['email'];
                    $model->event_type= $_POST['EventInvitation']['event_type'];
                    $model->event_desc= $_POST['EventInvitation']['event_desc'];
                    $model->event_startdate= $_POST['EventInvitation']['event_startdate'];
                    $model->event_enddate= $_POST['EventInvitation']['event_enddate'];
                    $model->location= $_POST['EventInvitation']['location'];
                    $model->city= $_POST['EventInvitation']['city'];
                    $model->state= $_POST['EventInvitation']['state'];
                    $model->country= $_POST['EventInvitation']['country'];
                    $model->attached_itinerary= $_FILES['EventInvitation']['name']['attached_itinerary'];
                    $model->attached_itinerary = CUploadedFile::getInstance($model, 'attached_itinerary');
                    $model->status_new = 'Y';

                    if($model->validate()){
                        if ($model->validate(array('attached_itinerary'))) {
                            if (isset($_FILES['EventInvitation']['name']['attached_itinerary']) && !empty($_FILES['EventInvitation']['name']['attached_itinerary'])) {
                                $file_extension = $model->attached_itinerary->getExtensionName();
                                $random_filename = time() . rand(99999, 888888);
                                $file_name = $random_filename . "." . $file_extension;
                                $original_path = EVENT_INITERARY_ORIGINAL . $file_name;
                                $model->attached_itinerary->saveAs($original_path);
                                //EWideImage::load($original_path)->saveToFile(EVENT_INITERARY_THUMBNAIL . EVENT_INITERARY_THUMB_NAME . $file_name);
                                $model->attached_itinerary = $file_name;
                            }
                            if($model->save()){

                                      Yii::app()->user->setFlash('success', Yii::t("success", "Your event invitation has been sent."));
                                      //$this->render('event_invitation');
                                      $this->redirect('event_invitation');
                            }
                        } 
                    }// p($model->getErrors());  
        }
        $this->render('event_invitation',array('model'=>$model));
    }
  
    public function actionPagedata(){
     
        $postData = Yii::app()->request->getPost('clienData');
        
        $page_no = (!empty($postData)) ? $postData : '1';
        $offset = ($page_no - 1) * COMMENT_RECORDS_PER_PAGE;
               
        $fundraiser = FundraiserComment::model()->findAll(array(
                        'select' => 'fundraiser_reference_id, name, email, comment, created_date',
                        'condition' => "fundraiser_reference_id = '".$_REQUEST['fundraiser_id']."' AND status = 'Y'",
                        'order' => 'id DESC',
                        'limit' => COMMENT_RECORDS_PER_PAGE,
                        'offset' => $offset
                    ));
        
        $this->renderPartial('_ajaxContent', array('fundraiser'=>$fundraiser));
    }
    public function actionReport_fundraiser(){
        
        $this->layout = 'main_popup';
        $model = new ReportFundraiser();
        
        if (!empty($_REQUEST)) {
            $fundraiser = SetupFundraiser::model()->findByPk($_REQUEST['id']);
            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
            $title = str_replace("'", '', $title);
            $title = strtolower($title);
            $page_link = 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title));
        }
        
        if(isset($_POST['ReportFundraiser'])){
            $fundraiser_detail= SetupFundraiser::model()->find('id='.$_REQUEST['id']);
            
            $model->fundraiser_title=$fundraiser_detail->fundraiser_title;
            $model->fundraiser_id= $_REQUEST['id'];
            $model->user_name= $_POST['ReportFundraiser']['user_name'];
            $model->email=$_POST['ReportFundraiser']['email'];
            $model->description=$_POST['ReportFundraiser']['description'];
            $model->status = 'N';
            
            if($model->save(false)){
                
                //Yii::app()->user->setFlash('success', Yii::t("success", "Your report has been successfully sent."));
                // $pathinfo = SITE_ABS_PATH.Yii::app()->request->getPathInfo()."?f_id=".$_REQUEST['f_id'];
                //  $this->redirect($pathinfo);
                //Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
               echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser_detail->id, 'fundraiser_name' => $title,'report_id' => '1')));
            }else{
                
                Yii::app()->user->setFlash('error', Yii::t("error", "Something went wrong"));
                $this->redirect('report_fundraiser');
            }
        }
        $this->render('report_fundraiser',array('model'=>$model));
    }
    
    public function actionReport_response(){
                $model = new ReportFundraiser();
                $this->render('report_response',array('model'=>$model));
    }
    public function actionEmbed_fundraiser(){
        $this->layout = 'main_popup';
        $fundraiser= SetupFundraiser::model()->find('id='.$_REQUEST['id']);


        if($this->checkLogin()){
            $user_id = Yii::app()->frontUser->id;
            RewardPoints::model()->addPoints($fundraiser->id,'embed_on_site',0,$user_id);       
        }

        if(empty($fundraiser->no_of_embedsite)){
            $fundraiser->no_of_embedsite='1';
        }else{
            $fundraiser->no_of_embedsite= $fundraiser->no_of_embedsite + 1;
        }
        $fundraiser->save(false);
        $this->render('embed_fundraiser',array('fundraiser'=>$fundraiser,'id'=>$_REQUEST['id']));
    }
    public function actionEmbedded_frame(){
        $this->layout = 'main_popup';
        //$fundraiser= SetupFundraiser::model()->find('id='.$_REQUEST['id']);
        $fundraiser= Fundraiser::model()->findByPk((int)$_REQUEST['id']);
        $this->renderPartial('embeded_frame',array('fundraiser'=>$fundraiser,'id'=>$_REQUEST['id']));
    }
    public function actionSendmsg_supportcenter(){
        $this->layout = 'main_popup';
        $send_notification_form =  new Notifications;
        
        if(isset($_POST['Notifications'])){
            $send_notification_form->subject = $_POST['Notifications']['subject'];
            $send_notification_form->name = $_POST['Notifications']['name'];
            $send_notification_form->email = $_POST['Notifications']['email'];
            $send_notification_form->message = $_POST['Notifications']['message'];
            $send_notification_form->from_admin = 'N';
            $send_notification_form->to_admin = 'Y';
            $send_notification_form->is_read = 'N';
	    $send_notification_form->to_type = 'A';
            $send_notification_form->from_type = 'S';
            $send_notification_form->fundraiser_id = $_POST['Notifications']['fundraiser_id'];
            $send_notification_form->receiver_type = $_POST['Notifications']['receiver_type'];
            $send_notification_form->receiver_name = $_POST['Notifications']['receiver_name'];
            if($send_notification_form->save(false)){
                $this->render('sendmsg_supportcenter_respnc');
                Yii::app()->user->setFlash('success', Yii::t("success", "Your message has been sent."));
            }
        } else {
        $this->render('sendmsg_supportcenter',array('send_notification_form'=>$send_notification_form));
        }
    }
     public function actionSendmsg_supportcenter_respnc(){
        $this->layout = 'main_popup';
       // echo "aaaa";
       // die();
        $this->render('sendmsg_supportcenter_respnc');    
     }

    
    public function actionUser_messaging()
    {
        
        $this->layout = 'main_popup';
        $model = new UserMessaging();
        
            if(isset($_POST['UserMessaging'])){
            //$model->id = $_POST['UserMessaging']['id'];
            $model->user_mail = $_POST['UserMessaging']['user_mail'];
            $model->user_id = $_POST['UserMessaging']['user_id'];
            $model->name = $_POST['UserMessaging']['name'];
            $model->email = $_POST['UserMessaging']['email'];
            $model->message = $_POST['UserMessaging']['message'];
            $sendr_name= $_POST['UserMessaging']['name'];
            $sendr_email= $_POST['UserMessaging']['email'];
            
            //if($send_mssg_form->save(true)){
            if($model->save(true)){
                
                 if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                 $headers = "MIME-Version: 1.0" . "\r\n";
                 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                 $to= $_POST['UserMessaging']['user_mail'];
                 //$to= "test08178@gmail.com";
                 $from= $_POST['UserMessaging']['email'];
                 //$user1= "Sender Email Address-". $from;
                 //$subject= "Some one leave you message";
                 $subject= $sendr_name." leave you message from ".$from;
                 $message= $_POST['UserMessaging']['message'];
                 mail($to, $subject, $message, $headers, $from  );
//                    Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
//                    echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/donations',array('fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name'])));
                    $this->redirect(array('responsemessage1'));
                }
                //Yii::app()->user->setFlash('success', Yii::t("success", "Your message has been sent."));
//                 $headers = "MIME-Version: 1.0" . "\r\n";
//                 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//                 //$to= $_POST['UserMessaging']['user_mail'];
//                 $to= "test08178@gmail.com";
//                 $from= $_POST['UserMessaging']['email'];
//                 $subject= "Some one left you message";
//                 $message= $_POST['UserMessaging']['message'];
//                 mail($to, $subject, $message, $headers, $from );
            }
            //return $this->refresh();
        }
        //$this->render('sendmsg_supportcenter',array('send_notification_form'=>$send_notification_form));
        $this->render('user_messaging', array('model' => $model, 'fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name']));
    }
    
     public function actionResponsemessage1()
    {
        $this->layout = 'main_popup';
        $this->render('response_message1');
    }
    
    public function actionDynamiccitiess()
   {  
        $post_d=$_POST['Typeid'];
        $post_typ=$_POST['Typename'];
        //$data=  SetupFundraiser::model()->findAll('id='.$post_d);
       // $data=  SetupFundraiser::model()->findAll();
      if($post_typ=='1'){
        //$data=  SetupFundraiser::model()->findAll('id='.$post_d);  
        //$data=CHtml::listData($data,'id','benifiry_name');
         $data = Yii::app()->db->createCommand()
          ->select('u.id, u.username')
          ->from('users u')
          ->join('setup_fundraiser p', 'u.username=p.benifiry_name')
          ->where('p.id=:id', array(':id'=>$post_d))
          ->queryAll();
        
        $data=CHtml::listData($data,'id','username');
     } else if($post_typ=='2') {
          //$data=  SetupFundraiser::model()->findAll('id='.$post_d);
          //$data=CHtml::listData($data,'id','fund_mange_name');
         $data = Yii::app()->db->createCommand()
          ->select('u.id, u.username')
          ->from('users u')
          ->join('setup_fundraiser p', 'u.username=p.fund_mange_name')
          ->where('p.id=:id', array(':id'=>$post_d))
          ->queryAll();
        
        $data=CHtml::listData($data,'id','username');
      } else {
          $data = Yii::app()->db->createCommand()
         ->select('u.id, u.username')
         ->from('users u')
         ->join('supporter p', 'u.id=p.user_id')
         ->where('p.fundraiser_id=:id', array(':id'=>$post_d))
         ->queryAll();
         
       $data=CHtml::listData($data,'id','username');
      
      }
        foreach($data as $value=>$name)
    {
        echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
    }
   }
  
 public function actionSendreport(){
   $this->layout = 'popup';
   $this->render('sendreport');
 } 
 public function actionSendreportxml(){
   $this->layout = 'popup';
   $this->render('sendreportxml');
 } 
 public function actionCreatepdf(){
     //$user_d= $_REQUEST['id'];
     $userd = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
     $user_name = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->name:null;
     $subject= " Report Pdf Document";
     $to="test08178@gmail.com";
     $from="demo12@undergirl.co.uk";
     //$mail_a="test08178@gmail.com";
    // $headers = "MIME-Version: 1.0" . "\r\n";
       //    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //   $subject= " Report Pdf Document";
        //   $to="test08178@gmail.com";
        //  $from=!empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->name:null;
        //   mail($to, $subject, $pdf, $headers, $from  );
     /******************* FOR PDF *******************/
     // create curl resource 
     
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://giveyourbit.com/index.php?r=fundraiser/sendreport&id=".$userd); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        //echo $output;
       
        // close curl resource to free up system resources 
        curl_close($ch); 
       sleep(10);   
     if($output){
     //echo $user_d;
     $body= file_get_contents("http://giveyourbit.com/index.php?r=fundraiser/sendreport&id=".$userd); 
     //echo "http://undergirl.co.uk/index.php?r=fundraiser/sendreport&id=$userd";
        $path=realpath('./')."/pdf/{$user_name}.pdf";
        $pdf = Yii::createComponent('application.extensions.tcpdf.tcpdf',
                'P', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Test");
            $pdf->SetTitle("Report");
            $pdf->SetSubject("Report");
            $pdf->SetKeywords("Test");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            //$pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont("times", "", 10);
            $pdf->writeHTML($output, true, false, false, false, '');
           $pdf->Output($path, "F");
           $file = realpath('./')."/pdf/{$user_name}.pdf"; 

           header("Content-Description: File Transfer"); 
           header("Content-Type: application/octet-stream"); 
           header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

            readfile ($file);
            exit(); 
           
          }
 }
 public function actionCreatexml(){
     $userd = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
     $user_name = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->name:null;
      $ch1 = curl_init(); 

        // set url 
        curl_setopt($ch1, CURLOPT_URL, "http://giveyourbit.com/index.php?r=fundraiser/sendreportxml&idxm=".$userd); 

        //return the transfer as a string 
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $outputxml = curl_exec($ch1); 
        //echo $output;
       
        // close curl resource to free up system resources 
        curl_close($ch1); 
         
        
           $pth1= realpath('./')."/xml/template.xls";
           $pth2= realpath('./')."/xml/{$user_name}.xls";
           copy($pth1,$pth2);
           file_put_contents($pth2, $outputxml);
           $file = realpath('./')."/xml/{$user_name}.xls"; 

           header("Content-Description: File Transfer"); 
           header("Content-Type: application/octet-stream"); 
           header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

            readfile ($file);
            exit();
 } 

   private function base64_url_encode($input) {
        return strtr(base64_encode($input), '+/=', '._-');
   }
   
   private function base64_url_decode($input) {
     return base64_decode(strtr($input, '._-', '+/='));
   }
 

         
    }
