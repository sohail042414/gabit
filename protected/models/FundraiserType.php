<?php

Yii::import('application.models._base.BaseFundraiserType');

class FundraiserType extends BaseFundraiserType
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('fundraiser_type', 'length', 'max' => 255),
            array('image', 'length', 'max' => 255),
            array('updated_date', 'length', 'max' => 45),
            array('status', 'length', 'max' => 1),
            array('created_date,image', 'safe'),
            array('fundraiser_type, created_date, updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, fundraiser_type,type_description, created_date, updated_date, status', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'setupFundraisers' => array(self::HAS_MANY, 'SetupFundraiser', 'ftype_id'),
        );
    }

    public function pivotModels()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'fundraiser_type' => Yii::t('app', 'Fundraiser Category'),
            'type_description' => Yii::t('app', 'Category Description'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'setupFundraisers' => null,
            'image' => 'Image'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fundraiser_type', $this->fundraiser_type, true);
        $criteria->compare('type_description', $this->type_description, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }



    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_date = new CDbExpression('NOW()');
        } else {
            $this->updated_date = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    public function uploadImage() {

        try {

            

            $category_image = CUploadedFile::getInstance($this, 'image');

            if (!is_object($category_image)) {
                $this->addError('logo', 'No File selected!');
                return FALSE;
            } 

			$file_extension = $category_image->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$category_image->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);			                 
			
            $this->image = $image_name;

        } catch (Exception $ex) {
            echo '<pre>';
			print_r($ex);
			exit; 
        }
    }


    public function makeSlug($text = ''){

        if($text == ''){
            $text = $this->fundraiser_type;
        }

        $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $text);
        $title = str_replace("'", '', $title);
        $title = strtolower($title);

        return $title;
    }


    public function makeUrl(){
        return Yii::app()->createUrl('fundraiser/category', array('id' => $this->id, 'category_name' => $this->makeSlug()));
    }

    public function getFundraisersCount(){
        return Fundraiser::model()->count('ftype_id = '.$this->id);
    }

    public function getActiveFundraisersCount(){
        return Fundraiser::model()->count("ftype_id = ".$this->id." AND status='Y'");
    }
}