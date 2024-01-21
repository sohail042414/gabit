<?php

class NewsletterController extends AdminCoreController
{

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 25;

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
            'model' => $this->loadModel($id, 'Newsletter'),
        ));
    }

    public function actionCreate()
    {
        $model = new Newsletter;


        if (isset($_POST['Newsletter'])) {
            $model->setAttributes($_POST['Newsletter']);

            if ($model->save()) {
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
        $model = $this->loadModel($id, 'Newsletter');


        if (isset($_POST['Newsletter'])) {
            $model->setAttributes($_POST['Newsletter']);

            if ($model->save()) {
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
            $this->loadModel($id, 'Newsletter')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new Newsletter('search');
        $model->unsetAttributes();

        if (isset($_GET['Newsletter']))
            $model->setAttributes($_GET['Newsletter']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionSendnewsemail()
    {

        if (!empty($_POST['selectedIds'])) {
            $email_model = EmailTemplates::model()->findByPk('3');
            foreach ($_POST['selectedIds'] as $selectedIds_row) {
                $newsletter_model = Newsletter::model()->findByPk($selectedIds_row);
                $email_template = $email_model->template;
                $email_template = str_replace('#USRFULLNAME#', $newsletter_model->newsletter_name, $email_template);
                $email_template = str_replace('#EMAIL#', $newsletter_model->Newsletter_email, $email_template);
                $this->send_email($newsletter_model->Newsletter_email, $email_model->subject, $email_template);
            }
            Yii::app()->user->setFlash('success', Yii::t("success", "Your News has been successfully sent.!"));
            echo UtilityHtml::get_flash_message();

        } else {
            Yii::app()->user->setFlash('error', Yii::t("error", "You have not any record selected.!"));
            echo UtilityHtml::get_flash_message();
        }
    }

}