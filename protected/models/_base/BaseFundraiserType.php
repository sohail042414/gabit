<?php

/**
 * This is the model base class for the table "fundraiser_type".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "FundraiserType".
 *
 * Columns in table "fundraiser_type" available as properties of the model,
 * followed by relations of table "fundraiser_type" available as properties of the model.
 *
 * @property integer $id
 * @property string $fundraiser_type
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 *
 * @property SetupFundraiser[] $setupFundraisers
 */
abstract class BaseFundraiserType extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'fundraiser_type';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Fundraiser Category|Fundraiser Categories', $n);
	}

	public static function representingColumn() {
		return 'fundraiser_type';
	}

	public function rules() {
		return array(
			array('fundraiser_type', 'length', 'max'=>255),
			array('updated_date', 'length', 'max'=>45),
			array('status', 'length', 'max'=>1),
			array('created_date', 'safe'),
			array('fundraiser_type, created_date, updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, fundraiser_type, created_date, updated_date, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'setupFundraisers' => array(self::HAS_MANY, 'SetupFundraiser', 'ftype_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'fundraiser_type' => Yii::t('app', 'Fundraiser Type'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
			'setupFundraisers' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('fundraiser_type', $this->fundraiser_type, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}