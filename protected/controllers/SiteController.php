<?php

use PHPMailer\PHPMailer\PHPMailer;

class SiteController extends FrontCoreController
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    // public function actionFake_login($id = 0){
    //     $_SESSION['front_id'] = 848;
    //     $_SESSION['front_username'] = 'Fake User';
    //     $_SESSION['front_role'] = 'donor';
        
    //     $this->actionIndex();
    // }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        $cms_model = Cms::model()->findbyPk('1');
        $Home_slider_model = HomeSlider::model()->findAll('status = "Y" ');        
        
        $types = FundraiserType::model()->findAll(array('condition'=>"status = 'Y'",'order' => 'id ASC'));
        
        //pass this prepared array to view.
        $categories = array();

        foreach($types as $category){
            $slug = $category->makeSlug();

            $fundraiser = Fundraiser::model()->find(array(
                'condition' => "ftype_id = :ftype_id AND status = :status AND feature_flag= 'Y'",
                'params' => array(
                    'ftype_id' => $category->id,
                    'status' => 'Y'
                ),
                'order' => 'id DESC'
            ));
            $description = '';
            
            if(strlen($category->type_description) >= 120){
                $description = substr($category->type_description, 0, 120) . '...'; 
            }else{                
                $description =  $category->type_description;
            }

            $case_no = 'Case No.: NA <br> Title: NA';
            $amount = '0 NGN';
            $percentage = '0 %';
            $days_left = '0 Days';

            $reward_star_image = '';

            if(is_object($fundraiser)){

                $image_url = $fundraiser->getImageURL();
                $case_no = 'Case No. '.$fundraiser->id. ": ".substr($fundraiser->fundraiser_title, 0, 20) . '...';
                $amount = $fundraiser->getGoalAmount();
                $percentage = $fundraiser->getDonationPercentage();
                $days_left = $fundraiser->getDaysLeft();
                //$case_title = '';

                $reward_star_image = $fundraiser->getRewardStartImage();
                
            }else if(!empty($category->image)){                
                $image_url = SITE_ABS_PATH_FUNDRAISER_IMAGE . $category->image;
            }else{
                $image_url = '/uploads/fundraiser_picture/original/1654005702333005.jpg';
            }

            //echo $amount; exit;

            $categories[] = array(                
                'category_title' => $category->fundraiser_type,
                'category_url' => $this->createUrl('fundraiser/category', array('id' => $category->id, 'category_name' => $slug)),
                'image_url' => $image_url,
                'reward_star_image' => $reward_star_image,
                'case_no' => $case_no, 
                'description' => $description,
                'amount' => $amount,
                'percentage' => $percentage,
                'days_left' => $days_left
            );
        }

    
        $this->render('index', 
            array(
                'page_content' => $cms_model->page_content, 
                'home_slider' => $Home_slider_model,
                'categories' => $categories,
                'TRDP_link' => $this->createUrl('/rewards/donors'), 
                'emblum_logo_path' => SITE_ABS_PATH.'images/emblum-logo.png', 
                'emblum_bg_path' => SITE_ABS_PATH.'images/emblum-bg.png'
            )
        );

    }

    /*
     * Displays the Signup page
     */
    public function actionCredentials(){

        $token = isset($_GET['token']) ? $_GET['token'] : '';

        $model = Users::model()->find('user_token = :user_token',array('user_token'=>$token));

        //It is like inserting new model. 
        //$model->scenario = 'insert';
        
        if(!is_object($model)){
			throw new CHttpException(404,'This request Cannot be processed, invalid token');
        }

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];                        
            if($model->validate()){
                $model->email_verification ='Y';
                $model->password = md5(trim($_POST['Users']['password']));

                if ($model->update()) {
                    Yii::app()->user->setFlash('success_message', 'You have successfuly created your login credentials, please login and continue with fundraisers.');                    
                    $this->redirect(array('site/login'));
                }
            }        
        }

        $model->password = '';

        $this->render('credentials', array('model' => $model));

    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        //updated_date
        //last_login_date
        if($this->checkLogin()){
            $this->redirect(array('site/index'));
        }

        $fb_config = Yii::app()->params['fb_config'];

        $fb = new \Facebook\Facebook([
            'app_id' => $fb_config['app_id'],
            'app_secret' => $fb_config['app_secret'],
            'default_graph_version' => $fb_config['default_graph_version'],            
        ]);

        $helper = $fb->getRedirectLoginHelper();        
        $scopes = ['email','publish_actions'];
        $redirect_url = 'https://giveyourbit.com/index.php/site/fb_login';                
        $fb_login_URL = $helper->getLoginUrl($redirect_url,$scopes);

        $model = new LoginForm();
        $this->performAjaxValidation($model);
        // if it is ajax validation request
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_COOKIE['rememberMe']) && !empty($_COOKIE['rememberMe'])) {
            $model->rememberMe = $_COOKIE['rememberMe'];
            $model->username = $_COOKIE['username'];
            $model->password = $_COOKIE['password'];
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {

                if ($_POST['LoginForm']['rememberMe'] == 1) {
                    setcookie("username", $_POST['LoginForm']['username'], time() + 3600);
                    setcookie("password", $_POST['LoginForm']['password'], time() + 3600);
                    setcookie("rememberMe", '1', time() + 3600);
                } else {
                    setcookie("username", $_POST['LoginForm']['username'], time() - 3600);
                    setcookie("password", $_POST['LoginForm']['password'], time() - 3600);
                    setcookie("rememberMe", '1', time() - 3600);
                }
                
                //$user_fundraiser_count = SetupFundraiser::model()->count("user_id = ".Yii::app()->frontUser->id." ");
                
                $user_model = Users::model()->findByPk(Yii::app()->frontUser->id);
               
                $user_model->checkReferralCode();

                if(isset($_SESSION['returnUrl']) && !empty($_SESSION['returnUrl'])){
                    $this->redirect(Yii::app()->createUrl($_SESSION['returnUrl']));
                }

                if($user_model->status_new =="Y"){
                    $this->redirect(Yii::app()->createUrl('account/update_profile'));
                }else {
                    $this->redirect(Yii::app()->createUrl('fundraise/index'));
                }

            } else {
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        }
        // display the login form
        $this->render('login', array(
            'model' => $model,
            'fb_login_URL' => $fb_login_URL
        ));
    }

    public function actionFbapilogin(){

        $output = array();

        $response = $_POST['response'];
        $tokenData = $_POST['tokenData'];
        $accessToken = $tokenData['authResponse']['accessToken'];

        if(isset($response['email']) && !empty($response['email'])){
            $model = Users::model()->find('email = :email',array('email'=>$response['email']));

            if(is_object($model)){
         
                //echo 'here2';die;
                Yii::app()->frontUser->setState('id', $model->id);
                Yii::app()->frontUser->setState('username', $model->username);
                Yii::app()->frontUser->setState('email', $model->email);
                Yii::app()->frontUser->setState('first_name', $model->first_name);
                Yii::app()->frontUser->setState('last_name', $model->last_name);
                Yii::app()->frontUser->setState('created_date', $model->created_date);
                Yii::app()->frontUser->setState('role', $model->userType->user_role);
                Yii::app()->frontUser->setState('roleID', $model->user_type);
                Yii::app()->frontUser->setState('front_name', !empty($model->first_name) ? $model->first_name : $model->username);
                //Yii::app()->frontUser->setState('mobi_type', $model->user_type);
                Yii::app()->frontUser->setState('user_type', $model->user_type);
                $output['status'] = true;
            }else{

                $user = new Users();
                $user->email = $response['email'];
                $user->username = $response['name'];
                $user->sex = 'F';
                $user->age = 18;
                $user->fb_access_token = $accessToken;
                $user->fb_payload = json_encode($tokenData);      
                $user->user_type = 2;          
                if($user->save(false)){
                    $output['status'] = true;
                }else{
                    $output['status'] = false;
                    $output['errors'] = $user->errors;
                }
            }

        }else{
            $output['errors'] = 'No email provided';
            $output['status'] = false;
        }

        echo json_encode($output);   
        
    }

    public function actionFbconnected(){

        $output = array();

        $response = $_POST['response'];
        $accessToken = $response['authResponse']['accessToken'];

        $model = Users::model()->find('fb_access_token = :fb_access_token',array('fb_access_token'=>$accessToken));

        if(is_object($model)){
         
            //echo 'here2';die;
            Yii::app()->frontUser->setState('id', $model->id);
            Yii::app()->frontUser->setState('username', $model->username);
            Yii::app()->frontUser->setState('email', $model->email);
            Yii::app()->frontUser->setState('first_name', $model->first_name);
            Yii::app()->frontUser->setState('last_name', $model->last_name);
            Yii::app()->frontUser->setState('created_date', $model->created_date);
            Yii::app()->frontUser->setState('role', $model->userType->user_role);
            Yii::app()->frontUser->setState('roleID', $model->user_type);
            Yii::app()->frontUser->setState('front_name', !empty($model->first_name) ? $model->first_name : $model->username);
            //Yii::app()->frontUser->setState('mobi_type', $model->user_type);
            Yii::app()->frontUser->setState('user_type', $model->user_type);
            $output['status'] = true;
        }else{
            $output['status'] = false;
        }

        echo json_encode($output);        
    }


  /**
     * Displays the login page
     */
    public function actionFb_login()    
    {       
        
        if(isset($_GET['error_code']) && isset($_GET['error_message']) && !empty($_GET['error_code']) && !empty($_GET['error_message'])){
            Yii::app()->user->setFlash('fb_error', $_GET['error_message']);
            $this->redirect('login');          
        }


        if(!isset($_GET['code']) || empty($_GET['code'])){
            Yii::app()->user->setFlash('fb_error', 'Facebook did not return code, unable to process request, try agaiin!');
            $this->redirect('login');          
        }

        $fb_config = Yii::app()->params['fb_config'];

        $fb = new \Facebook\Facebook([
            'app_id' => $fb_config['app_id'],
            'app_secret' => $fb_config['app_secret'],
            'default_graph_version' => $fb_config['default_graph_version'],            
          ]);

        if(isset($_SESSION['fb_access_token'])){
            $accessToken = $_SESSION['fb_access_token'];
        }else{

            $helper = $fb->getRedirectLoginHelper();                              
            $tempAccessToken = $helper->getAccessToken();
            $oAuth2Client = $fb->getOAuth2Client();
            
            $accessToken = $oAuth2Client->getLongLivedAccessToken($tempAccessToken);
            $_SESSION['fb_access_token'] = $accessToken;            
        }

        $fb->setDefaultAccessToken($accessToken);
    
        $fb_response = $fb->get('/me?fields=name,first_name,last_name,email');

        $fb_user = $fb_response->getGraphUser();
        
        if(isset($fb_user['email']) && !empty($fb_user['email'])){
  
            $local_user = Users::model()->find('email=:email',array(
                'email' => $fb_user['email']
            ));

            $model = new LoginForm();

            if(is_object($local_user)){

                $password = "_123".$fb_user['email'];
                $password_hash = md5($password);


                $model->rememberMe = 1;
                $model->username = $fb_user['email'];
                $model->password = $password;

                $local_user->fb_access_token = $accessToken;
                $local_user->save(FALSE);

            }else{

                $password = "_123".$fb_user['email'];
                $password_hash = md5($password);

                $digits = 5;
                $random_digit = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

                $user_name = trim($fb_user['first_name']."_".$fb_user['last_name']);
                $user_name = str_replace(" ","",$user_name);

                $new_user = new Users();
                $new_user->user_type = 2;    
                $new_user->status = 'Y'; 
                $new_user->username = $user_name;     
                $new_user->email = $fb_user['email'];
                $new_user->first_name = $fb_user['first_name'];
                $new_user->last_name = $fb_user['last_name'];
                $new_user->email = $fb_user['email'];
                $new_user->email_verification= 'Y';   
                $new_user->password = $password_hash;
                $new_user->user_token = $random_digit; 
                $new_user->created_date = date('Y-m-d h:i:s',time());
                $new_user->updated_date = date('Y-m-d h:i:s',time());
                $new_user->last_login_date = date('Y-m-d h:i:s',time());
                $new_user->age = 0;
                $new_user->request_verification = '1123';
                $new_user->fb_access_token = $accessToken;
                $new_user->save(false);

                // if(!$new_user->save(false)){
                //     echo '<pre>';
                //     print_r($new_user->errors);
                //     exit; 
                // }

                $model->rememberMe = 1;
                $model->username = $fb_user['email'];
                $model->password = $password;          
            }

            $model->login();
        }else{
            Yii::app()->user->setFlash('fb_error', 'You have not given access to email on faceboo, kindly allow access to your email and then try again');
            $this->redirect('login');
        }
        
        $this->redirect('index');

    }



    public function actionSharefb(){


        $id = 14;
        $fundraiser_object = $this->loadModel($id, 'SetupFundraiser');

        // echo '<pre>';
        // print_r($fundraiser_object);
        // exit; 

        //$image_url ='http://gabit.local/uploads/fundraiser_picture/original/1441710658526652.png';
        $image_url ='https://giveyourbit.com/uploads/fundraiser_picture/original/';

        $fb_config = Yii::app()->params['fb_config'];

        $fb = new \Facebook\Facebook([
            'app_id' => $fb_config['app_id'],
            'app_secret' => $fb_config['app_secret'],
            'default_graph_version' => $fb_config['default_graph_version'],            
        ]);


        //FB post content
        $message = $fundraiser_object->fundraiser_description;
        $title = $fundraiser_object->fundraiser_title;
        $link = 'https://giveyourbit.com/index.php/fundraiser/14/kidney_and_pancreas_transplant';
        $description = $fundraiser_object->fundraiser_description;
        
        //$picture = 'http://www.codexworld.com/wp-content/uploads/2015/12/www-codexworld-com-programming-blog.png';
        $picture = $image_url.$fundraiser_object->fundraiser_image;

        
        $attachment = array(
            'message' => $message,
            'name' => $title,
            'link' => $link,
            'description' => $description,
            'picture'=>$picture,
        );


        if(isset($_SESSION['fb_access_token'])){
            $accessToken = $_SESSION['fb_access_token'];
        }else{

            $user = Users::model()->findByPk($_SESSION['front_id']);
            $accessToken = $user->fb_access_token;            
            //$accessToken = $oAuth2Client->getLongLivedAccessToken($tempAccessToken);
            $_SESSION['fb_access_token'] = $accessToken;            
        }


        try{
            // Post to Facebook
            $fb->post('/me/feed', $attachment, $accessToken);
            
            // Display post submission status
            echo 'The post was published successfully to the Facebook timeline.';
        }catch(\Facebook\Exceptions\FacebookResponseException $e){
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        }catch(\Facebook\Exceptions\FacebookSDKException $e){
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

    }

    /*
     * Displays the Signup page
     */
    public function actionSignup()
    {
     
       $this->layout = 'main_pop';
       $model = new Users;
       //$this->performAjaxValidation($model);
     
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-signup-form') {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            
            //die();
            if ($model->validate()) {
                 //die();
                $digits = 5;
                $random_digit = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $model->user_token = $random_digit;
                $model->email_verification = 'N';
                $model->status_new = 'Y';
//              $model->email_verification = 'Y';
                $model->user_type = '2';
                $model->role = 'fundraiser';
                $model->password = md5(trim($_POST['Users']['password']));                

                if ($model->save(false)) {
                    $this->sendSignupMail($model);

                    Yii::app()->user->setFlash('error', Yii::t("error", "Sorry, the email and password you entered do not match. Please try again."));
                    echo FrontCoreController::close_fancybox(Yii::app()->createUrl('site/index',array('model' => $model,'flag' => '1')));
                    
                }
            }else{
                 $errors = $model->errors;
                 //print_r($errors);
            }
            
        }

        $this->render('signup', array('model' => $model));
    }

    private function sendSignupMail($model){

        $email_model = EmailTemplates::model()->find("short_code = 'ACTIVATE_ACCOUNT'");

        $email_template = $email_model->template;
        $email_template = str_replace('#USRFULLNAME#', ucfirst($model->username), $email_template);
        
        $link = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('Site/Authenticate', array('pk' => base64_encode($this->encrypt($model->id, ENCRYPTION_KEY)), 'user_code' => $model->user_token));
        $email_template = str_replace('#ACTLINK#', $link, $email_template);
        $email_template = str_replace('#LINKONLY#', $link, $email_template);
        $email_template = str_replace('#CUR_YEAR#', date('Y'), $email_template);

        //Create an instance; passing `true` enables exceptions
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


    public function actionTestemail(){

        //Create an instance; passing `true` enables exceptions
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

            //Recipients
            $mail->setFrom('information@giveyourbit.com', 'Giveyoubit');
            //$mail->addAddress('sohail042414@gmail.com', 'Sohail Maroof');  
            $mail->addAddress('daja@dajed.com', 'DJ Akporero');  
            $mail->addReplyTo('info@giveyourbit.com', 'Giveyourbit');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'This is test Email';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    /*
     * function for the user authentication
     */
    public function actionAuthenticate($pk, $user_code = "")
    {

        $decrypted = $this->decrypt(base64_decode($pk), ENCRYPTION_KEY);
         
        if ($user_code != "") {
            $user_model = Users::model()->findByPk($decrypted);
            $user_verified_data = Users::model()->find(array("select" => "id", "condition" => "id = " . $user_model->id . " AND user_token = '" . $user_code . "' and email_verification= 'N' "));
            if (!empty($user_verified_data)) {
                $user_verified_data->email_verification = 'Y';
                $user_verified_data->save(false);
                Yii::app()->user->setFlash('success', Yii::t("success", "Please login to continue"));
//                Yii::app()->user->setFlash('success', Yii::t("success", "Thank You! Your account has been verified successfully."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Oops, Verification link has expired."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        } else {
            Yii::app()->frontUser->setFlash('success', Yii::t("success", "Oops, Verification link has expired."));
            $this->redirect(Yii::app()->createUrl('site/login'));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->frontUser->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionLocate_fundraiser()
    {
      /*  $record = '';
        if (!empty($_POST['SetupFundraiser']['search_field'])) {
            $record = $_POST['SetupFundraiser']['search_field'];
        } else {
            $record = 'Result not found';
        }
        $this->render('locate_fundraiser', array('keyword' => $record));*/

	$record = '';
        if (!empty($_POST['SetupFundraiser']['search_field'])) {
            $record = $_POST['SetupFundraiser']['search_field'];
        } else {
            $record = 'Result not found';
        }

        if (!empty($_POST['search'])) {
            $record = $_POST['search'];
        } else {
            $record = 'Result not found';
        }
        $this->render('locate_fundraiser', array('keyword' => $record));
    }

    public function actionNewsletter()
    {
        if (!empty($_REQUEST['email'])) {
            $check_exist = Newsletter::model()->find(array('select' => '*', 'condition' => 'Newsletter_email = "' . $_REQUEST['email'] . '" '));
            if (!empty($check_exist)) {
                echo "You have already Subscribed!";
            } else {
                $check_exist = new Newsletter();
                $check_exist->Newsletter_email = $_REQUEST['email'];
                if ($check_exist->save(false)) {
                    echo "You have successfully subscribed";
                }
            }
        }
    }

    public function actionViewmore()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;
        $fundraiser = Yii::app()->db->createCommand()
            ->select('set.*,fund.fundraiser_type')
            ->from('setup_fundraiser as set')
            ->join('fundraiser_type as fund', 'fund.id = set.ftype_id')
            ->where('set.fundraiser_title like :val1 OR set.fundraiser_description like :val2 ', array(':val1' => '%' . $_REQUEST['keyword'] . '%', ':val2' => '%' . $_REQUEST['keyword'] . '%'))
            ->andwhere('search_status = "Y" ')
            ->andwhere('set.status = "Y"')
            ->order('id ASC')
            ->offset($page_start)
            ->limit($page_end)
            ->queryAll();
        $this->renderPartial('/layouts/viewmoreSearch', array('fundraiser' => $fundraiser, 'max_id' => $max_id));
    }

    public function actionTestimonials()
    {
        
        $this->render('testimonials', array('data' => $record));
    }
    
    public function actionNotifications()
    {   
        if (!$this->checkLogin()) {
            $this->redirect(Yii::app()->createUrl('site/login'));
            Yii::app()->end();
        }

        $current_user_id = !empty(Yii::app()->frontUser->id) ? Yii::app()->frontUser->id : null;
        $notifications_arr = array();
        $notifications_arr_to_all = array();
        $notifications = null;
        if (!empty($current_user_id)) {
            $user_detail = Users::model()->find(array('condition' => 'id=' . $current_user_id . '  AND status="Y"'));
            //p($user_detail->created_date);

            $notifications = Notifications::model()->findAll(array('condition' => '(from_id=' . $current_user_id . ' OR to_id=' . $current_user_id . ' OR  is_sent_to_all="Y" ) AND status="Y"','order'=>'created_date DESC'));

            foreach ($notifications as $key_n1 => $val_n1) {
                if ($val_n1->is_sent_to_all = "Y") {
                    //p($val_n1->created_date,0);
                    //echo(strtotime($val_n1->created_date) . "<br>");
                    //p($user_detail->created_date);
                    if (strtotime($val_n1->created_date) > strtotime($user_detail->created_date)) {
                        if (!empty($notifications)) {
//                            foreach ($notifications as $key_n => $val_n) {
//                                p($val_n->attributes,0);
//                            }
//                            exit;
                            foreach ($notifications as $key_n => $val_n) {

                                
                                $notifications_arr[$key_n]['noti_date'] = $val_n->attributes['created_date'];
                                $notifications_arr[$key_n]['user_date'] = $user_detail->created_date;

                                $unread_notifications_count = NotificationsComment::model()->count(array('condition' => 'notification_id=' . $val_n->id . ' AND to_id=' . $current_user_id . ' AND is_read="N" AND status="Y"'));
                                $unread_notifications_count1 = SendallNotifications::model()->count(array('condition' => 'notification_id=' . $val_n->id . ' AND user_id=' . $current_user_id . '  AND is_read="N" '));
                                //p($unread_notifications_count1);die;
                                if($unread_notifications_count1 != 0){
                                $unread_notifications_count = $unread_notifications_count + $unread_notifications_count1;
                                }
                                $notifications_arr[$key_n]['data'] = $val_n->attributes;
                                if ($current_user_id == $val_n->to_id && $val_n->is_read == 'N') {
                                    $unread_notifications_count = $unread_notifications_count + 1;
                                }
                                /* DATE 1  july 
                                if ($val_n->to_id == Null && $current_user_id == $val_n->from_id && $val_n->is_read == 'N') {

                                    $unread_notifications_count = $unread_notifications_count + 1;
                                }
                                 ENDS */
                                $notifications_arr[$key_n]['count'] = $unread_notifications_count;
                            }
                        }
                    }
                }
            }
            //exit;
//            $user = Yii::app()->db->createCommand()
//                ->select('id, username, profile')
//                ->from('tbl_user u')
//                ->join('tbl_profile p', 'u.id=p.user_id')
//                ->where('id=:id', array(':id'=>$id))
//                ->queryRow();
//            //p($notifications);
//             foreach($notifications as $key_n => $val_n) {
//              p($val_n->attributes,0);   
//             }
//            
            //  exit;
            //$notifications = Notifications::model()->findAll(array('condition' => ' status="Y"  AND to_admin="Y"'));
//            if(!empty($notifications)) {
//                foreach($notifications as $key_n => $val_n) {
//                    
//                    
//                    $unread_notifications_count = NotificationsComment::model()->count(array('condition' => 'notification_id='.$val_n->id.' AND to_id='.$current_user_id.' AND is_read="N" AND status="Y"'));
//                    $unread_notifications_count1 = SendallNotifications::model()->count(array('condition' => 'notification_id='.$val_n->id.' AND user_id='.$current_user_id.'  AND is_read="N" '));
//                    //p($unread_notifications_count1);die;
//                    $unread_notifications_count=$unread_notifications_count+$unread_notifications_count1;
//                    $notifications_arr[$key_n]['data'] = $val_n->attributes;                    
//                    if($current_user_id == $val_n->to_id  && $val_n->is_read == 'N' ) {
//                        $unread_notifications_count = $unread_notifications_count  + 1;
//                        
//                    }
//                    /*DATE 1  july*/
//                    if ($val_n->to_id == Null && $current_user_id == $val_n->from_id && $val_n->is_read == 'N'){
//			
//                        $unread_notifications_count = $unread_notifications_count  + 1;
//		    }
//                    /* ENDS*/
//                    $notifications_arr[$key_n]['count'] = $unread_notifications_count;
//                }
//            }
        }
        
        
        foreach($notifications_arr as $final_key => $final_val){
            
            if(strtotime($final_val['noti_date']) > strtotime($final_val['user_date']))
                {
                $final_arr[$final_key]['data'] = $final_val['data'];
                $final_arr[$final_key]['count'] = $final_val['count'];
            }
 	   
  	   $unread_s_l_noti_count = NotificationsComment::model()->count(array('condition' => 'notification_id=' . $final_val['data']['id'] . ' AND status="Y"'));

            if (!empty($final_val['data']['from_id']) && !empty($final_val['data']['to_id']) && $unread_s_l_noti_count > 0) {
                if ($final_val['data']['from_id'] == $current_user_id) {
                    $final_arr[$final_key]['data'] = $final_val['data'];
                    $final_arr[$final_key]['count'] = $final_val['count'];
                }
            }

            if (!empty($final_val['data']['from_id']) && !empty($final_val['data']['to_id']) && $unread_s_l_noti_count == 0) {
                if ($final_val['data']['from_id'] == $current_user_id) {
                    $final_arr[$final_key]['data'] = $final_val['data'];
                    $final_arr[$final_key]['count'] = $final_val['count'];

                    $final_arr[$final_key] = array_splice($final_arr, $final_val);
                }
            }
        }
       /* $new_final_arr = array();
        $new_final_arr = array_values($final_arr);*/
      
        $final_arr1 = array_filter($final_arr);
        
        $new_final_arr = array();
        $new_final_arr = array_values($final_arr1);

        $this->render('notifications', array(
            
            'notifications_arr' => $new_final_arr,
        ));
    
    }
    
    public function actionNotificationdetail($id)
    {   
        if (!$this->checkLogin()) {
            $this->redirect(Yii::app()->createUrl('site/login'));
            Yii::app()->end();
        }

        $notification_model = new Notifications();
        $notifications_comment_model = new NotificationsComment();
        
        $current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
        
        $unread_notifications = NotificationsComment::model()->findAll(array('condition' => 'notification_id='.$id.' AND to_id='.$current_user_id.' AND is_read="N" AND status="Y"'));
        if(!empty($unread_notifications)) {
            foreach($unread_notifications as $key_un => $val_un) {
                $val_un->is_read = 'Y';
                $val_un->save();
            }
        }
        
        $unread_notifications_notification = Notifications::model()->findAll(array('condition' => 'id='.$id.' AND to_admin="N"  AND is_read="N" AND status="Y" '));
        //p($unread_notifications_notification);die;
        if(!empty($unread_notifications_notification)) {
                foreach($unread_notifications_notification as $key_un1 => $val_un1) {
                    $val_un1->is_read = 'Y';
                    //p($val_un1);die;
                    $val_un1->save();
                }
            }
        
            
        $notification_detail= Notifications::model()->find(array('condition' => 'id='.$id.' '));
        //p($notification_detail);die;
        if($notification_detail->from_id=='' && $notification_detail->to_id=='' && $notification_detail->is_sent_to_all=='Y'){    
            //echo "ajit";die;
            $sendall_notifications = SendallNotifications::model()->find(array('condition' => ' notification_id='.$id.' AND user_id='.$current_user_id.' '));
            //p($sendall_notifications);die;
            //echo $sendall->id;die;
            $send_all_message_id=$sendall_notifications->id;
            $unread_notifications_to_all = SendallNotifications::model()->findAll(array('condition' => ' id='.$send_all_message_id.' AND  user_id='.$current_user_id. ' AND is_read="N" '));
            //p($unread_notifications_to_all);die;
            if(!empty($unread_notifications_to_all)) {
                    foreach($unread_notifications_to_all as $key_un2 => $val_un2) {
                        $val_un2->is_read = 'Y';
                        //p($val_un2);die;
                        $val_un2->save();
                    }
                }
            
       }
        
        $notification_data = Notifications::model()->find(array('condition' => 'id='.$id.' AND status="Y"'));
        $notifications_comments_data = NotificationsComment::model()->findAll(array('condition' => 'notification_id='.$id.' AND status="Y" '));
        //p($notifications_comment_model, 0); p($notification_data, 0); p($notifications_comments_data);
        if(!empty($_POST['NotificationsComment'])) {
            $notifications_comment_model->notification_id = $id;
            $notifications_comment_model->comment = $_POST['NotificationsComment']['comment'];
            if($notifications_comment_model->validate()) {
                $notifications_comment_model->from_id = $current_user_id;
                $notifications_comment_model->from_admin = 'N';
                $notifications_comment_model->to_id = null;
                $notifications_comment_model->to_admin = 'Y';
                if(!empty($notification_data->to_id) && !empty($notification_data->from_id)){
                    if($notification_data->to_id == $current_user_id){
                        $notifications_comment_model->to_id = $notification_data->from_id ;
                    }
                    if($notification_data->from_id == $current_user_id){
                        $notifications_comment_model->to_id = $notification_data->to_id ;
                    }
                }
                $notifications_comment_model->save(false);
                Yii::app()->frontUser->setFlash('success', Yii::t("success", "You have successfully send notification."));
            } else {
                Yii::app()->frontUser->setFlash('success', Yii::t("error", "Something went wrong!"));
            }
            
            $this->redirect(Yii::app()->createUrl('site/notificationdetail', array('id' => $id)));
        }
        
        $this->render('notificationdetail', array(
            'notification_model' => $notification_model,
            'notifications_comment_model' => $notifications_comment_model,
            'notification_data' => $notification_data,
            'notifications_comments_data' => $notifications_comments_data
        ));
    }
    
    public function actionSend_notifications()
    {
        $send_notification_form = new SendNotificationForm();
        $notification = new Notifications();
        $notifications_comment = new NotificationsComment();
                
        if(!empty($_POST['SendNotificationForm'])) {
           
            //p($_POST['SendNotificationForm']);
            $send_notification_form->setAttributes($_POST['SendNotificationForm']);
            $current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
            $notification->subject = $send_notification_form->subject;
            $notification->name = $send_notification_form->name;
            $notification->email = $send_notification_form->email;
            $notification->message = $send_notification_form->message;
            $notification->from_id = $current_user_id;
            $notification->from_admin = 'N';
            $notification->to_admin = 'Y';
            $notification->is_read = 'N';
            $notification->to_type = 'A';
            $notification->from_type = 'L';
            if($notification->save(false)) {
               //  print_r($_POST['SendNotificationForm']);
           // die();
               // Yii::app()->frontUser->setFlash('success', Yii::t("success", "You have successfully send notification."));
                 Yii::app()->user->setFlash('success', Yii::t("success", "You have successfully sent notification."));
                $this->redirect(Yii::app()->createUrl('site/send_notifications'));
            } else {
                Yii::app()->frontUser->setFlash('error', Yii::t("error", "Something went wrong!"));
            }
        }
        
        $this->render('send_notifications', array(
            'send_notification_form' => $send_notification_form
        ));
    }

    public function actionAutocomplete($term) {
        $term = $_GET['term'];

        $limit = 5;
        $criteria = new CDbCriteria;
        $criteria->condition = "(fundraiser_title LIKE :match OR id=:id OR benifiry_name LIKE :match ) AND search_status = 'Y'" ;
        $criteria->params = array(
            ":match" => "%$term%",
            "id" => (int) $term
        );
        $criteria->limit = $limit;
        $query = SetupFundraiser::model()->findAll($criteria);


        $list = array();
        foreach ($query as $q) {
           // $yes= $q['search_yes'];
            $data['value'] = $q['id'];
            $data['label'] = $q['fundraiser_title'];
            //$data['label'] = 'Case No :'.$q['id'].', '.$q['fundraiser_title'];
            $list[] = $data;
            unset($data);
        }

        echo json_encode($list);
    }
}