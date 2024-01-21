<?php

Yii::import('application.models._base.BaseHomeSlider');

class HomeSlider extends BaseHomeSlider
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function rules() {
		return array(
			array('status,slider_image', 'required'),
//			array('slider_title, slider_content, status', 'required'),
			array('slider_title, slider_content, slider_image', 'length', 'max'=>255),
            array('slider_image', 'file', 'allowEmpty'=>false, 'types'=>'jpg,jpeg,gif,png'),
			array('status', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			array('updated_date', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, slider_title, slider_content, slider_image, created_date, updated_date, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'slider_title' => Yii::t('app', 'Slider Title'),
			'slider_content' => Yii::t('app', 'Slider Content'),
			'slider_image' => Yii::t('app', 'Slider Image'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('slider_title', $this->slider_title, true);
		$criteria->compare('slider_content', $this->slider_content, true);
		$criteria->compare('slider_image', $this->slider_image, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}