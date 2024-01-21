<?php

class DashboardController extends AdminCoreController
{

    public $resourceId = 5;

    public $defaultAction = 'index';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function actionIndex()
    {

        $counter_total = Yii::app()->db->createCommand()
        ->select('*')
        ->from('visiters')
        ->where('1=1')
        ->queryAll();

        $visitors_count = $counter_total[0]['counter'];
        $supporter_count = Supporter::model()->count("status IN ('Y','N')");
        $fundraiser_count = Fundraiser::model()->count();
        $active_fundraiser_count = Fundraiser::model()->count("status = 'Y'");
        $new_fundraiser_count = Fundraiser::model()->count("status_new = 'Y'");
        $users_count = Users::model()->count("status IN ('Y','N')");

        $model = new FundraiserType('search');
        
        $model->unsetAttributes();

        $this->render('dashboard',array(
            'visitors_count' => $visitors_count,
            'supporter_count' => $supporter_count,
            'fundraiser_count' => $fundraiser_count,
            'active_fundraiser_count' => $active_fundraiser_count,
            'new_fundraiser_count' => $new_fundraiser_count,
            'users_count' => $users_count,
            'model' => $model,
        ));
    }

    public function actionLogout()
    {
        //p($_SESSION);
        Yii::app()->user->logout(false);

        $this->redirect(Yii::app()->createUrl('admin/default'));
        Yii::app()->end();
    }

    public function actionLock()
    {
        $_SESSION['locked_user_id'] = Yii::app()->user->id;
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->createUrl('admin/default/lockScreen'));
        Yii::app()->end();
    }

    public function actionChangepassword()
    {
        $this->pageTitle = Yii::app()->name . ' - Change Password';
        $model = new AdminChangePassword();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-change-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['AdminChangePassword'])) {
            $current_password = md5($_POST['AdminChangePassword']['current_password']);
            $new_password = $_POST['AdminChangePassword']['new_password'];
            $user_model = Users::model()->find("password=:password and id=:id", array('password' => $current_password, 'id' => Yii::app()->user->id));
            if (!empty($user_model)) {
                $user_model->password = md5($new_password);
                $user_model->save(false);
                Yii::app()->user->setFlash('success', Yii::t("success", "Password has been changed successfully.."));
                $this->redirect(Yii::app()->createUrl('admin/dashboard/changepassword'));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Current Password is incorrect!"));
                $this->redirect(Yii::app()->createUrl('admin/dashboard/changepassword'));
            }
        }

        $this->render('change_password', array('model' => $model));
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

            $new_password = UtilityHtml::generate_password(6);

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
                $this->redirect(Yii::app()->createUrl('admin/dashboard/forgotpassword'));

            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "User does not found please try again later.!"));
                $this->redirect(Yii::app()->createUrl('admin/dashboard/forgotpassword'));
            }
        }

        $this->render('forgot_password', array('model' => $model));
    }
}