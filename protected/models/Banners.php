<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $mobile_image
 * @property string $url
 */
class Banners extends CActiveRecord
{

	public $image_file;
	public $mobile_image_file;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>100),
			array('image,mobile_image, url', 'length', 'max'=>255),
			array('image_file,mobile_image','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image, url', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'image' => 'Image',
			'url' => 'Url',
			'mobile_image' => 'Mobile Image',
			'image_file' => 'Banner Image',
			'mobile_image_file' => 'Mobile Banner Image',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	public function uploadImage() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'image_file');

            if (!is_object($imageObject)) {
                $this->addError('image_file', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = BANNER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			//EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->image = $image_name;                    
            
        } catch (Exception $ex) {
			// echo '<pre>';
			// print_r($ex);
			// exit; 
        }
    }



	public function uploadMobileImage() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'mobile_image_file');

            if (!is_object($imageObject)) {
                $this->addError('mobile_image_file', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = BANNER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			//EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->mobile_image = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }

	public function getImageUrl($width = ''){

		if($width !=''){
			return '<img class="preview_image" style="width:'.(int)$width.'px;" src="' . SITE_ABS_PATH_BANNER_IMAGE . $this->image . '" alt="" />';					
		}	

		return '<img class="preview_image" src="' . SITE_ABS_PATH_BANNER_IMAGE . $this->image . '" alt="" />';		

	}

	public function getMobileImageUrl($width = ''){
		if($width !=''){
			return '<img class="preview_image" style="width:'.(int)$width.'px;" src="' . SITE_ABS_PATH_BANNER_IMAGE . $this->mobile_image . '" alt="" />';					
		}
		
		return '<img class="preview_image" src="' . SITE_ABS_PATH_BANNER_IMAGE . $this->mobile_image . '" alt="" />';		
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
