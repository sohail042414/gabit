<?php

/**
 * This is the model class for table "setup_fundraiser".
 *
 * The followings are the available columns in table 'setup_fundraiser':
 * @property integer $id
 * @property integer $ftype_id
 * @property string $ftype_typ
 * @property integer $user_id
 * @property string $fundraiser_title
 * @property string $search_status
 * @property string $fundraiser_description
 * @property string $recipient_name
 * @property integer $recipient_age
 * @property string $recipient_sex
 * @property string $recipient_email
 * @property string $recipient_relationship
 * @property string $fundraiser_goal
 * @property string $fundraiser_amount_need
 * @property string $fundraiser_startdate
 * @property string $fundraiser_timeline
 * @property string $use_of_funds
 * @property string $funds_achieve
 * @property string $feature_flag
 * @property integer $no_of_embedsite
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 * @property string $tell_ur_fund_story
 * @property string $uplod_fun_img
 * @property string $benifiry_name
 * @property string $benifi_age
 * @property string $benifi_sex
 * @property string $benifi_email
 * @property string $uplod_pic_benif
 * @property string $lead_supporter_not_sure
 * @property string $lead_supporter_i_am
 * @property string $lead_supptr_name
 * @property string $lead_supptr_email
 * @property string $lead_supptr_sex
 * @property string $lead_supptr_age
 * @property string $lead_supptr_relationshp
 * @property string $uplod_pic_lead_supptr
 * @property string $fund_mange_sure
 * @property string $fund_mange_idea
 * @property string $fund_mange_name
 * @property string $fund_mange_email
 * @property string $fund_mange_sex
 * @property string $fund_mange_age
 * @property string $fund_mange_relationshp
 * @property string $upload_pic_fun_manager
 * @property string $fundriser_goal_amount
 * @property string $fundr_timeline_from
 * @property string $fundr_timeline_to
 * @property string $fund_can_achiv
 * @property string $search_yes
 * @property string $search_no
 * @property string $video
 * @property string $project_name
 * @property integer $project_category
 * @property string $project_champion
 * @property string $champion_image
 * @property string $champion_bg_image
 *
 * The followings are the available model relations:
 * @property Donations[] $donations
 * @property FundraiserComment[] $fundraiserComments
 * @property FundraiserHug[] $fundraiserHugs
 * @property FundtransferByuser[] $fundtransferByusers
 * @property ReportInvitefriends[] $reportInvitefriends
 * @property FundraiserType $ftype
 * @property OldUsers $user
 * @property Supporter[] $supporters
 */
class Fundraiser extends CActiveRecord
{
	public $fundraiser_kind;
	//public $benifi_type = '';
	public $benifi_name_not_applicable = 0;
	public $ftype_typ='';
	public $hidd_fl;

	public $project_champion = '';
	public $project_champion_name = '';
	public $fund_manager_option = '';
	public $fund_manager = 0;
	public $fund_mange_phone='';

