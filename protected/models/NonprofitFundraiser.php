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
 * @property string $champion_logo
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
class NonprofitFundraiser extends Fundraiser
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,fundraiser_title,tell_ur_fund_story,fundr_timeline_from,fundr_timeline_to', 'required'),			
			array('ftype_id', 'required', 'message' => 'Please select Fundraiser Type'), 
			array('ftype_typ', 'required','except'=>'update', 'message' => 'Please select Fundraiser Type'), 
			array('user_id, no_of_embedsite, project_category', 'numerical', 'integerOnly'=>true),
			array('ftype_typ, uplod_fun_img, benifi_email, uplod_pic_benif, lead_supporter_not_sure, lead_supporter_i_am, lead_supptr_name, lead_supptr_email, lead_supptr_age, lead_supptr_relationshp, uplod_pic_lead_supptr, fund_mange_sure, fund_mange_idea, fund_mange_name, fund_mange_email, fund_mange_age, fund_mange_relationshp, upload_pic_fun_manager, fundriser_goal_amount, fundr_timeline_from, fundr_timeline_to, fund_can_achiv, search_yes, search_no', 'length', 'max'=>200),
			array('fundraiser_title, fundraiser_goal, fundraiser_startdate, fundraiser_timeline, champion_logo, champion_bg_image', 'length', 'max'=>255),
			array('search_status, feature_flag, status,status_new', 'length', 'max'=>1),
			array('fundraiser_amount_need', 'length', 'max'=>45),
			array('lead_supptr_sex, fund_mange_sex', 'length', 'max'=>222),
			array('project_name', 'length', 'max'=>50),
			array('benifiry_name', 'length', 'max'=>50),
			array('fundriser_goal_amount', 'numerical', 'integerOnly'=>true,'message' => 'Please enter only numbers without symbols.'),
			array('benifi_age', 'length', 'max'=>20),
			array('benifi_sex', 'length', 'max'=>20),
			array('project_champion', 'length', 'max'=>30),
			array('tell_ur_fund_story', 'length',  'min'=>1500,'max'=>1600),					
			array('fundraiser_description, use_of_funds, funds_achieve, updated_date, tell_ur_fund_story, video,fund_mange_phone,ftype_typ_other,lead_supptr_phone,benifi_type,reward_program', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ftype_id, ftype_typ, user_id, fundraiser_title, search_status, fundraiser_description, fundraiser_goal, fundraiser_amount_need, fundraiser_startdate, fundraiser_timeline, use_of_funds, funds_achieve, feature_flag, no_of_embedsite, created_date, updated_date, status, tell_ur_fund_story, uplod_fun_img, benifiry_name, benifi_age, benifi_sex, benifi_email, uplod_pic_benif, lead_supporter_not_sure, lead_supporter_i_am, lead_supptr_name, lead_supptr_email, lead_supptr_sex, lead_supptr_age, lead_supptr_relationshp, uplod_pic_lead_supptr, fund_mange_sure, fund_mange_idea, fund_mange_name, fund_mange_email, fund_mange_sex, fund_mange_age, fund_mange_relationshp, upload_pic_fun_manager, fundriser_goal_amount, fundr_timeline_from, fundr_timeline_to, fund_can_achiv, search_yes, search_no, video, project_name, project_category, project_champion, champion_logo, champion_bg_image', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'OldUsers', 'user_id'),
			'supporters' => array(self::HAS_MANY, 'Supporter', 'fundraiser_id'),
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
			'fundraiser_description' => 'Fundraiser Description',
			// 'recipient_name' => 'Recipient Name',
			// 'recipient_age' => 'Recipient Age',
			// 'recipient_sex' => 'Recipient Sex',
			// 'recipient_email' => 'Recipient Email',
			// 'recipient_relationship' => 'Recipient Relationship',
			'fundraiser_goal' => 'Fundraiser Goal',
			'fundraiser_amount_need' => 'Fundraiser Amount Need',
			'fundraiser_startdate' => 'Fundraiser Startdate',
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
			'benifiry_name' => 'Non-Profit Name',
			'benifi_age' => 'Non-Profit Age',
			'benifi_sex' => 'Non-Profit Sex',
			'benifi_email' => 'Non-Profit Email',
			'uplod_pic_benif' => 'Upload Non-Profit Logo',
			'uplod_benif_bg' => 'Upload Non-Profit Background Image',
			
			'lead_supporter_not_sure' => 'Not Sure',
			'lead_supporter_i_am' => 'I Am',
			'lead_supptr_name' => 'Lead Supporter Name',
			'lead_supptr_email' => 'Lead Supporter Email',
			'lead_supptr_phone' => 'Lead Supporter Phone',
			'lead_supptr_sex' => 'Lead Supporter Sex',
			'lead_supptr_age' => 'Lead Supporter Age',
			'lead_supptr_relationshp' => 'Lead Supporter Relationshp',
			
			// 'lead_supporter_not_sure' => 'Not Sure',
			// 'lead_supporter_i_am' => 'Lead Sponsor I Am',
			// 'lead_supptr_name' => 'Lead Sponsor Name',
			// 'lead_supptr_email' => 'Lead Sponsor Email',
			// 'lead_supptr_phone' => 'Lead Sponsor Phone',
			// 'lead_supptr_sex' => 'Lead Sponsor Sex',
			// 'lead_supptr_age' => 'Lead Sponsor Age',
			// 'lead_supptr_relationshp' => 'Lead Sponsor Relationshp',

			'uplod_pic_lead_supptr' => 'Upload Lead Supporter Photo',
			'fund_mange_sure' => 'Not Sure',
			'fund_mange_idea' => 'Fund Manager Idea',
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
			'project_champion' => 'Other Champion Name',
			'project_champion_option' => 'Project Champion',
			'champion_logo' => 'Champion Image',
			'champion_bg_image' => 'Champion Background Image',
			'fund_manager_option' => 'Fund Manager',
			'benifi_type' => 'Beneficiary Type', 
			'benifi_name_not_applicable' => 'Beneficiary Name Not Applicable',
			'ftype_typ_other' => 'Other Type'
		);
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

}
