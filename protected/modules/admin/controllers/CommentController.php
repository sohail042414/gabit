<?php

class CommentController extends AdminCoreController
{

    public $resourceId = 4;

    private $_model;


    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Comment'),
        ));
    }

    public function actionCreate()
    {
        $model = new Comment;


        if (isset($_POST['Comment'])) {
            $model->setAttributes($_POST['Comment']);

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
        $model = $this->loadModel($id, 'Comment');


        if (isset($_POST['Comment'])) {
            $model->setAttributes($_POST['Comment']);

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
            $this->loadModel($id, 'Comment')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new Comment('search');
        $model->unsetAttributes();

        if (isset($_GET['Comment']))
            $model->setAttributes($_GET['Comment']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Comment('search');
        $dataProvider = new CActiveDataProvider('Comment', array(
            'criteria' => array(
                'with' => 'post',
                'order' => 't.status, t.created_date DESC',
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,'model' => $model,
        ));
    }

    /**
     * Approves a particular comment.
     * If approval is successful, the browser will be redirected to the comment index page.
     */
    public function actionApprove()
    {
        if (Yii::app()->request->isPostRequest) {
            $comment = $this->loadModel();
            $comment->approve();
            $this->redirect(array('index'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Comment::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }


}