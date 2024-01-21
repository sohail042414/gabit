<?php

class GroupsController extends AdminCoreController
{

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 24;

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
				'expression' => ($this->auth->user->role =='super_user') ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression' => ($this->auth->user->role =='super_user') ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression' => ($this->auth->user->role =='super_user') ? '1' : '0',
			),
			array(
				'allow', 
				'actions'=>array('delete'),
				'users'=>array('admin'),
				'expression' => ($this->auth->user->role =='super_user') ? '1' : '0',
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

		$group = $this->loadModel($id);

		$resources_list = Resources::model()->findAll();

		$resources = array();

		foreach($resources_list as $obj){
			$resources[$obj->resource_id] = array(
				'resource_id' => $obj->resource_id,
				'name' => trim($obj->name),
				'can_view' => 0,
				'can_add' => 0,
				'can_update' => 0,
				'can_delete' => 0,
			);			
		}

		if(isset($_POST['data'])){

			foreach($_POST['data'] as $resource_id => $data){

				$model = Permissions::model()->find('group_id = :group_id AND resource_id = :resource_id',array('group_id'=> $id,'resource_id'=> $resource_id));

				if(!is_object($model)){
					$model = new Permissions();
					$model->resource_id = $resource_id;
					$model->group_id = $group->id;
				}

				$model->can_view = $data['can_view'];
				$model->can_add = $data['can_add'];
				$model->can_update = $data['can_update'];
				$model->can_delete = $data['can_delete'];

				$model->save(false);

			}

		}


		$group_permissions = Permissions::model()->findAll('group_id = :group_id',array('group_id'=> $id));

		foreach($group_permissions as $permission){
			$resources[$permission->resource_id]['can_view'] = $permission->can_view; 
			$resources[$permission->resource_id]['can_add'] = $permission->can_add; 
			$resources[$permission->resource_id]['can_update'] = $permission->can_update; 
			$resources[$permission->resource_id]['can_delete'] = $permission->can_delete; 
		}

		$dataProvider = new CArrayDataProvider($resources, array(
			'id'=>'resources',
			'keyField' => 'resource_id', 
			//'keys'=>array('resource_id','name', 'can_view', 'can_add', 'can_update','can_delete'),
			'sort'=>array(
				'attributes'=>array(
					'name'
				),
			),
			'pagination'=>array(
				'pageSize'=>100,
			),
		));



		$this->render('view',array(
			'group'=>$group,
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Groups;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Groups']))
		{
			$model->attributes=$_POST['Groups'];
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

		if(isset($_POST['Groups']))
		{
			$model->attributes=$_POST['Groups'];
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
		$dataProvider=new CActiveDataProvider('Groups');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Groups('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Groups']))
			$model->attributes=$_GET['Groups'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Groups the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Groups::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Groups $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='groups-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
