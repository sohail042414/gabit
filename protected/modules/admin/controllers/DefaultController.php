<?php

class DefaultController extends Controller
{
    public $resourceId = 6;

    public $layout = 'main_login';
    public $defaultAction = 'index';

    public function actionIndex()
    {

        $model = new AdminLoginForm;
        // if it is ajax validation request
        $this->pageTitle = Yii::app()->name . ' - Login';
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];

            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->createUrl('admin/dashboard'));
                Yii::app()->end();
            }
        }

        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionForgotpassword()
    {
        $this->pageTitle = Yii::app()->name . ' - Forgot Password';
        $model = new AdminForgotPassword;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-forgot-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminForgotPassword'])) {
            $model->attributes = $_POST['AdminForgotPassword'];
            $new_password = time() . rand('998', '898');

            $user_model = Users::model()->find("email=:email", array(':email' => $model->email));
            if (!empty($user_model)) {
                $user_model->password = md5($new_password);
                $user_model->save(false);
                $email_model = EmailTemplates::model()->findByPk('1');
                $email_template = $email_model->template;
                $email_template = str_replace('#USRFULLNAME#', $user_model->first_name . ' ' . $user_model->last_name, $email_template);
                $email_template = str_replace('#USERNAME#', $user_model->username, $email_template);
                $email_template = str_replace('#PASSWORD#', $new_password, $email_template);
                $this->send_email($user_model->email, $email_model->subject, $email_template);

                Yii::app()->user->setFlash('success', Yii::t("success", "Your new password has been successfully sent on your email.!"));
                $this->redirect(Yii::app()->createUrl('admin/default/index'));

            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "User does not found please try again later.!"));
                $this->redirect(Yii::app()->createUrl('admin/default/index'));
            }
        }

        $this->render('forgot_password', array('model' => $model));
    }

    public function ActionLockScreen()
    {
        if (!empty($_SESSION['locked_user_id'])) {
            $model = new AdminLoginForm;
            // if it is ajax validation request
            $this->pageTitle = Yii::app()->name . ' - Login';
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            // collect user input data
            if (isset($_POST['AdminLoginForm'])) {
                $model->attributes = $_POST['AdminLoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login()) {
                    $this->redirect(Yii::app()->createUrl('admin/dashboard'));
                    Yii::app()->end();
                } else {
                    unset($_SESSION['locked_user_id']);
                    Yii::app()->user->setFlash('error', Yii::t("error", "You have entered invalid password, please try again later.!"));
                    $this->redirect(Yii::app()->createUrl('admin/default'));
                }
            }
            // display the login form
            $this->renderPartial('/layouts/lock_screen', array('model' => $model));
        } else {
            $this->redirect(Yii::app()->createUrl('admin/default'));
        }

    }
}