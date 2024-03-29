<?php

/**
 * This is the model base class for the table "patner".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Patner".
 *
 * Columns in table "patner" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $patner_title
 * @property string $patner_image
 * @property string $created_date
 * @property string $status
 *
 */
abstract class BasePatner extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'patner';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Patner|Patners', $n);
	}

	public static function representingColumn() {
		return 'patner_title';
	}

	public function rules() {
		return array(
			array('patner_title, patner_image, created_date', 'required'),
			array('patner_title, patner_image', 'length', 'max'=>255),
			array('status', 'length', 'max'=>1),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, patner_title, patner_image, created_date, status', 'safe', 'on'=>'search'),
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
			'patner_title' => Yii::t('app', 'Patner Title'),
			'patner_image' => Yii::t('app', 'Patner Image'),
			'created_date' => Yii::t('app', 'Created Date'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('patner_title', $this->patner_title, true);
		$criteria->compare('patner_image', $this->patner_image, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}