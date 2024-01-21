<?php
//require_once 'google-api-php-client/src/Google/autoload.php';

class FundrequestController extends FrontCoreController
{

  public function actionIndex()
  {

    if (!$this->checkLogin()) {
      $this->redirect(array('site/index'));
    }

    $model = new FundtransferByuser();

    $user_id = Yii::app()->frontUser->id;

    if (!empty($_POST['FundtransferByuser'])) {

      $model->attributes = $_POST['FundtransferByuser'];

      $model->user_id = $user_id;
      $model->created_by = $user_id;
      $model->status = 'pending';
      $model->status_new = 'Y';

      $fundraiser = Fundraiser::model()->findByPk($model->fundraiser_id);

      if(is_object($fundraiser) && $fundraiser->reward_program ==1){
        $model->reward_program = 1;
      }

      if ($model->save()) {

        Yii::app()->user->setFlash('success', Yii::t("success", "Fund Tranfer request successfully sent."));
        $this->redirect('index');

        /*
                    $user_model = Users::model()->find("id=:id", array('id' => $id));
                    $user_admin = Users::model()->find("user_type=:user_type", array('user_type' => '1'));
                    $admin_email=$user_admin->email;
                    $customer_email = $user_model->email;
                    $customer_username = $user_model->username;

                    $email_model = EmailTemplates::model()->findByPk('7');
                    $email_template = $email_model->template;
                    $email_template = str_replace('#USRFULLNAME#', ucfirst($customer_username), $email_template);
                    //$this->send_email($user_model->email, $email_model->subject, $email_template);
                    mail($user_model->email, $email_model->subject, $email_template);
                    $email_model_admin = EmailTemplates::model()->findByPk('9');
                    $email_template_admin = $email_model_admin->template;
                    $email_template_admin = str_replace('#USERNAME#', ucfirst($customer_username), $email_template_admin);
                    $email_template_admin = str_replace('#ACCOUNT_NUBMER#', ucfirst($model->fundraiser_account), $email_template_admin);
                   // $this->send_email($admin_email, $email_template_admin->subject, $email_template_admin);
                    mail($admin_email, $email_template_admin->subject, $email_template_admin);
                    $this->donnermail($data11);
                    $this->suppormail($data12);
                    */
  
      }
    }

    $transfer_requests = FundtransferByuser::model()->findAll(array(
      'condition' => 'user_id = :user_id',
      'params' => array(
        'user_id' => $user_id
      ),
      'order' => 'id DESC'
    ));


    $fundraisers_list = [];

    $fundraisers = Fundraiser::model()->findAllByAttributes(array('user_id' =>Yii::app()->frontUser->id ));

    $request_min_amount = Yii::app()->params['request_min_amount'];

    if(empty($request_min_amount)){
      $request_min_amount = 10000;
    }

    foreach($fundraisers as $fundraiser){

        if($fundraiser->getBalance() > $request_min_amount){
          $fundraisers_list[$fundraiser->id] = $fundraiser->fundraiser_title;
        }

      //$fundraisers_list[$fundraiser->id] = $fundraiser->fundraiser_title;
    }


    $this->render('index', array(
      'model' => $model,
      'transfer_requests' => $transfer_requests,
      'fundraisers_list' => $fundraisers_list,
      'request_min_amount' => number_format($request_min_amount,2)
    ));
  }


  public function actionDelete($id)
  {

    if (!$this->checkLogin()) {
      $this->redirect(array('site/index'));
    }

    $fund_request = FundtransferByuser::model()->findByPk($id);

    $user_id = Yii::app()->frontUser->id;

    if (is_object($fund_request) && ($user_id == $fund_request->user_id)) {
        $fund_request->delete();
        $this->redirect(array('fundrequest/index'));
    } else {
      throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }
  }


  public function actionUpdate($id)
  {

    if (!$this->checkLogin()) {
      $this->redirect(array('site/index'));
    }

    $model = FundtransferByuser::model()->findByPk($id);

    $user_id = Yii::app()->frontUser->id;

    if (is_object($model) && ($user_id != $model->user_id)) {      
      $this->redirect(array('fundrequest/index'));
    } 


    if (!empty($_POST['FundtransferByuser'])) {

      $model->attributes = $_POST['FundtransferByuser'];

      if ($model->update()) {
          Yii::app()->frontUser->setFlash('success', 'Password created successfuly!');
          $this->redirect(array('fundrequest/index'));
      }

    }


    $this->render('update', array(
      'model' => $model,
    ));

  }
}
