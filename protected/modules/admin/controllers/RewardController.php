<?php

class RewardController extends AdminCoreController
{
	
	public $resource_id = 28;

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
				'actions'=>array('index','admin','view','monthly','settings','declare'),
				'users'=>array('@'),
				'expression' => ($this->auth->canView($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('create','settings','declare'),
				'users'=>array('@'),
				'expression' => ($this->auth->canAdd($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('update','settings','declare'),
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

		/**
	 * Manages all models.
	 */
	public function actionAdmin($year=null)
	{

		if($year == null){
			$year = date('Y');
		}

		$model=new RewardPoints();

		$dataProvider = $model->getMonths($year);

		$yearsList = $model->getYears();

		$this->render('admin',array(
			'model' => $model,
			'dataProvider'=>$dataProvider,
			'year' => $year,
			'yearsList' => $yearsList
		));
	}

		/**
	 * Manages all models.
	 */
	public function actionMonthly($month,$year)
	{
		
		$model=new RewardPoints('search');
		$model->unsetAttributes(); 
		
		$dataProvider = $model->getMonthly($month,$year);

		if(isset($_GET['RewardPoints']))
			$model->attributes=$_GET['RewardPoints'];

		$this->render('monthly',array(
			'model'=>$model,
			'month' => $month,
			'year' => $year,
			'dataProvider' => $dataProvider
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$month=null,$year=null)
	{

		$user = Users::model()->findByPk($id);

		$model = new RewardPoints();
		
		$model->month = $month;
		$model->year = $year;
		$model->user_id= $id;

		$actionDataProvider = $model->search();
		$pointsDetails = $model->getPointsDetail();



		$this->render('view',array(
			'user' => $user,	
			'model' => $model,	
			'month' => $month,
			'year' => $year,	
			'actionDataProvider'=>$actionDataProvider,
			'pointsDetails' => $pointsDetails,
		));
	}



	/**
	 * Manages all models.
	 */
	public function actionDeclare($month,$year)
	{
		
		$model=new RewardPoints('search');
		$model->unsetAttributes(); 
		
		$dataProvider = $model->getMonthly($month,$year);

		$data = $dataProvider->getData();

		if(count($data) > 0 && isset($data[0])){

			$user = $data[0];

			$existing = RewardWinner::model()->find('month=:month AND year=:year',array(
				'month' => $month,
				'year' => $year,
			));

			if(!is_object($existing)){

				$reward_prize = Setting::model()->getBySettingKey('reward_prize');

				$winner = new RewardWinner();

				$winner->user_id = $user['id'];
				$winner->year = $year;
				$winner->month = $month;
				$winner->total_points = $user['total_points'];
				$winner->prize_amount = $reward_prize;
				$winner->save(false);
			}
		}

		$this->redirect(array('/admin/winner/admin'));

	}


	public function actionSettings(){

		$model=new Setting();

		if(isset($_POST['reward_date']) || isset($_POST['reward_prize'])){

			/*
			$obj_date = Setting::model()->find("setting_key='reward_date'");

			if(is_object($obj_date)){
				$obj_date->setting_value = $_POST['reward_date'];
				$obj_date->update(FALSE);				
			}
			*/

			$obj_prize = Setting::model()->find("setting_key='reward_prize'");

			if(is_object($obj_prize)){
				$obj_prize->setting_value = $_POST['reward_prize'];
				$obj_prize->update(FALSE);
				Yii::app()->user->setFlash('success', Yii::t("success", " Reward Settings updated successfully!"));
			}
						
		}


		$reward_date = $model->getBySettingKey('reward_date');
		$reward_prize = $model->getBySettingKey('reward_prize');

		$this->render('settings',array(
			'model'=>$model,
			'reward_date' => $reward_date,
			'reward_prize' => $reward_prize,
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RewardPoints;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RewardPoints']))
		{
			$model->attributes=$_POST['RewardPoints'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RewardPoints']))
		{
			$model->attributes=$_POST['RewardPoints'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->actionAdmin();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RewardPoints the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RewardPoints::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RewardPoints $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reward-points-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
