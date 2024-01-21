<?php
class DonationsController extends AdminCoreController {
    
    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 13;

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
				'actions'=>array('index','admin','payment_summary','view','export',),
				'users'=>array('@'),
				'expression' => ($this->auth->canView($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('create','send_email'),
				'users'=>array('@'),
				'expression' => ($this->auth->canAdd($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('update','editmessage','send_email'),
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

        $model =  $this->loadModel($id, 'Donations');

        if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

        $this->render('view', array(
                'model' =>$model,
        ));
    }

    public function actionCreate() {
        $model = new Donations;
        if (isset($_POST['Donations'])) {
            $model->setAttributes($_POST['Donations']);
            //p($model);
            
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                    Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully created."));
                    //$this->redirect(array('view', 'id' => $model->id));
                    $this->redirect(array('admin'));
                }
            }
        }
        $this->render('create', array( 'model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Donations');

        if($model->status_new == 'Y'){
            $model->status_new = 'N';
            $model->update();
        }

        if (isset($_POST['Donations'])) {
            $model->setAttributes($_POST['Donations']);

            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully updated."));
                //$this->redirect(array('view', 'id' => $model->id));
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }


    public function actionPayment_summary(){

        $model = new Donations();

        $this->render('payment_summary', array(
            'model' => $model,
        ));
    }


	public function actionNewentry() {
        //$model = new Donations('search');
        
        //$model = Yii::app()->db->createCommand("SELECT d.*,sf.use_of_funds FROM donations as d, setup_fundraiser as sf WHERE d.fundraiser_id = sf.id");
        $model = Yii::app()->db->createCommand()                
                ->select('d.*,sf.fundraiser_title')
                ->from('donations as d, setup_fundraiser as sf')
                //->where("d.fundraiser_id = sf.id AND d.created_date BETWEEN d.created_date AND '".date('Y-m-d H:i:s', strtotime('-1 day'))."'")
                ->where("d.fundraiser_id = sf.id AND d.created_date BETWEEN '".date('Y-m-d H:i:s', strtotime('-1 day'))."' AND d.created_date")
                //->where("d.fundraiser_id = sf.id AND d.created_date > DATE_SUB(date('Y-m-d H:i:s'), INTERVAL date('d.created_date', strtotime('-1 day')))")
                //->andWhere(d.created_date > DATE_SUB(date('Y-m-d H:i:s'), INTERVAL 24 HOUR)
                ->queryAll();
        
        //->select('d.id,sf.use_of_funds,d.donation_amount,d.donor_name,d.donor_email,d.donor_phone_no,d.created_date')
        //$model->unsetAttributes();

        if (isset($_GET['Donations']))
            $model->setAttributes($_GET['Donations']);
        
        $this->render('newentry', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Donations')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin() {
        $model = new Donations('search');
        $model->unsetAttributes();

        if (isset($_GET['Donations']))
            $model->setAttributes($_GET['Donations']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }
        
    public function actionExport()
    {
        //$model = Users::model()->findAll("user_type = '2'");
        
        $model = Yii::app()->db->createCommand()
                ->select('d.id,sf.fundraiser_title,d.donation_amount,d.donor_name,d.donor_email,d.donor_phone_no,d.donor_message,d.created_date,d.status')
                ->from('donations as d, setup_fundraiser as sf')
                ->where("d.fundraiser_id = sf.id")
                ->queryAll();
        
        $column_name = array('id','fundraiser_title','donation_amount','donor_name','donor_email','donor_phone_no','donor_message','created_date','status');
        
        $setExcelName = "Download_donations_excel_file";
        $setRec = $model;
        
        $setCounter = 0;
        $setCounter = count($setRec);
        
        foreach($column_name as $column_title){
            $setMainHeader .= $column_title."\t";
        }
        
        foreach($setRec as $records){
            $rowLine = '';
            foreach($records as $value) {
                if(!isset($value) || $value == "") {
                    $value = "\t";
                } else {
                    //It escape all the special charactor, quotes from the data.
                    $value = strip_tags(str_replace('"', '""', $value));
                    $value = '"' . $value . '"' . "\t";
                }
                $rowLine .= $value;
            }
            $setData .= trim($rowLine)."\n";
        }
        
        $setData = str_replace("r", "", $setData);
        if ($setData == "") {
            $setData = "\n No records found. \n";
        }
        
        $setCounter = mysql_num_fields($setRec);
        
        //This Header is used to make data download instead of display the data 
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        //It will print all the Table row as Excel file row with selected column name as header.
        echo ucwords($setMainHeader)."\n".$setData."\n";
    }
    
    public function actionEditmessage()
    {
      $model = $this->loadModel(1, 'DonationMessage');
      
       if (isset($_POST['DonationMessage'])) {
           // $model->setAttributes($_POST['DonationMessage']);
           $model->messge=($_POST['DonationMessage']['messge']);
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
    public function actionUpdatemessage()
    {
       print_r($_POST);
       die();
       $model=new DonationMessage();
        if (isset($_POST['DonationMessage'])) {
            $model->setAttributes($_POST['DonationMessage']);

            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully updated."));
                //$this->redirect(array('view', 'id' => $model->id));
                $this->redirect(array('admin'));
            }
        }

               
       $this->render('message_edit'
        );
    }


    public function actionSend_email()
    {

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl.'/js/admin/select2/select2.js'
        );

        Yii::app()->clientScript->registerCssFile(
            Yii::app()->baseUrl.'/js/admin/select2/select2.css'
        );


        $donors = Donations::model()->getDistinctDonors();

        $donors_list = array();

        foreach($donors as $donor){
            $donors_list[$donor->id] = $donor->donor_name.'<'.$donor->donor_email.'>';
        }

        $model = new DonorsEmailForm();
  
        if(isset($_POST['DonorsEmailForm'])){

            $model->setAttributes($_POST['DonorsEmailForm']);
            
            if($model->validate()){

                //Single User
                if(empty($model->to_all)){
                    $donor = Donations::model()->findByPk($model->user_id);
                    $this->send_email($donor->donor_email,$model->subject,$model->message,$model->message);                    
                }else if(empty($model->to_all)){


                    $user_emails = array();

                    foreach($donors as $donor){
                        $user_emails[$donor->donor_email] = $donor->donor_name;
                    }
 
                    $this->send_email($user_emails,$model->subject,$model->message,$model->message);                    

                }

                Yii::app()->user->setFlash('success', "Email Sent Successfully!");
                $model->unsetAttributes();
            }
        }else{
            $model->message = '
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="background:#FFF; width:624px">
                    <tbody>
                        <tr>
                            <td style="background-color:#098fc6; text-align:center">
                            <p><strong><span style="color:#FFFFFF"><span style="font-size:16px">Giveyourbit</span></span></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            <p>&nbsp;</p>

                            <p> Greetings Here </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            <p>Type Your message here...</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <p>Regards,</p>
                            <p>The Giveyourbit fundraising support team.</p>
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td style="background-color:#098fc6">
                            <p style="text-align:center"><span style="font-size:11px"><span style="color:#FFFFFF"><strong>&copy; 2022 Dajed RollOutTech All Rights Reserved</strong></span></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ';
        }

        $this->render('send_email', array(
            'model' => $model,
            'users_list' => $donors_list
        ));
    }
}
