<?php

use Yii;

class HomeSliderController extends AdminCoreController
{
    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 17;

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

    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'HomeSlider'),
        ));
    }

    public function actionCreate()
    {
        $model = new HomeSlider;

        if (isset($_POST['HomeSlider'])) {
            $model->setAttributes($_POST['HomeSlider']);


            if (isset($_FILES['HomeSlider']['name']['slider_image']) && !empty($_FILES['HomeSlider']['name']['slider_image'])) {
                $model->slider_image = $_FILES['HomeSlider']['name']['slider_image'];
                $model->slider_image = CUploadedFile::getInstance($model, 'slider_image');
            } else {
                $model->slider_image = $_POST['HomeSlider']['slider_image'];
            }
            if ($model->validate(array('slider_image'))) {
                
                if (isset($_FILES['HomeSlider']['name']['slider_image']) && !empty($_FILES['HomeSlider']['name']['slider_image'])) {
                    $file_extension = $model->slider_image->getExtensionName();
                    $random_filename = time() . rand(99999, 888888);
                    $image_name = $random_filename . "." . $file_extension;
                    $original_path = HOME_SLIDER_ORIGINAL . $image_name;

                    $model->slider_image->saveAs($original_path);
                    EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(HOME_SLIDER_THUMBNAIL . HOME_SLIDER_THUMB_NAME . $image_name);

                    $model->slider_image = $image_name;
                }


                if ($model->save()) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                        Yii::app()->end();
                    } else {
                        Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'HomeSlider');


        if (isset($_POST['HomeSlider'])) {
            $model->setAttributes($_POST['HomeSlider']);

            if (isset($_FILES['HomeSlider']['name']['slider_image']) && !empty($_FILES['HomeSlider']['name']['slider_image'])) {
                $model->slider_image = $_FILES['HomeSlider']['name']['slider_image'];
                $model->slider_image = CUploadedFile::getInstance($model, 'slider_image');
            } else {
                $model->slider_image = $_POST['HomeSlider']['slider_image'];
            }

            if (isset($_FILES['HomeSlider']['name']['slider_image']) && !empty($_FILES['HomeSlider']['name']['slider_image'])) {
                $file_extension = $model->slider_image->getExtensionName();
                $random_filename = time() . rand(99999, 888888);
                $image_name = $random_filename . "." . $file_extension;
                $original_path = HOME_SLIDER_ORIGINAL . $image_name;

                $model->slider_image->saveAs($original_path);
                EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(HOME_SLIDER_THUMBNAIL . HOME_SLIDER_THUMB_NAME . $image_name);

                $model->slider_image = $image_name;
            }

            if ($model->save(false)) {
                Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully updated."));
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'HomeSlider')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new HomeSlider('search');
        $model->unsetAttributes();

        if (isset($_GET['HomeSlider']))
            $model->setAttributes($_GET['HomeSlider']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}