	public $ftype_typ_other = '';


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setup_fundraiser';
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'donations' => array(self::HAS_MANY, 'Donations', 'fundraiser_id'),
			'fundraiserComments' => array(self::HAS_MANY, 'FundraiserComment', 'fundraiser_reference_id'),
			'fundraiserHugs' => array(self::HAS_MANY, 'FundraiserHug', 'fundraiser_id'),
			'fundtransferByusers' => array(self::HAS_MANY, 'FundtransferByuser', 'fundraiser_id'),
			'reportInvitefriends' => array(self::HAS_MANY, 'ReportInvitefriends', 'fundraiser_id'),
			'ftype' => array(self::BELONGS_TO, 'FundraiserType', 'ftype_id'),
			'f_sub_type' => array(self::BELONGS_TO, 'FundraiserSubType', 'ftype_typ'),
			'user' => array(self::BELONGS_TO, 'OldUsers', 'user_id'),
			'supporters' => array(self::HAS_MANY, 'Supporter', 'fundraiser_id'),
			'corporates' => array(self::HAS_MANY, 'FundraiserCorporateSupporter', 'fundraiser_id'),
			'lead_supporter_relation' =>  array(self::BELONGS_TO, 'Relationship', 'lead_supptr_relationshp'),
			'fund_mange_relation' =>  array(self::BELONGS_TO, 'Relationship', 'fund_mange_relationshp'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ftype_id' => 'Fundraiser Category',
			'ftype_typ' => 'Fundraiser Type',
			'user_id' => 'User',
			'fundraiser_title' => 'Fundraiser Title',
			'search_status' => 'Search Status',
			//'fundraiser_description' => 'Fundraiser Description',
			// 'recipient_name' => 'Recipient Name',
			// 'recipient_age' => 'Recipient Age',
			// 'recipient_sex' => 'Recipient Sex',
			// 'recipient_email' => 'Recipient Email',
			// 'recipient_relationship' => 'Recipient Relationship',
			//'fundraiser_goal' => 'Fundraiser Goal',
			'fundraiser_amount_need' => 'Fundraiser Amount Need',
			'fundraiser_startdate' => 'Fundraiser Start Date',
			'fundraiser_timeline' => 'Fundraiser Timeline',
			'use_of_funds' => 'Use Of Funds',
			'funds_achieve' => 'Funds Achieve',
			'feature_flag' => 'Feature Flag',
			'no_of_embedsite' => 'No Of Embedsite',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'tell_ur_fund_story' => 'Tell Your Story',
			'uplod_fun_img' => 'Upload Fundraiser Image',
			'fundraiser_bg_image' => 'Upload Fundraiser Background Image',
			'benifiry_name' => 'Beneficiary Name',
			'benifi_age' => 'Beneficiary Age',
			'benifi_sex' => 'Beneficiary Sex',
			'benifi_email' => 'Beneficiary Email',
			'uplod_pic_benif' => 'Upload Beneficiary Photo',
			'uplod_benif_bg' => 'Upload Non-Profit Background Image',
			'lead_supporter_not_sure' => ' Not Sure Yet',
			'lead_supporter_i_am' => 'I Am',
			'lead_supptr_name' => 'Lead Supporter Name',
			'lead_supptr_email' => 'Lead Supporter Email',
			'lead_supptr_sex' => 'Lead Supporter Sex',
			'lead_supptr_age' => 'Lead Supporter Age',
			'lead_supptr_relationshp' => 'Lead Supporter Relationshp',
			'uplod_pic_lead_supptr' => 'Upload Lead Supporter Photo',
			'fund_mange_sure' => 'Not Sure Yet',
			'fund_mange_idea' => 'I have Details',
			'fund_mange_name' => 'Fund Manager Name',
			'fund_mange_email' => 'Fund Manager Email',
			'fund_mange_phone' => 'Fund Manager Phone',
			'fund_mange_sex' => 'Fund Manager Sex',
			'fund_mange_age' => 'Fund Manager Age',
			'fund_mange_relationshp' => 'Fund Manager Relationshp',
			'upload_pic_fun_manager' => 'Upload Fund Manager Photo',
			'fundriser_goal_amount' => 'Fundraiser Goal Amount',
			'fundr_timeline_from' => 'From',
			'fundr_timeline_to' => 'To',
			'fund_can_achiv' => 'Describe What Fund Can Achieve',
			'search_yes' => 'Yes',
			'search_no' => 'No',
			'video' => 'Video',
			'project_name' => 'Project Name',
			'project_category' => 'Category Name',
			'project_champion' => 'Project Champion',
			'project_champion_name' => 'Champion Name',
			'champion_logo' => 'Upload Champion Logo',
			'champion_bg_image' => 'Upload Champion Background Image',
			'fund_manager_option' => 'Fund Manager',
			'benifi_type' => 'Beneficiary Type', 
			'benifi_name_not_applicable' => 'Beneficiary Name Not Applicable',
			'ftype_typ_other' => 'Fundraiser Type',
			'reward_program' => 'Reward Program',
		);
	}

    /**
     * Apply Formating to Date before Saving
     */
    public function beforeSave() {

        if ($this->isNewRecord) {
            //$this->uplod_fun_img = $this->uplod_fun_img;
			$this->created_date = new CDbExpression('NOW()');
        } else {
            $this->updated_date = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }

	
	public function afterFind(){

		if($this->lead_supptr_relationshp =='prompt'){
			$this->lead_supptr_relationshp = null;
		}

		if($this->fund_mange_relationshp =='prompt'){
			$this->fund_mange_relationshp = null;
		}
        
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CommunityFundraiser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getUserFundraiserCount($user_id =0 ){

		if($user_id == 0){
			$user_id = Yii::app()->frontUser->id;
		}

		return Fundraiser::model()->count('user_id = :user_id',array('user_id'=> $user_id));

	}

    public function uploadFundraiserImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'uplod_fun_img');

            if (!is_object($fundraiser_image)) {
                $this->addError('uplod_fun_img', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);			                 
			$this->uplod_fun_img = $image_name;

        } catch (Exception $ex) {

        }
    }



    public function uploadFundraiserBgImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'fundraiser_bg_image');

            if (!is_object($fundraiser_image)) {
                $this->addError('fundraiser_bg_image', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);			                 
			$this->fundraiser_bg_image = $image_name;

        } catch (Exception $ex) {

        }
    }

    public function uploadBenificaryImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'uplod_pic_benif');

            if (!is_object($fundraiser_image)) {
                $this->addError('uplod_pic_benif', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);			                 
			$this->uplod_pic_benif = $image_name;

        } catch (Exception $ex) {

        }
    }

	public function uploadBenificaryBgImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'uplod_benif_bg');

            if (!is_object($fundraiser_image)) {
                $this->addError('uplod_benif_bg', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);			                 
			$this->uplod_benif_bg = $image_name;

        } catch (Exception $ex) {

        }
    }


    public function uploadLeadSupporterImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'uplod_pic_lead_supptr');

            if (!is_object($fundraiser_image)) {
                $this->addError('uplod_pic_lead_supptr', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->uplod_pic_lead_supptr = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }


    public function uploadLeadSupporterBgImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'lead_supptr_bg_image');

            if (!is_object($fundraiser_image)) {
                $this->addError('lead_supptr_bg_image', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->lead_supptr_bg_image = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }


	public function uploadChampionImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'champion_logo');

            if (!is_object($fundraiser_image)) {
                $this->addError('champion_logo', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->champion_logo = $image_name;                    
            
        } catch (Exception $ex) {
            //echo '<pre>';
			// print_r($ex);
			// exit; 
        }
    }
	
	public function uploadChampionBgImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'champion_bg_image');

            if (!is_object($fundraiser_image)) {
                $this->addError('champion_bg_image', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->champion_bg_image = $image_name;                    
            
        } catch (Exception $ex) {
            // echo '<pre>';
			// print_r($ex);
			// exit; 
        }
    }
	


    public function uploadFundManagerImage() {

        try {

            $fundraiser_image = CUploadedFile::getInstance($this, 'upload_pic_fun_manager');

            if (!is_object($fundraiser_image)) {
                $this->addError('upload_pic_fun_manager', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $fundraiser_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$fundraiser_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->upload_pic_fun_manager = $image_name;                    
            
        } catch (Exception $ex) {
            // echo '<pre>';
			// print_r($ex);
			// exit; 
        }
    }

	public function getKindsList(){
		return array(
			'community' => 'Community',
			'corporate' => 'Corporate',
			'other' => 'Other',
		);
	}

	public function getBeneficiaryTypes(){
		return array(
			'community' => 'The Community',
			'public' => 'The Public',
		);
	}

	public function getProjectCategories(){
		$data = Chtml::listData(ProjectCategory::model()->findAll(),'id','name');
		$data[-1] = 'Other';
		return $data;
	}

	public function getProjectChampions(){
		$data = Chtml::listData(Affiliates::model()->findAll('is_champion=1'),'id','name');
		//$data[-1] = 'Other';
		return $data;
	}

	public function getFundManagers(){
		$data = Chtml::listData(Affiliates::model()->findAll('is_fundmanager=1'),'id','name');
		//$data[-1] = 'Other';
		return $data;
	}

	public function makeSlug($text){

        //$title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $text);
		$title = preg_replace("/[^A-Za-z0-9\']/", '_', $text);
        $title = str_replace("'", '', $title);
        $title = strtolower($title);

        return $title;
    }

	public function getTitleSlug(){
		return $this->makeSlug($this->fundraiser_title);
    }

	public function getShortDescription(){
		return substr($this->tell_ur_fund_story,0,200);
	}

	public function getDonationAmount($id =0){

		if($id > 0){
			$fundraiser_id  = $id;
		}else{
			$fundraiser_id = $this->id;
		}

		$total_amount  = Yii::app()->db->createCommand()
		->select('sum(dn.donation_amount) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
		->andwhere('dn.fundraiser_id ='.$fundraiser_id)
		->queryScalar();

		return $total_amount;
		
	}

	public function getTotalPayout($id = 0){

		if($id > 0){
			$fundraiser_id  = $id;
		}else{
			$fundraiser_id = $this->id;
		}

		$total_amount  = Yii::app()->db->createCommand()
		->select('sum(frq.amount_transferred) as total_payout')
		->from('fundtransfer_byuser as frq')
		->where('frq.status = \'completed\'')
		->andwhere('frq.fundraiser_id ='.$fundraiser_id)
		->queryScalar();

		return $total_amount;

	}

	public function getBalance($id = 0){

		if($id > 0){
			$fundraiser_id  = $id;
		}else{
			$fundraiser_id = $this->id;
		}

		$balance = $this->getDonationAmount($fundraiser_id) - $this->getTotalPayout($fundraiser_id);
		return $balance;
	}

	public function getDonationCount($id =0){

		if($id > 0){
			$count = Donations::model()->count('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $id));
		}else{
			$count = Donations::model()->count('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $this->id));
		}

		if((int) $count < 0){
			return 0;
		}

		return $count;
		
	}

	public function getHugCount(){
		$count = FundraiserHug::model()->count('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $this->id));
		return ($count > 0) ? $count : '0';
	}

	public function getSupporterCount(){
		$count = Supporter::model()->count('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $this->id));
		return ($count > 0) ? $count : '0';
	}

	public function getSentInvitationCount(){
		$count = ReportInvitefriends::model()->count('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $this->id));
		return ($count > 0) ? $count : '0';		
	}

	public function getFbShareCount(){
		return '0';
	}

	public function getSiteEmbedCount(){
		return $this->no_of_embedsite;
	}

	public function getDonationPercentage($id =0){

		if($id > 0){
			$donations = Donations::model()->findAll('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $id));
		}else{
			//$donations = Donations::model()->findAll('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $this->id));
			$donations = $this->donations;
		}
		
		// echo '<pre>';
		// print_r($donations);
		// exit; 

		if(count($donations) == 0){
			return '0%';
		}

		$total_amount = 0;

		foreach ($donations as $amount_row){
			$total_amount += $amount_row->donation_amount;
		}

		//echo "Herere".$total_amount; exit;

		if($total_amount < 1){
			return '0%';
		}

		$percentage = ($total_amount/$this->fundriser_goal_amount) * 100;

		$percentage = number_format($percentage,3,'.','');

		if($percentage > 100){
			$percentage = '100%';
		}
		
		return $percentage."%";
	}

	public function getURL(){
		return Yii::app()->createUrl('fundraiser/index', array('id' => $this->id, 'fundraiser_name' => $this->makeSlug($this->fundraiser_title)));    
	}

	public function getAbsoluteURL(){
		return Yii::app()->createAbsoluteUrl('fundraiser/index', array('id' => $this->id, 'fundraiser_name' => $this->makeSlug($this->fundraiser_title)));    
	}

	public function getCompleteURL(){
		return '<a href="'.$this->getAbsoluteURL().'">'.$this->fundraiser_title.'</a>';
	}

	public function getEmbedURL(){
		return Yii::app()->createAbsoluteUrl('fundraiser/embed_fundraiser',array(
			'id' => $this->id, 
			'fundraiser_name' => $this->makeSlug($this->fundraiser_title),
			'fundraiser_image' => $this->uplod_fun_img,
		));
	}

	public function getReportURL(){
		return Yii::app()->createAbsoluteUrl('fundraiser/report_fundraiser',array(
			'id' => $this->id, 
			'fundraiser_name' => $this->makeSlug($this->fundraiser_title),
			'fundraiser_image' => $this->uplod_fun_img,
		));
	}

	public function getDonateURL(){
		return Yii::app()->createUrl('fundraiser/donations', array('id' => $this->id, 'fundraiser_name' => $this->fundraiser_title));
	}

	public function getGoalAmount(){
		return number_format($this->fundriser_goal_amount, 0, ",", ",") . ' NGN';
	}

	public function getDaysLeft($id = 0){

		if($id > 0){
			$fundraiser = Fundraiser::model()->findByPk($id);
			$fundraiser_timeline = $fundraiser->fundr_timeline_to;
		}else{				
			$fundraiser_timeline = $this->fundr_timeline_to;
		}

		if(empty($fundraiser_timeline)){
			return '0 Days';
		}

		$future = strtotime($fundraiser_timeline);

		$time_now = time(); 


        $timeleft = $future-$time_now;

		if($time_now > $future){
			return '0 Days';
		}

        $daysleft = round((($timeleft/24)/60)/60);
        if($daysleft < 0) {
            $daysleft = 0;
        }
        return $daysleft.' Days';
	}

	public function hasEnded($id = 0){

		if($id > 0){
			$fundraiser = Fundraiser::model()->findByPk($id);
			$fundraiser_timeline = $fundraiser->fundr_timeline_to;
		}else{				
			$fundraiser_timeline = $this->fundr_timeline_to;
		}

		////there is no ending date, fundraiser will always continue. 
		if(empty($fundraiser_timeline)){
			return false;
		}

		$end_time = strtotime($fundraiser_timeline);

		$time_now = time(); 
		
		if($time_now > $end_time){
			return true;
		}

		return false;

	}


	public function getImageURL($id = 0){

		if($id > 0){
			$fundraiser = Fundraiser::model()->findByPk($id);
			$image_name = $fundraiser->uplod_fun_img;
		}else{				
			$image_name = $this->uplod_fun_img;
		}

		if(!empty($image_name)){
			return SITE_ABS_PATH_FUNDRAISER_IMAGE . $image_name;
		}
		//place holder image. 

		return SITE_ABS_PATH_UPLOADS.'fundraiser_picture/original/1654005702333005.jpg';

	}

	public function getRewardStartImage(){

		$html = '';

		if($this->reward_program == 1){

			$src = SITE_ABS_PATH.'images/reward-star-img.png';

			$html = '<div class="reward-star">';
			$html.= '<a target="_blank" title="Top Donor Reward Program" href="'.Yii::app()->createUrl('rewards').'">';
			$html.= '<img class="reward-star-img" src="'.$src.'">';
			$html.= '</a>';
			$html.= '</div>';	
		}

		return $html;		
	}
	
	public function getThumURL($id = 0){

		if($id > 0){
			$fundraiser = Fundraiser::model()->findByPk($id);
			$image_name = $fundraiser->uplod_fun_img;
		}else{				
			$image_name = $this->uplod_fun_img;
		}

		if(!empty($image_name)){
			return SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $image_name;
		}
		//place holder image. 

		return SITE_ABS_PATH_UPLOADS.'fundraiser_picture/original/1654005702333005.jpg';
		
	}


	public function getCategoryName(){
		if(is_object($this->ftype)){
			return $this->ftype->fundraiser_type;
		}
		return 'Other';
	}

	public function getTypeName(){
		if(is_object($this->f_sub_type)){
			return $this->f_sub_type->fundraiser_subtyp;	
		}
		return 'Other';
	}

	public function getSliderImages(){

		$return_data = [
			'background_image' => '',
			'fundraiser_image' => '',
			'champion_logo' => '',
		];

		if($this->user_type == 'community'){ 
			$return_data['background_image'] =  SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->champion_bg_image;
			$return_data['fundraiser_image'] = SITE_ABS_PATH_UPLOD_FUN_IMG . $this->uplod_fun_img;
			$return_data['champion_logo'] =  SITE_ABS_PATH_UPLOADS.'images/one-goal-crest.png';
			
		}else if($this->user_type == 'corporate'){

			$return_data['fundraiser_image'] = SITE_ABS_PATH_UPLOD_FUN_IMG . $this->uplod_fun_img;

			if(!empty($this->lead_supptr_bg_image)){ 
				$return_data['background_image'] = SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->lead_supptr_bg_image;
			}else{
				$return_data['background_image'] = SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->champion_bg_image;
			}

			if(!empty($this->champion_logo)){ 
				$return_data['champion_logo'] = SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->champion_logo;
			}else{ 
				$return_data['champion_logo'] = SITE_ABS_PATH_UPLOADS.'images/one-goal-crest.png';
			}

		}else if($this->user_type == 'non_profit'){

			$return_data['fundraiser_image'] = SITE_ABS_PATH_UPLOD_FUN_IMG . $this->uplod_fun_img;
			
			// if(!empty($this->uplod_pic_benif)){ 
			// 	$return_data['champion_logo'] = SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->uplod_pic_benif;
			// }
			
			if(!empty($this->uplod_benif_bg)){			
				$return_data['background_image'] =  SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->uplod_benif_bg;			
			}

		}else{
			$return_data['fundraiser_image'] = SITE_ABS_PATH_UPLOD_FUN_IMG . $this->uplod_fun_img;
			if(!empty($this->fundraiser_bg_image)){			
				$return_data['background_image'] =  SITE_ABS_PATH_UPLOD_FUN_IMG .  $this->fundraiser_bg_image;			
			}
		}
		 
		// if(empty($return_data['background_image'])){
		// 	$return_data['background_image'] = Yii::app()->request->baseUrl."/images/Noimage.jpg";
		// }

		if(empty($return_data['fundraiser_image'])){
			$return_data['fundraiser_image'] = Yii::app()->request->baseUrl."/images/Noimage.jpg";
		}

		return $return_data;
	}

	public function getUserDonationCount($user_id){
		/*
		SELECT count(d.id) as donation_count 
		FROM donations as d 
		JOIN setup_fundraiser AS f ON d.fundraiser_id = f.id
		WHERE f.user_id = 106 AND d.status ='Y';
		*/

		$donation_count  = Yii::app()->db->createCommand()
		->select('count(d.id) as donation_count')
		->from('donations as d')
		->join('setup_fundraiser as f', 'f.id = d.fundraiser_id')
		->where('d.status = \'Y\'')
		->andwhere('f.user_id ='.$user_id)
		->queryScalar();

		return $donation_count;
	}

	/**
	 * 
	 */
	public function getUserFbShareCount($user_id){
		//No way to count fb share 
		return 0;
	}

	public function getUserHugCount($user_id){
		/*
		SELECT count(h.id) as hug_count 
		FROM  fundraiser_hug as h 
		JOIN setup_fundraiser AS f ON h.fundraiser_id = f.id
		WHERE f.user_id = 106 AND h.status ='Y';
		*/

		$hug_count  = Yii::app()->db->createCommand()
		->select('count(h.id) as hug_count')
		->from('fundraiser_hug as h')
		->join('setup_fundraiser as f', 'f.id = h.fundraiser_id')
		->where('h.status = \'Y\'')
		->andwhere('f.user_id ='.$user_id)
		->queryScalar();

		return $hug_count;
	}

	public function getUserSentInviteCount($user_id){
		/*
		SELECT count(inv.id) as invite_count 
		FROM  report_invitefriends as inv
		JOIN setup_fundraiser AS f ON inv.fundraiser_id = f.id
		WHERE f.user_id = 106 AND inv.status ='Y';
		*/

		$invite_count  = Yii::app()->db->createCommand()
		->select('count(inv.id) as invite_count')
		->from('report_invitefriends as inv')
		->join('setup_fundraiser as f', 'f.id = inv.fundraiser_id')
		->where('inv.status = \'Y\'')
		->andwhere('f.user_id ='.$user_id)
		->queryScalar();

		return $invite_count;
	}

	public function getUserSupporterCount($user_id){
		/*
		SELECT count(sp.id) as supporter_count 
		FROM  supporter as sp
		JOIN setup_fundraiser AS f ON sp.fundraiser_id = f.id
		WHERE f.user_id = 106 AND sp.status ='Y';
		*/

		$supporter_count  = Yii::app()->db->createCommand()
		->select('count(sp.id) as supporter_count')
		->from('supporter as sp')
		->join('setup_fundraiser as f', 'f.id = sp.fundraiser_id')
		->where('sp.status = \'Y\'')
		->andwhere('f.user_id ='.$user_id)
		->queryScalar();

		return $supporter_count;
	}

	public function getUserSupporterMessageCount($user_id){
		return 0;
	}
	

	public function getUserSiteEmbedCount($user_id){
		/*
		SELECT count(sp.id) as supporter_count 
		FROM  supporter as sp
		JOIN setup_fundraiser AS f ON sp.fundraiser_id = f.id
		WHERE f.user_id = 106 AND sp.status ='Y';
		*/

		$embed_count  = Yii::app()->db->createCommand()
		->select('sum(fr.no_of_embedsite) as embed_count')
		->from('setup_fundraiser as fr')
		->where('fr.status = \'Y\'')
		->andwhere('fr.user_id ='.$user_id)
		->queryScalar();

		return (int)$embed_count;
	}

	public function getMyFundraisers(){

		if(Yii::app()->frontUser->isGuest){
			return [];
		}
		$user_fund_data1 = array();
		$supporter_data= Supporter::model()->findAll('user_id='.Yii::app()->frontUser->id);
		foreach ($supporter_data as $key=>$val){
			$user_fund_data = SetupFundraiser::model()->findAll('id='.$val['fundraiser_id']);
			$user_fund_data1=  array_merge($user_fund_data1,$user_fund_data);
		}
		
		$user_fund_data= SetupFundraiser::model()->findAll('user_id='.Yii::app()->frontUser->id);
		if(!empty($supporter_data)){
			$fundraiser_list=  array_merge($user_fund_data1,$user_fund_data);
		}else{
			$fundraiser_list=$user_fund_data;
		}

		$uniqu_id = array();
		foreach ($fundraiser_list as $h) {
			$uniqu_id[] = $h['id'];
		}

		$uniquePids = array_unique($uniqu_id);

		$output = [];

		foreach($uniquePids as $f_id){
			$f_data= Fundraiser::model()->find('id='.$f_id);
			// $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $f_data->fundraiser_title);
			// $title = str_replace("'", '', $title);
			// $title = strtolower($title);
			$output[$f_id] = [
				'id' => $f_data->id,
				'slug' => $f_data->getTitleSlug(),
				'title' => $f_data->fundraiser_title
			];
		}
		return $output;
	}


	public function getMyFundraisersList(){

		if(Yii::app()->frontUser->isGuest){
			return [];
		}
		$user_fund_data1 = array();
		$supporter_data= Supporter::model()->findAll('user_id='.Yii::app()->frontUser->id);
		foreach ($supporter_data as $key=>$val){
			$user_fund_data = SetupFundraiser::model()->findAll('id='.$val['fundraiser_id']);
			$user_fund_data1=  array_merge($user_fund_data1,$user_fund_data);
		}
		
		$user_fund_data= SetupFundraiser::model()->findAll('user_id='.Yii::app()->frontUser->id);
		if(!empty($supporter_data)){
			$fundraiser_list=  array_merge($user_fund_data1,$user_fund_data);
		}else{
			$fundraiser_list=$user_fund_data;
		}

		$uniqu_id = array();
		foreach ($fundraiser_list as $h) {
			$uniqu_id[] = $h['id'];
		}

		$uniquePids = array_unique($uniqu_id);

		$output = [];

		foreach($uniquePids as $f_id){
			$f_data= Fundraiser::model()->find('id='.$f_id);
			// $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $f_data->fundraiser_title);
			// $title = str_replace("'", '', $title);
			// $title = strtolower($title);
			$output[$f_id] = $f_data->fundraiser_title;
		}
		
		return $output;
	}


	public function getShareThisUrl(){

		if(isset(Yii::app()->frontUser->id) && !empty(Yii::app()->frontUser->id)){
			$user = Users::model()->findByPK(Yii::app()->frontUser->id);
			if(is_object($user)){
				return $this->getSocialUserURL($user);
			}
		}

		return $this->getAbsoluteURL();
	}


	public function getSocialUserURL(Users $user){

		$title = $this->getTitleSlug();

		$user_slug = '';

        if(is_object($user)){
			$user_slug = str_replace('-','_',$user->referral_code);
        }
        
        return Yii::app()->createAbsoluteUrl("fundraiser/$this->id/$title/$user_slug");

	}

}
