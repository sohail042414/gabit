
<?php

class AccountController extends AdminCoreController
{
    
    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 14;

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
				'actions'=>array('update','editmessage'),
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
        
        $model = $this->loadModel($id, 'FundtransferByuser');

        if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new FundtransferByuser;


        if (isset($_POST['FundtransferByuser'])) {
            $model->setAttributes($_POST['FundtransferByuser']);

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
        $model = $this->loadModel($id, 'FundtransferByuser');


        if (isset($_POST['FundtransferByuser'])) {
            $model->setAttributes($_POST['FundtransferByuser']);

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

            $model = $this->loadModel($id, 'FundtransferByuser');
            
            if($model->status == 'pending' || $model->status == 'rejected'){
                $model->delete();
                $this->redirect(array('admin'));
            }else{
                throw new CHttpException(400, Yii::t('app', 'Not allowed, Only Pending ore Rejected Requests can be deleted.'));              
            }

        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new FundtransferByuser('search');
        $model->unsetAttributes();

        if (isset($_GET['FundtransferByuser']))
            $model->setAttributes($_GET['FundtransferByuser']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    
   public function actionEditmessage()
    {
      $model = $this->loadModel(1,'SupportersDonorsThankuMessage');

       if (isset($_POST['SupportersDonorsThankuMessage'])) {
           // $model->setAttributes($_POST['DonationMessage']);
           $model->default_message=($_POST['SupportersDonorsThankuMessage']['default_message']);
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t("success", " Message has been successfully updated."));
                //$this->redirect(array('view', 'id' => $model->id));
               // $this->redirect(array('admin'));
            }
        }
      

          $this->render('message_edit', array(
            'model' => $model,
        ));     
       //$this->render('message_edit');
    }

}


