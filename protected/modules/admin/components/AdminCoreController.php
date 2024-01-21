<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminCoreController extends GxController
{
    public $layout = 'main';
    public $defaultAction = 'admin';
    public $auth = null;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        
        //set ck editor settings
        $_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
        if(!empty(Yii::app()->user->id)) {
            $_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl."/uploads/kcfinder_pictures/backend_".Yii::app()->user->id."/"; // URL for the uploads folder
            $_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath."/../uploads/kcfinder_pictures/backend_".Yii::app()->user->id."/"; // path to the uploads folder
        } else {
            $_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl."/uploads/kcfinder_pictures/global/"; // URL for the uploads folder
            $_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath."/../uploads/kcfinder_pictures/global/"; // path to the uploads folder
        }

        if (!$this->checkLogin()) {
            Yii::app()->user->setFlash('error', Yii::t("error", " You are not authorized person!"));
            $this->redirect(Yii::app()->createUrl('admin/default'));
            Yii::app()->end();
        }

        $this->auth = new Auth();
    
    }

    public function checkLogin()
    {
        if (!empty(Yii::app()->user->id) && !empty(Yii::app()->user->role) && in_array(Yii::app()->user->role,array('super_user','admin_user'))) {
            return true;
        } else {
            return false;
        }
    }

    public function send_email($to, $subject, $html_body,$text_body=''){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'giveyourbit.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication         
            $mail->Username   = 'donotreply@giveyourbit.com';                     //SMTP username
            $mail->Password   = 'b7pqzaX9nUNg'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //From Email Address
            $mail->setFrom('donotreply@giveyourbit.com', 'Giveyoubit');
            //Recepients   
            
            if(is_array($to)){
                foreach($to as $email_address => $name){
                    $mail->addAddress($email_address, $name);  
                }
            }else{
                $mail->addAddress($to, '');  
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            //$mail->Subject = 'This is test Email';
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->Subject = $subject;

            $mail->Body = $html_body;
            $mail->AltBody = !empty($text_body) ? $text_body : $html_body;
            $mail->send();

            //echo 'Message has been sent';
        } catch (\Exception $e) {
            // echo '<pre>';
            // print_r($e);
            // exit; 
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    public function check_permission($route)
    {
        return true;
    }

}
