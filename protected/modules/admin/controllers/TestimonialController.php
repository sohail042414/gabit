<?php

class TestimonialController extends AdminCoreController
{

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 20;

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
            'model' => $this->loadModel($id, 'Testimonial'),
        ));
    }

    public function actionCreate()
    {
        $model = new Testimonial;

        $this->performAjaxValidation($model, 'testimonial-form');

        if (isset($_POST['Testimonial'])) {
            $model->setAttributes($_POST['Testimonial']);

            if (isset($_FILES['Testimonial']['name']['testimonial_picture']) && !empty($_FILES['Testimonial']['name']['testimonial_picture'])) {
                $model->testimonial_picture = $_FILES['Testimonial']['name']['testimonial_picture'];
                $model->testimonial_picture = CUploadedFile::getInstance($model, 'testimonial_picture');
            } else {
                $model->testimonial_picture = $_POST['Testimonial']['testimonial_picture'];
            }
            if ($model->validate(array('testimonial_picture'))) {
                if (isset($_FILES['Testimonial']['name']['testimonial_picture']) && !empty($_FILES['Testimonial']['name']['testimonial_picture'])) {
                    $file_extension = $model->testimonial_picture->getExtensionName();
                    $random_filename = time() . rand(99999, 888888);
                    $image_name = $random_filename . "." . $file_extension;
                    $original_path = TESTIMONIAL_ORIGINAL . $image_name;

                    $model->testimonial_picture->saveAs($original_path);
                    EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(TESTIMONIAL_THUMBNAIL . TESTIMONIAL_THUMB_NAME . $image_name);

                    $model->testimonial_picture = $image_name;
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
        $model = $this->loadModel($id, 'Testimonial');

        $this->performAjaxValidation($model, 'testimonial-form');

        if (isset($_POST['Testimonial'])) {
            $model->setAttributes($_POST['Testimonial']);
            if (isset($_FILES['Testimonial']['name']['testimonial_picture']) && !empty($_FILES['Testimonial']['name']['testimonial_picture'])) {
                $model->testimonial_picture = $_FILES['Testimonial']['name']['testimonial_picture'];
                $model->testimonial_picture = CUploadedFile::getInstance($model, 'testimonial_picture');
            } else {
                $model->testimonial_picture = $_POST['Testimonial']['testimonial_picture'];
            }
            if (isset($_FILES['Testimonial']['name']['testimonial_picture']) && !empty($_FILES['Testimonial']['name']['testimonial_picture'])) {
                $file_extension = $model->testimonial_picture->getExtensionName();
                $random_filename = time() . rand(99999, 888888);
                $image_name = $random_filename . "." . $file_extension;
                $original_path = TESTIMONIAL_ORIGINAL . $image_name;

                $model->testimonial_picture->saveAs($original_path);
                EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(TESTIMONIAL_THUMBNAIL . TESTIMONIAL_THUMB_NAME . $image_name);

                $model->testimonial_picture = $image_name;
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
            $this->loadModel($id, 'Testimonial')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new Testimonial('search');
        $model->unsetAttributes();

        if (isset($_GET['Testimonial']))
            $model->setAttributes($_GET['Testimonial']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}