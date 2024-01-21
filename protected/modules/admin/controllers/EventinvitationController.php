<?php

class EventinvitationController extends AdminCoreController
{
    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 6;
	
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
				'actions'=>array('update'),
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		$model = $this->loadModel($id);

		if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EventInvitation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EventInvitation']))
		{
			$model->attributes=$_POST['EventInvitation'];
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

		if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

		if(isset($_POST['EventInvitation']))
		{
			$model->attributes=$_POST['EventInvitation'];
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
		$dataProvider=new CActiveDataProvider('EventInvitation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EventInvitation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EventInvitation']))
			$model->attributes=$_GET['EventInvitation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EventInvitation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EventInvitation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EventInvitation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-invitation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
