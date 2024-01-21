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
 * @property string $fundraiser_image
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
 * @property string $lead_supptr_name
 * @property string $lead_supptr_email
 * @property string $lead_supptr_age
 * @property string $lead_supptr_relationshp
 * @property string $uplod_pic_lead_supptr
 * @property string $fund_mange_sure
 * @property string $fund_mange_idea
 * @property string $fund_mange_name
 * @property string $fund_mange_email
 * @property string $fund_mange_age
 * @property string $fund_mange_relationshp
 * @property string $upload_pic_fun_manager
 * @property string $fundriser_goal_amount
 * @property string $fundr_timeline
 * @property string $fund_can_achiv
 * @property string $search_yes
 * @property string $search_no
 *
 * The followings are the available model relations:
 * @property Donations[] $donations
 * @property FundraiserComment[] $fundraiserComments
 * @property FundraiserHug[] $fundraiserHugs
 * @property FundtransferByuser[] $fundtransferByusers
 * @property ReportInvitefriends[] $reportInvitefriends
 * @property FundraiserType $ftype
 * @property Users $user
 * @property Supporter[] $supporters
 */
Yii::import('application.models._base.BaseSetupFundraiser');
class SetupFundraiser extends BaseSetupFundraiser
{
	public $is_checked1;
	public $is_checked2;
	public $is_checked3;
	public $search_field;

	public $fundraiser_kind = '';
	public $benifi_type = '';
	public $benifi_name_not_applicable = 0;
	public $fund_manager= '';
	public $ftype_typ='';

	public $hidd_fl;

