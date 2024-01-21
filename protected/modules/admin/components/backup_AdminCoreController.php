<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class backup_AdminCoreController extends GxController
{
    public $layout = 'main';
    public $defaultAction = 'admin';

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

    
        if ($this->checkLogin() && $id == 'default') {
            $this->redirect(Yii::app()->createUrl('admin/dashboard'));
            Yii::app()->end();
        } else if (!$this->checkLogin() && $id != 'default') {
            Yii::app()->user->setFlash('error', Yii::t("error", " You are not authorized person."));
            $this->redirect(Yii::app()->createUrl('admin/default'));
            Yii::app()->end();
        }

    }

    public function checkLogin()
    {

        if (!empty(Yii::app()->user->id) && !empty(Yii::app()->user->roleID)) {
            if(Yii::app()->user->roleID == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function send_email__Old($to, $subject, $message)
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

        $mail->SetFrom('developer.silicon@gmail.com', 'SilconItHub');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);
        if ($mail->Send()) {
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


    public function accessRules()
    {
        return array(
            array(
                'allow',
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

                $system_role = SystemRoleBasePermission::model()->findByAttributes(array('role_id' => Yii::app()->user->roleID, 'controller_id' => $controller_model->id, 'allow_all_actions' => 'Y', 'status' => 'Y'));
                if (!empty($system_role)) {
                    $system_actions = SystemActions::model()->findAllByAttributes(array('controller_id' => $controller_model->id, 'status' => 'Y'));
                    if (!empty($system_actions)) {
                        foreach ($system_actions as $system_actions_row) {
                            $permission[] = $system_actions_row->action_name;
                        }
                    }
                } else {
                    $system_role_single = SystemRoleBasePermission::model()->findAllByAttributes(array('role_id' => Yii::app()->user->roleID, 'controller_id' => $controller_model->id, 'status' => 'Y', 'allow_all_actions' => 'N'));
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

    public function check_permission($route)
    {

        if(strpos(strtolower($route),'mailtemplates') > 0){
            return true;
        }

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
                            $system_role = SystemRoleBasePermission::model()->findByAttributes(array('role_id' => Yii::app()->user->roleID, 'controller_id' => $controller_model->id, 'allow_all_actions' => 'Y', 'status' => 'Y'));
                            if (!empty($system_role)) {
                                return true;
                            } else {
                                // p($action_model->id);
                                $system_role_single = SystemRoleBasePermission::model()->findByAttributes(array('role_id' => Yii::app()->user->roleID, 'controller_id' => $controller_model->id, 'action_id' => $action_model->id, 'status' => 'Y', 'allow_all_actions' => 'N'));
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
}
