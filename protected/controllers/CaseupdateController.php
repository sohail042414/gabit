<?php
//require_once 'google-api-php-client/src/Google/autoload.php';

class CaseupdateController extends FrontCoreController
{

    public function actionDelete(){

      if (!$this->checkLogin()) {
        $this->redirect(Yii::app()->createUrl('site/login'));
        Yii::app()->end();
      }

      $user_id = Yii::app()->frontUser->id;

      $case_id = Yii::app()->request->getParam('case_id',0);

      $case_update = CaseUpdates::model()->findByPk($case_id);
      
      if($case_update->user_id == $user_id){
          $case_update->delete();
          Yii::app()->user->setFlash('success', Yii::t("success", "Case Update Deleted."));
      }else{
         Yii::app()->user->setFlash('error', Yii::t("success", "You are not authorized to delete it"));
      }

      $this->redirect(Yii::app()->createUrl('/fundraiser/managefundraiser', array( 'tab' => 'case')));

  }



}
