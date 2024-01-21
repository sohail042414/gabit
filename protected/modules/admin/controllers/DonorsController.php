<?php

class DonorsController extends AdminCoreController
{

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 29;

    /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','admin','view'),
				'users'=>array('@'),
				'expression' => ($this->auth->canView($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression' => ($this->auth->canAdd($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('update','send_email','export'),
				'users'=>array('@'),
				'expression' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow', 
				'actions'=>array('delete'),
				'users'=>array('admin'),
				'expression' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionView($id)
    {
        $model=  $this->loadModel($id, 'Users');

        $sharesModel = new UserSocialShare();

        $sharesModel->user_id = $model->id;

        if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

        $this->render('view', array(
            'model' =>$model,
            'sharesModel' => $sharesModel
        ));
    }

    public function actionCreate()
    {

        $model = new Users;

        if (isset($_POST['Users'])) {

            $model->role = 'donor';        
            $model->setAttributes($_POST['Users']);

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            $model->password = md5($model->password);
            $model->confirm_password = md5($model->confirm_password);


            if ($model->save(false)) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                    Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Users');

        if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

        $old_password = $model->password;


        if (isset($_POST['Users'])) {
//            p($_POST['Users']);
            $model->setAttributes($_POST['Users']);

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
                if (!empty($model->password)) {
                    $model->password = md5($model->password);
                } else {
                    $model->password = $old_password;
                }

                if (!empty($model->password)) {
                    $model->confirm_password = md5($model->confirm_password);
                }
                if ($model->save(false)) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                        Yii::app()->end();
                    } else {
                        Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully updated."));
                        $this->redirect(array('view', 'id' => $model->id));
                    }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionNewentry()
    {
        $model = Yii::app()->db->createCommand()
            ->select('*')
            ->from('users')
            ->where("user_type = '2' AND created_date BETWEEN '" . date('Y-m-d H:i:s', strtotime('-1 day')) . "' AND created_date")
            ->queryAll();

        if (isset($_GET['Users']))
            $model->setAttributes($_GET['Users']);

        $this->render('newentry', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            
            RewardPoints::model()->deleteAll('user_id = :user_id', array('user_id'=> $id));

            $this->loadModel($id, 'Users')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {

        // $this->createReferralCodes();
        // exit;


        $model = new Users('search');
        $model->unsetAttributes();
        $model->role = 'donor';        

        if (isset($_GET['Users']))
            $model->setAttributes($_GET['Users']);

        $data_provider = $model->search();

        $users_count = Users::model()->count("status IN ('Y','N') AND role='donor'");

        $this->render('admin', array(
            'model' => $model,
            'data_provider' => $data_provider,
            'users_count' => $users_count,
        ));
    }


    public function actionSend_email()
    {

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl.'/js/admin/select2/select2.js'
        );

        Yii::app()->clientScript->registerCssFile(
            Yii::app()->baseUrl.'/js/admin/select2/select2.css'
        );


        $users = Users::model()->findAll("status IN ('Y') AND user_type=2");

        //$users_list = array('' => '-- Select User --');
        
        $users_list = array();

        foreach($users as $user){
            $users_list[$user->id] = $user->username;
        }

        $model = new UserEmailForm();
  
        if(isset($_POST['UserEmailForm'])){

            $model->setAttributes($_POST['UserEmailForm']);
            
            if($model->validate()){

                //Single User
                if(empty($model->to_all) && empty($model->to_active) && empty($model->to_inactive)){
                    $user = $this->loadModel($model->user_id, 'Users');
                    $this->send_email($user->email,$model->subject,$model->message,$model->message);                    
                }else if(empty($model->to_all)){

                    $all_users = Users::model()->findAll("user_type=2");

                    $user_emails = array();

                    foreach($all_users as $user){
                        $user_emails[$user->email] = $user->username;
                    }
 
                    $this->send_email($user_emails,$model->subject,$model->message,$model->message);                    

                }else if(empty($model->to_active)){

                    $all_users = Users::model()->findAll("status IN ('Y') AND user_type=2");

                    $user_emails = array();

                    foreach($all_users as $user){
                        $user_emails[$user->email] = $user->username;
                    }
 
                    $this->send_email($user_emails,$model->subject,$model->message,$model->message);                    

                }else if(empty($model->to_inactive)){

                    $all_users = Users::model()->findAll("status IN ('N') AND user_type=2");

                    $user_emails = array();

                    foreach($all_users as $user){
                        $user_emails[$user->email] = $user->username;
                    }
 
                    $this->send_email($user_emails,$model->subject,$model->message,$model->message);                    
                }

                Yii::app()->user->setFlash('success', "Email Sent Successfully!");
                $model->unsetAttributes();
            }
        }else{
            $model->message = '
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="background:#FFF; width:624px">
	<tbody>
		<tr>
			<td style="background-color:#098fc6; text-align:center">
			<p><strong><span style="color:#FFFFFF"><span style="font-size:16px">Giveyourbit</span></span></strong></p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<p>&nbsp;</p>

			<p> Greetings Here </p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<p>Type Your message here...</p>
			</td>
		</tr>
		<tr>
			<td>
			<p>Regards,</p>
			<p>The Giveyourbit fundraising support team.</p>
			</td>
		</tr>
		<tr>
			<td style="background-color:#098fc6">
			<p style="text-align:center"><span style="font-size:11px"><span style="color:#FFFFFF"><strong>&copy; 2022 Dajed RollOutTech All Rights Reserved</strong></span></span></p>
			</td>
		</tr>
	</tbody>
</table>
';
        }

        $this->render('send_email', array(
            'model' => $model,
            'users_list' => $users_list
        ));
    }


    private function createReferralCodes(){
        $donors = Users::model()->findAll("role= :role",array('role'=>'donor'));

        foreach($donors as $donor){
            $model = Users::model()->findByPk($donor->id);
            if(empty($model->referral_code)){
                $model->referral_code = $model->createReferralCode();
                if(!$model->save(false)){
                    echo 'Herer<br>'.__FILE__;
                    echo '<br>'.__LINE__;
                    echo '<pre>';
                    print_r($model->errors);
                    exit; 
                }
            }

        }
    }

}
