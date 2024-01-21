<?php

use PHPMailer\PHPMailer\PHPMailer;

class UsersController extends FrontCoreController
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

    public function actionIndex(){
        echo "Herere"; exit;
    }


    public function actionCredentials()
    {

        echo '<pre>424324242424';
        print_r($_GET);
        exit; 

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
                $link = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('Site/Resetpassword', array('pk' => base64_encode($encrypted), 'code' => base64_encode($encrypt_code)));
                $email_template = str_replace('#ACTLINK#', $link, $email_template);
                $email_template = str_replace('#LINKONLY#', $link, $email_template);
                $email_template = str_replace('#CUR_YEAR#', date('Y'), $email_template);
                $this->send_email($model->email, $email_model->subject, $email_template);
                    Yii::app()->user->setFlash('success', Yii::t("success", "We've sent you an email with instructions on how to reset your password.
                Please check your email."));
                $this->redirect(Yii::app()->createUrl('Site/Forgotpassword', array('flag' => '1')));

            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Your entered email address is not registered with us. Please verify your email address."));
                $this->redirect(Yii::app()->createUrl('Site/Forgotpassword'));
            }
        }

        $this->render('forgot_password', array('model' => $model));
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



    public function actionResetpassword()
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
                    $this->redirect(Yii::app()->createUrl('Site/login', array('pk' => base64_encode($_REQUEST['pk']))));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t("error", "User does not found please try again later.!"));
                    $this->redirect(Yii::app()->createUrl('Site/Resetpassword', array('pk' => base64_encode($_REQUEST['pk']))));
                }
            } else {
                Yii::app()->frontUser->setFlash('success', Yii::t("success", "Oops, Reset password link has been expired."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        }
        $this->render('resetpassword', array('model' => $model));
    }

    
}