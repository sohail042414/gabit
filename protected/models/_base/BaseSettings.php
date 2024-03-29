<?php

/**
 * This is the model base class for the table "settings".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Settings".
 *
 * Columns in table "settings" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $site_name
 * @property string $address
 * @property string $email_id
 * @property string $phone_no
 *
 */
abstract class BaseSettings extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'settings';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Settings|Settings', $n);
	}

	public static function representingColumn() {
		return 'site_name';
	}

	public function rules() {
		return array(
			array('id, site_name, address, email_id, phone_no', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('site_name, address, email_id', 'length', 'max'=>250),
			array('phone_no', 'length', 'max'=>15),
			array('id, site_name, address, email_id, phone_no', 'safe', 'on'=>'search'),
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
			'site_name' => Yii::t('app', 'Site Name'),
			'address' => Yii::t('app', 'Address'),
			'email_id' => Yii::t('app', 'Email'),
			'phone_no' => Yii::t('app', 'Phone No'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('site_name', $this->site_name, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('email_id', $this->email_id, true);
		$criteria->compare('phone_no', $this->phone_no, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}