	public $corporateSupporters; 

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'setup_fundraiser';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' ftype_typ, user_id, use_of_funds, funds_achieve, created_date, ftype_id, fundraiser_title, tell_ur_fund_story, benifiry_name, benifi_age, benifi_email, fund_can_achiv, fundr_timeline_from, fundriser_goal_amount', 'required'),
			//array('fundraiser_id, ftype_id, ftype_typ, user_id, recipient_age, no_of_embedsite', 'numerical', 'integerOnly'=>true),
			array('fundraiser_id', 'required', 'message' => 'Please select Fundraiser'), 
			array(' uplod_fun_img, uplod_pic_benif', 'required', 'message' => 'Please upload an image'),
			//array('benifi_sex', 'required', 'message' => 'Please select {attribute}'),
			array('ftype_id, ftype_typ, user_id, recipient_age, no_of_embedsite', 'numerical', 'message' => 'Please select {attribute}'),
			array('ftype_typ, uplod_fun_img, benifiry_name, benifi_age, benifi_sex, lead_supptr_sex, fund_mange_sex, benifi_email, uplod_pic_benif, lead_supporter_not_sure, lead_supporter_i_am, lead_supptr_name, lead_supptr_email, lead_supptr_age, lead_supptr_relationshp, uplod_pic_lead_supptr, fund_mange_sure, fund_mange_idea, fund_mange_name, fund_mange_email, fund_mange_age, fund_mange_relationshp, upload_pic_fun_manager, fundriser_goal_amount, fundr_timeline_from, fundr_timeline_to, fund_can_achiv, search_yes, search_no', 'length', 'max'=>200),
			array('fundraiser_title, recipient_name, recipient_email, recipient_relationship, fundraiser_goal', 'length', 'max'=>255),
			array('search_status, recipient_sex, lead_supptr_sex, fund_mange_sex, feature_flag, status,status_new', 'length', 'max'=>1),
			array('social_shares_count,comments_count', 'numerical'),
			array('social_shares_count,comments_count', 'safe'),
			array('fundraiser_amount_need', 'length', 'max'=>45),
			array('fundraiser_description, fundraiser_startdate, fundraiser_timeline, updated_date,corporateSupporters', 'safe'),
			array('lead_supptr_age,fund_mange_age', 'compare', 'compareValue' => 18, 'operator' => '>='),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ftype_id, ftype_typ, user_id, fundraiser_title, search_status, fundraiser_image, fundraiser_description, recipient_name, recipient_age, recipient_sex, lead_supptr_sex, fund_mange_sex, recipient_email, recipient_relationship, fundraiser_goal, fundraiser_amount_need, fundraiser_startdate, fundraiser_timeline, use_of_funds, funds_achieve, feature_flag, no_of_embedsite, created_date, updated_date, status, tell_ur_fund_story, uplod_fun_img, benifiry_name, benifi_age, benifi_sex, benifi_email, uplod_pic_benif, lead_supporter_not_sure, lead_supporter_i_am, lead_supptr_name, lead_supptr_email, lead_supptr_age, lead_supptr_relationshp, uplod_pic_lead_supptr, fund_mange_sure, fund_mange_idea, fund_mange_name, fund_mange_email, fund_mange_age, fund_mange_relationshp, upload_pic_fun_manager, fundriser_goal_amount, fundr_timeline_from, fundr_timeline_to, fund_can_achiv, search_yes, search_no', 'safe', 'on'=>'search'),
		);
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
			'id' => Yii::t('app', 'ID'),
			'ftype_id' =>  Yii::t('app', 'Fundraiser Category'),
			'ftype_typ' => Yii::t('app', 'Fundraiser Type'),
			'user_id' =>  null,
			'fundraiser_title' => Yii::t('app', 'Fundraiser Title'),
			'search_status' =>Yii::t('app', 'Search Status'),
			//'fundraiser_image' =>Yii::t('app', 'Fundraiser Image') ,
			'fundraiser_description' => Yii::t('app', 'Fundraiser Description'),
			'recipient_name' => Yii::t('app', 'Recipient Name'),
			'recipient_age' => Yii::t('app', 'Recipient Age'),
			'recipient_sex' =>Yii::t('app', 'Recipient Sex') ,
			'recipient_email' => Yii::t('app', 'Recipient Email'),
			'recipient_relationship' =>Yii::t('app', 'Recipient Relationship') ,
			'fundraiser_goal' =>Yii::t('app', 'Fundraiser Goal') ,
			'fundraiser_amount_need' =>Yii::t('app', 'Fundraiser Amount Need') ,
			'fundraiser_startdate' => Yii::t('app', 'Fundraiser Startdate'),
			'fundraiser_timeline' =>Yii::t('app', 'Fundraiser Timeline') ,
			'use_of_funds' => Yii::t('app', 'Use Of Funds'),
			'funds_achieve' => Yii::t('app', 'Funds Achieve'),
			'feature_flag' => Yii::t('app', 'Feature Flag'),
			'no_of_embedsite' => Yii::t('app', 'No Of Embedsite'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' =>Yii::t('app', 'Updated Date') ,
			'status' =>Yii::t('app', 'Status') ,
			'tell_ur_fund_story' => Yii::t('app', 'Tell Your Fundraiser Story'),
			'uplod_fun_img' => Yii::t('app', 'Upload Fundriser Image'),
			'benifiry_name'=> Yii::t('app', 'Benificiary Name') ,
			'benifi_age' =>Yii::t('app', 'Benificiary Age') ,
			'benifi_sex' =>Yii::t('app', 'Benificiary Sex') ,
			'benifi_email' => Yii::t('app','Benificiary Email'),
			'uplod_pic_benif' => Yii::t('app', 'Upload Picture of Benificiary'),
			'lead_supporter_not_sure' => Yii::t('app', 'Not sure yet'),
			'lead_supporter_i_am' => Yii::t('app', 'I am'),
			'lead_supptr_name' => Yii::t('app', 'Lead Supporter Name'),
			'lead_supptr_email' =>Yii::t('app', 'Lead Supporter Email') ,
			'lead_supptr_sex' =>Yii::t('app', 'Lead Supporter Sex') ,
			'lead_supptr_age' => Yii::t('app','Lead Supporter Age'),
			'lead_supptr_relationshp' =>Yii::t('app','Lead Supporter / Benificiary relationship') ,
			'uplod_pic_lead_supptr' => Yii::t('app',  'Upload Picture of Lead Supporter'),
			'fund_mange_sure' =>Yii::t('app', 'Not sure yet') ,
			'fund_mange_idea' => Yii::t('app',  'I have the details'),
			'fund_mange_name' => Yii::t('app', 'Fund Manager Name' ),
			'fund_mange_email' => Yii::t('app', 'Fund Manager Email' ),
			'fund_mange_sex' => Yii::t('app', 'Fund Manager Sex' ),
			'fund_mange_age' => Yii::t('app', 'Fund Manager Age' ),
			'fund_mange_relationshp' => Yii::t('app', 'Fund Manager / Benificiary relationship' ),
			'upload_pic_fun_manager' => Yii::t('app', 'Upload Picture of Fund Manager'),
			'fundriser_goal_amount' =>Yii::t('app', 'Fundraiser Goal Amount') ,
			'fundr_timeline_from' =>Yii::t('app', 'Start Date') ,
			'fundr_timeline_to' =>Yii::t('app', 'End Date' ) ,
			'fund_can_achiv' =>Yii::t('app', 'Describe what the Fund can Achieve for the Beneficiary') ,
			'search_yes' =>Yii::t('app','Yes') ,
			'search_no' => Yii::t('app','No'),
			'video' => Yii::t('app','Video'),
			'benifi_name_not_applicable' => Yii::t('app','Benificiary Name Not applicable'),	
			'champion_image' => Yii::t('app','Champion Image or Logo'),	
			'champion_bg_image' => Yii::t('app','Champion Background Image'),
			'social_shares_count' => 'Social Shares Count',		
			'comments_count' => 'Facebook Comments Count',		
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ftype_id',$this->ftype_id);
		$criteria->compare('ftype_typ',$this->ftype_typ,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('fundraiser_title',$this->fundraiser_title,true);
		$criteria->compare('search_status',$this->search_status,true);
		//$criteria->compare('fundraiser_image',$this->fundraiser_image,true);
		$criteria->compare('fundraiser_description',$this->fundraiser_description,true);
		// $criteria->compare('recipient_name',$this->recipient_name,true);
		// $criteria->compare('recipient_age',$this->recipient_age);
		// $criteria->compare('recipient_sex',$this->recipient_sex,true);
		// $criteria->compare('recipient_email',$this->recipient_email,true);
		// $criteria->compare('recipient_relationship',$this->recipient_relationship,true);
		$criteria->compare('fundraiser_goal',$this->fundraiser_goal,true);
		$criteria->compare('fundraiser_amount_need',$this->fundraiser_amount_need,true);
		$criteria->compare('fundraiser_startdate',$this->fundraiser_startdate,true);
		$criteria->compare('fundraiser_timeline',$this->fundraiser_timeline,true);
		$criteria->compare('use_of_funds',$this->use_of_funds,true);
		$criteria->compare('funds_achieve',$this->funds_achieve,true);
		$criteria->compare('feature_flag',$this->feature_flag,true);
		$criteria->compare('no_of_embedsite',$this->no_of_embedsite);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('tell_ur_fund_story',$this->tell_ur_fund_story,true);
		$criteria->compare('uplod_fun_img',$this->uplod_fun_img,true);
		$criteria->compare('benifiry_name',$this->benifiry_name,true);
		$criteria->compare('benifi_age',$this->benifi_age,true);
		$criteria->compare('benifi_sex',$this->benifi_sex,true);
		$criteria->compare('benifi_email',$this->benifi_email,true);
		$criteria->compare('uplod_pic_benif',$this->uplod_pic_benif,true);
		$criteria->compare('lead_supporter_not_sure',$this->lead_supporter_not_sure,true);
		$criteria->compare('lead_supporter_i_am',$this->lead_supporter_i_am,true);
		$criteria->compare('lead_supptr_name',$this->lead_supptr_name,true);
		$criteria->compare('lead_supptr_email',$this->lead_supptr_email,true);
		$criteria->compare('lead_supptr_email',$this->lead_supptr_sex,true);
		$criteria->compare('lead_supptr_age',$this->lead_supptr_age,true);
		$criteria->compare('lead_supptr_relationshp',$this->lead_supptr_relationshp,true);
		$criteria->compare('uplod_pic_lead_supptr',$this->uplod_pic_lead_supptr,true);
		$criteria->compare('fund_mange_sure',$this->fund_mange_sure,true);
		$criteria->compare('fund_mange_idea',$this->fund_mange_idea,true);
		$criteria->compare('fund_mange_name',$this->fund_mange_name,true);
		$criteria->compare('fund_mange_email',$this->fund_mange_email,true);
		$criteria->compare('fund_mange_email',$this->fund_mange_sex,true);
		$criteria->compare('fund_mange_age',$this->fund_mange_age,true);
		$criteria->compare('fund_mange_relationshp',$this->fund_mange_relationshp,true);
		$criteria->compare('upload_pic_fun_manager',$this->upload_pic_fun_manager,true);
		$criteria->compare('fundriser_goal_amount',$this->fundriser_goal_amount,true);
		$criteria->compare('fundr_timeline_from',$this->fundr_timeline_from,true);
		$criteria->compare('fundr_timeline_to',$this->fundr_timeline_to,true);
		$criteria->compare('fund_can_achiv',$this->fund_can_achiv,true);
		$criteria->compare('search_yes',$this->search_yes,true);
		$criteria->compare('search_no',$this->search_no,true);
		$criteria->compare('video',$this->video,true);
		return new CActiveDataProvider($this, array(			
			'criteria'=>$criteria,
			'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SetupFundraiser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind(){

		if($this->lead_supptr_relationshp =='prompt'){
			$this->lead_supptr_relationshp = null;
		}

		if($this->fund_mange_relationshp =='prompt'){
			$this->fund_mange_relationshp = null;
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
			'1' => 'Type 1',
			'2' => 'Type 2',
			'3' => 'Type 3',
		);
	}

	public function getProjectCategories(){
		return array(
			'1' => 'Category 1',
			'2' => 'Category 2',
			'3' => 'Category 3',
		);
	}

	public function getProjectChampions(){
		return array(
			'mautts' => 'MAUTTS',
			'other' => 'Other'
		);
	}
	
}
