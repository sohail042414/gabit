<?php

/**
 * This is the model class for table "affiliates".
 *
 * The followings are the available columns in table 'affiliates':
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $bg_image
 * @property string $email
 * @property string $phone
 * @property string $account_no
 * @property integer $status
 * @property integer $is_champion
 * @property integer $is_fundmanager
 * @property integer $is_supporter
 * @property integer $is_sponsor
 */
class Affiliates extends CActiveRecord
{
	public $logo_file = '';
	public $bg_image_file = '';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'affiliates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('status, is_champion, is_fundmanager, is_supporter, is_sponsor', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('logo, bg_image, email', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>20),
			array('account_no', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, logo, bg_image, email, phone, account_no, status, is_champion, is_fundmanager, is_supporter, is_sponsor,logo_file,bg_image_file', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'logo' => 'Logo',
			'logo_file' => 'Logo',
			'email' => 'Email',
			'phone' => 'Phone',
			'account_no' => 'Account No',
			'status' => 'Status',
			'is_champion' => 'List as Champion',
			'is_fundmanager' => 'List as Fund Manager',
			'is_supporter' => 'List as Supporter',
			'is_sponsor' => 'List as Sponsor',
			'bg_image_file' => 'Background Image',
			'bg_image' => 'Background Image',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('bg_image',$this->bg_image,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('account_no',$this->account_no,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('is_champion',$this->is_champion);
		$criteria->compare('is_fundmanager',$this->is_fundmanager);
		$criteria->compare('is_supporter',$this->is_supporter);
		$criteria->compare('is_sponsor',$this->is_sponsor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Affiliates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getStatusText(){
		if((int)$this->status == 1){
			return "Active";
		}
		return "Disabled";
	}

	public function getChampionText(){
		if((int)$this->is_champion == 1){
			return "Yes";
		}
		return "No";
	}

	public function getFundManagerText(){
		if((int)$this->is_fundmanager == 1){
			return "Yes";
		}
		return "No";
	}

	public function getSupporterText(){
		if((int)$this->is_supporter == 1){
			return "Yes";
		}
		return "No";
	}

	public function getSponsorText(){
		if((int)$this->is_sponsor == 1){
			return "Yes";
		}
		return "No";
	}

	public function getLogoUrl($width = ''){
		if($width !=''){
			return '<img class="preview_image" style="width:'.(int)$width.'px;" src="' . SITE_ABS_PATH_AFFILIATE_IMAGE . $this->logo . '" alt="" />';					
		}
		
		return '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $this->logo . '" alt="" />';		
		//return '<img class="preview_image" src="' . SITE_ABS_PATH_AFFILIATE_IMAGE . $this->logo . '" alt="" />';		
	}

	public function getBgImageUrl(){
		//return '<img class="preview_image" src="' . SITE_ABS_PATH_AFFILIATE_IMAGE . $this->bg_image . '" alt="" />';
		return '<img class="preview_image" src="' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $this->bg_image . '" alt="" />';
	}

	public function uploadLogo() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'logo_file');

            if (!is_object($imageObject)) {
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->logo = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }


	public function uploadBgImage() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'bg_image_file');

            if (!is_object($imageObject)) {
                $this->addError('logo', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->bg_image = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }


}
