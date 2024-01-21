<?php

class CmsController extends AdminCoreController {

	/**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 3;

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

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Cms'),
		));
	}

	public function actionCreate() {
		$model = new Cms;
		if (isset($_POST['Cms'])) {
                    
			$model->setAttributes($_POST['Cms']);
                       
                        if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest()) {
					Yii::app()->end();
				} else {
					Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully created."));
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Cms');


		if (isset($_POST['Cms'])) {
			$model->setAttributes($_POST['Cms']);

			if ($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully updated."));
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {

		throw new CHttpException(400, Yii::t('app', 'Deleting CMS pages is not allowed!'));

		/*
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Cms')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
		*/
	}

	public function actionAdmin() {
		$model = new Cms('search');
		$model->unsetAttributes();

		if (isset($_GET['Cms']))
			$model->setAttributes($_GET['Cms']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}