<?php

/**
 * This is the model class for table "case_updates".
 *
 * The followings are the available columns in table 'case_updates':
 * @property integer $id
 * @property string $message_update
 * @property string $image
 */
class CaseUpdates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'case_updates';
	}
    
	public $update_date;

	public $image_file;
	public $document1_file;
	public $document2_file;
	public $document3_file;
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message_update,image,fundraiser_id', 'required'),
			//array('image', 'required', 'on'=>'create' ,'message' => 'Please upload an image'),
			array('image', 'length', 'max'=>240),
			array('video,document1,document2,document3', 'length', 'max'=>240),
			array('message_update', 'length', 'max'=>500, 'message'=>'Enter Update text is too long (maximum is 600 characters).'),                    
			array('fundraiser_id', 'numerical', 'message' => 'Please select fundraiser '),
			array('video,image_file,document1_file,document2_file,document3_file', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, message_update', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'fundraiser' => array(self::BELONGS_TO, 'Fundraiser', 'fundraiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'fundraiser_id' => Yii::t('app','Select Fundraiser'),
			'user_id' => Yii::t('app','USER id'),
			'user_name' => Yii::t('app','USER Name'),
			'user_email' => Yii::t('app','USER Email'),
			'message_update' =>Yii::t('app','Enter Update'),
			'image' => Yii::t('app', 'Upload Photo'),
			'video' => Yii::t('app', 'Enter Youtube Video Link'),
			'document1' => 'Document 1',
			'document2' => 'Document 2',
			'document3' => 'Document 3',
			'image_file' => 'Image',
			'document1_file' => 'Document 1',
			'document2_file' => 'Document 2',
			'document3_file' => 'Document 3',
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
		$criteria->compare('fundraiser_id',$this->fundraiser_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name);
		$criteria->compare('user_email',$this->user_email);
		$criteria->compare('message_update',$this->message_update,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('video',$this->video,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function uploadImage(){

		$case_update_image = CUploadedFile::getInstance($this, 'image_file');

		if(is_object($case_update_image)){

			$file_extension = $case_update_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = IMAGE_ORIGINAL . $image_name;
			$case_update_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(IMAGE_THUMBNAIL . IMAGE_THUMB_NAME . $image_name);
			$this->image = $image_name;
		}
	}



	public function uploadDocuments(){

		$document1_file = CUploadedFile::getInstance($this, 'document1_file');

		if(is_object($document1_file)){

			$file_extension = $document1_file->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$document_1_name = $random_filename . "." . $file_extension;
			$original_path = IMAGE_ORIGINAL . $document_1_name;
			$document1_file->saveAs($original_path);
			$this->document1 = $document_1_name;
		}

		$document2_file = CUploadedFile::getInstance($this, 'document2_file');

		if(is_object($document2_file)){

			$file_extension = $document2_file->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$document_2_name = $random_filename . "." . $file_extension;
			$original_path = IMAGE_ORIGINAL . $document_2_name;
			$document2_file->saveAs($original_path);
			$this->document2 = $document_2_name;
		}

		$document3_file = CUploadedFile::getInstance($this, 'document3_file');

		if(is_object($document3_file)){

			$file_extension = $document3_file->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$document_3_name = $random_filename . "." . $file_extension;
			$original_path = IMAGE_ORIGINAL . $document_3_name;
			$document3_file->saveAs($original_path);
			$this->document3 = $document_3_name;
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CaseUpdates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
