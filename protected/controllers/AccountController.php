<?php

use PHPMailer\PHPMailer\PHPMailer;

class AccountController extends FrontCoreController
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

    public function actionPassword(){
        
        // $user_id = 785;
        // $user = Users::model()->findByPK($user_id);
        // $password = md5('12345.com');
        // $user->password = $password;
        // //$user->confirm_password =  $password;
        // $user->status = 'Y';

        // if($user->update(FALSE)){
        //     echo "done";
        // }else4{
        //     echo 'Herer<br>'.__FILE__;
        //     echo '<br>'.__LINE__;
        //     echo '<pre>';
        //     print_r($user->errrors);
        //     exit; 
        // }

        // echo $user_id; exit;

        $this->layout = 'main_popup';

        $model = new CreatePassword();

        $status = false;

        if(isset($_POST['CreatePassword'])){

            $user_id = Yii::app()->frontUser->getState('id');
            $user = Users::model()->findByPK($user_id);

            $model->attributes = $_POST['CreatePassword'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
            
                $password = md5($model->password);
                $user->password = $password;
                //$user->email_verification = 'Y';
                $user->status = 'Y';
                if($user->update()){
                    unset($_SESSION['front_ask_password']);
                    $this->sendSignupMail($user);
                    $status = TRUE;                    
                    Yii::app()->frontUser->setFlash('success', 'Password created successfuly!');
                }else{
                    Yii::app()->frontUser->setFlash('success', 'There was some error, please try again later!');
                }
            }

        }

        $this->render('password', array(
            'model' => $model,
            'status' => $status
        ));

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

    public function actionProfile()
    {

        if(!$this->checkLogin()){
            $this->redirect(array('site/index')); 
        }

        $user_id= Yii::app()->frontUser->id;        
        $user = Users::model()->findByPk($user_id);        

        $this->render('profile', array('user' => $user));
    }

    public function actionUpdate_profile()
    {
        $user_id= Yii::app()->frontUser->id;        
        $user_data = Users::model()->findByPk($user_id);        
        $model = new Users;

        if (isset($_POST['Users'])) {

            //$exist_record = Users::model()->find(array("select" => "*", "condition" => "username = '" . $_POST['Users']['username'] . "' OR email = '" . $_POST['Users']['email'] . "' "));
           $exist_record = Users::model()->find(array("select" => "*", "condition" => "username = '" . $_POST['Users']['username'] . "' "));
            if (!empty($exist_record) && $user_data->username != $exist_record->username && $user_data->email != $exist_record->email ) {
                Yii::app()->user->setFlash('success', Yii::t("success", "Data already exist."));
                $this->redirect(array('updateprofile', 'id' => $_REQUEST['id']));
            } else {
                $user_data->username = $_POST['Users']['username'];
            	  $user_data->age = $_POST['Users']['age'];
                $user_data->sex = $_POST['Users']['sex'];
                $user_data->status_new = 'NULL';

                if(!empty($_POST['Users']['password'])){
                     $user_data->password = md5($_POST['Users']['password']);
                }
                
                if(!empty($_FILES['Users']['name']['user_image'])){
                  $user_data->user_image = $_FILES['Users']['name']['user_image'];
                  $user_data->user_image = CUploadedFile::getInstance($user_data, 'user_image');
                }
                
                if ($model->validate(array('user_image'))) {
                  
                    if (isset($_FILES['Users']['name']['user_image']) && !empty($_FILES['Users']['name']['user_image'])) {

                      $file_extension5 = $user_data->user_image->getExtensionName();
                      $random_filename5 = time() . rand(99999, 888888);
                      $image_name5 = $random_filename5 . "." . $file_extension5;
                      $original_path5 = PROFILE_PICTURE_ORIGINAL . $image_name5;
                      $user_data->user_image->saveAs($original_path5);
                      EWideImage::load($original_path5)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(USER_IMAGE_THUMBNAIL . USER_IMAGE_THUMB_NAME . $image_name5);
                      $user_data->user_image = $image_name5;                    
                  }

                }

                if ($user_data->save(false)) {
                    Yii::app()->frontUser->setState('username', $user_data->username);
                    Yii::app()->user->setFlash('success', Yii::t("success", "Profile updated successfully ."));
                    $this->redirect(array('update_profile'));
                }
            }
        }

        $this->render('update_profile', array('model' => $model, 'user' => $user_data));
    }


    public function actionForgot_password()
    {

        $this->pageTitle = ' - Forgot Password';
        $model = new Users();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-forgot-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $new_password = UtilityHtml::generate_password();

            $user_model = Users::model()->find("email=:email", array(':email' => $model->email));
            if (!empty($user_model)) {
                $user_model->request_verification = md5($new_password);
                $user_model->save(false);
                $email_model = EmailTemplates::model()->findByPk('6');
                $email_template = $email_model->template;
                $email_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $email_template);
                $encrypted = $this->encrypt($user_model->id, ENCRYPTION_KEY);
                $encrypt_code = $this->encrypt($new_password, ENCRYPTION_KEY);
                $link = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('account/reset_password', array('pk' => base64_encode($encrypted), 'code' => base64_encode($encrypt_code)));
                $email_template = str_replace('#ACTLINK#', $link, $email_template);
                $email_template = str_replace('#LINKONLY#', $link, $email_template);
                $email_template = str_replace('#CUR_YEAR#', date('Y'), $email_template);
                $this->send_email($model->email, $email_model->subject, $email_template);
                    Yii::app()->user->setFlash('success', Yii::t("success", "We've sent you an email with instructions on how to reset your password.
                Please check your email."));
                $this->redirect(Yii::app()->createUrl('account/forgot_password', array('flag' => '1')));

            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Your entered email address is not registered with us. Please verify your email address."));
                $this->redirect(Yii::app()->createUrl('account/forgot_password'));
            }
        }

        $this->render('forgot_password', array('model' => $model));
    }

    public function actionReset_password()
    {
        $model = new ChangePassword();

        $decrypted = $this->decrypt(base64_decode($_REQUEST['pk']), ENCRYPTION_KEY);
        $verify_code = $this->decrypt(base64_decode($_REQUEST['code']), ENCRYPTION_KEY);

        $authenticate_url = Users::model()->find(array("select" => "*", "condition" => "id = '".$decrypted."' AND request_verification = '" . md5($verify_code) . "' "));
        if (empty($authenticate_url)) {
            Yii::app()->user->setFlash('success', Yii::t("success", "Oops, Reset password link has been expired."));
            $this->redirect(Yii::app()->createUrl('site/login'));
        }
        if (!empty($_POST['ChangePassword'])) {
            if ($decrypted != "") {
                $user_model = Users::model()->findByPk($decrypted);
                $new_password = $_POST['ChangePassword']['new_password'];
                $user_model = Users::model()->find("id=:id", array('id' => $decrypted));
                if (!empty($user_model)) {
                    $user_model->password = md5($new_password);
                    $user_model->request_verification = '';
                    $user_model->save(false);
                    Yii::app()->user->setFlash('success', Yii::t("success", "Password has been changed successfully.."));
                    $this->redirect(Yii::app()->createUrl('site/login'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t("error", "User does not found please try again later.!"));
                    $this->redirect(Yii::app()->createUrl('account/reset_password', array('pk' => base64_encode($_REQUEST['pk']))));
                }
            } else {
                Yii::app()->frontUser->setFlash('success', Yii::t("success", "Oops, Reset password link has been expired."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        }
        $this->render('reset_password', array('model' => $model));
    }

}