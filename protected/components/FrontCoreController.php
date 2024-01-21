<?php

use PHPMailer\PHPMailer\PHPMailer;
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontCoreController extends GxController
{

    public $layout = 'main';
    public $metaTitle;

    // public $defaultAction = 'admin';

    public function __construct($id, $module = null)
    {
        
        parent::__construct($id, $module);
        if (!$this->checkLogin() && $id == 'fundraise' && $id == 'user') {
            Yii::app()->frontUser->setFlash('error', Yii::t("error", " You are not authorized person."));
            $this->redirect(Yii::app()->createUrl('site/login'));
            Yii::app()->end();
        }

    }

    public function checkLogin()
    {
        if (!empty(Yii::app()->frontUser->id) && !empty(Yii::app()->frontUser->role) && in_array(Yii::app()->frontUser->role, array('fundraiser','supporter','donor'))) {
            return true;
        } else {
            return false;
        }
    }


    public function checkLoginOld()
    {
        if (!empty(Yii::app()->frontUser->id) && !empty(Yii::app()->frontUser->roleID)) {
            if(Yii::app()->frontUser->roleID == 2) {
                return true;
            } else {
                return false;
            }
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
             $mail->addAddress($to, '');  

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

    public function send_email__($to, $subject, $message)
    {   

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: giveyourbit.com' . "\r\n";
        // $headers .= 'Cc: testshailesh1@gmail.com' . "\r\n";

        if (mail($to,$subject,$message,$headers)) {
            return true;
        } else {
            return false;
        }

    }  
    public function send_email_old($to, $subject, $message)
    {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = 'developer.silicon@gmail.com';
        $mail->Password = 'nathing7896$';

        $mail->SetFrom('developer.silicon@gmail.com', 'MobiTrust');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => $this->get_access_rules(),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function get_access_rules()
    {
        $permission = array('');
        $controller = Yii::app()->controller->id;
        if (!empty($controller)) {
            $controller_model = SystemControllers::model()->findByAttributes(array('controller_name' => $controller, 'status' => 'Y'));
            if (!empty($controller_model)) {

                $system_role = SystemRoleBasePermission::model()->findByAttributes(array('role_id' => Yii::app()->frontUser->roleID, 'controller_id' => $controller_model->id, 'allow_all_actions' => 'Y', 'status' => 'Y'));
                if (!empty($system_role)) {
                    $system_actions = SystemActions::model()->findAllByAttributes(array('controller_id' => $controller_model->id, 'status' => 'Y'));
                    if (!empty($system_actions)) {
                        foreach ($system_actions as $system_actions_row) {
                            $permission[] = $system_actions_row->action_name;
                        }
                    }
                } else {
                    $system_role_single = SystemRoleBasePermission::model()->findAllByAttributes(array('role_id' => Yii::app()->frontUser->roleID, 'controller_id' => $controller_model->id, 'status' => 'Y', 'allow_all_actions' => 'N'));
                    if (!empty($system_role_single)) {
                        foreach ($system_role_single as $system_actions_row) {
                            $permission[] = $system_actions_row->action->action_name;
                        }
                    }
                }
            }
        }

        return $permission;
    }

    static public function check_permission($route)
    {
        if (!empty($route)) {
            $route_array = explode('/', $route);

            if (is_array($route_array)) {
                if (!empty($route_array[0]) && !empty($route_array[1])) {
                    $route_controller = $route_array[0];
                    $route_action = $route_array[1];

                    $controller_model = SystemControllers::model()->findByAttributes(array('controller_name' => $route_controller, 'status' => 'Y'));
                    if (!empty($controller_model)) {
                        $action_model = SystemActions::model()->findByAttributes(array('controller_id' => $controller_model->id, 'action_name' => $route_action, 'status' => 'Y'));
                        if (!empty($action_model)) {
                            $system_role = SystemRoleBasePermission::model()->findByAttributes(array('role_id' => Yii::app()->frontUser->roleID, 'controller_id' => $controller_model->id, 'allow_all_actions' => 'Y', 'status' => 'Y'));
                            if (!empty($system_role)) {
                                return true;
                            } else {
                                // p($action_model->id);
                                $system_role_single = SystemRoleBasePermission::model()->findByAttributes(array('role_id' => Yii::app()->frontUser->roleID, 'controller_id' => $controller_model->id, 'action_id' => $action_model->id, 'status' => 'Y', 'allow_all_actions' => 'N'));
                                // p($system_role_single->attributes);
                                if (!empty($system_role_single)) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function close_fancybox($redirect_url)
    {
        echo "<script type='text/javascript' src='" . Yii::app()->request->baseUrl . "/js/jquery.min.js'></script>
        <script type='text/javascript'>
                $(function() { parent.$.fancybox.close(); });
                window.parent.location.href = '" . $redirect_url . "';
                </script>";
	
    }
    /**
     * Returns an encrypted & utf8-encoded
     */
    public function encrypt($pure_string, $encryption_key)
    {
        if(Yii::app()->createAbsoluteUrl('/') == 'http://gabit.local/index.php'){
            return base64_encode($pure_string);
        }
        
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    /**
     * Returns decrypted original string
     */
    public function decrypt($encrypted_string, $encryption_key)
    {
        if(Yii::app()->createAbsoluteUrl('/') == 'http://gabit.local/index.php'){
            return base64_decode($encrypted_string);
        }

        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }

    function fb_count($url = '')
    {
        global $fbcount;
        $facebook = file_get_contents('http://api.facebook.com/restserver.php?method=links.getStats&urls=' . $url . '');
        $fbbegin = '<share_count>';
        $fbend = '</share_count>';
        $fbpage = $facebook;
        $fbparts = explode($fbbegin, $fbpage);
        $fbpage = $fbparts[1];
        $fbparts = explode($fbend, $fbpage);
        $fbcount = $fbparts[0];
        if ($fbcount == '') {
            $fbcount = '0';
        }
        return $fbcount;
    }

}
