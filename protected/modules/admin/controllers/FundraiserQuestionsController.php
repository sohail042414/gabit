<?php

class FundraiserQuestionsController extends AdminCoreController
{

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 19;

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
        $Que = FundraiserQuestions::model()->findByPk($id);
        if (!empty($Que)) {
            $Que->notify_status = 'Y';
            $Que->save();
        }
        $this->render('view', array(
            'model' => $this->loadModel($id, 'FundraiserQuestions'),
        ));
    }

    public function actionCreate()
    {
        $model = new FundraiserQuestions;


        if (isset($_POST['FundraiserQuestions'])) {
            $model->setAttributes($_POST['FundraiserQuestions']);

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
        $model = $this->loadModel($id, 'FundraiserQuestions');


        if (isset($_POST['FundraiserQuestions'])) {
            $model->setAttributes($_POST['FundraiserQuestions']);

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
            $this->loadModel($id, 'FundraiserQuestions')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new FundraiserQuestions('search');
        $model->unsetAttributes();

        if (isset($_GET['FundraiserQuestions']))
            $model->setAttributes($_GET['FundraiserQuestions']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionApprovalquestion()
    {
        if (!empty($_REQUEST['id'])) {
            $que = FundraiserQuestions::model()->findByPk($_REQUEST['id']);
            $que->status = 'Y';
            $que->save(false);
        }
    }

    public function actionRejectquestion()
    {
        if (!empty($_REQUEST['id'])) {
            $que = FundraiserQuestions::model()->findByPk($_REQUEST['id']);
            $que->status = 'N';
            $que->save(false);
        }
    }

    public function actionGetanswer()
    {
        $data = array();
        if (!empty($_POST['FundraiserAnswer'])) {
            $answer = new FundraiserAnswer();
            $answer->user_id = $_POST['FundraiserAnswer']['user_id'];
            $answer->questions_id = $_POST['FundraiserAnswer']['question_id'];
            $answer->answer_text = $_POST['FundraiserAnswer']['answer_text'];
            if ($answer->save(false)) {
                $data['id'] = $_POST['FundraiserAnswer']['question_id'];
            }
//            echo json_encode($data);
            echo 'Give ans Successfully';
        }
    }

}