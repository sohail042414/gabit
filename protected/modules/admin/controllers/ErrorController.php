<?php

class ErrorController extends AdminCoreController
{
    public $resourceId = 100;

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('/pages/error', array('error' => $error));
            }
        }
    }
}

?>