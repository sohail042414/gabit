<?php

/**
 * This is the model base class for the table "report_invitefriends".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ReportInvitefriends".
 *
 * Columns in table "report_invitefriends" available as properties of the model,
 * followed by relations of table "report_invitefriends" available as properties of the model.
 *
 * @property integer $id
 * @property string $receiver_email
 * @property integer $fundraiser_id
 * @property string $service_provider
 * @property string $sender_id
 * @property string $created_at
 * @property string $status
 *
 * @property SetupFundraiser $fundraiser
 */
abstract class BaseReportInvitefriends extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'report_invitefriends';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ReportInvitefriends|ReportInvitefriends', $n);
	}

	public static function representingColumn() {
		return 'receiver_email';
	}

	public function rules() {
		return array(
			array('receiver_email, fundraiser_id, service_provider, sender_id, created_at', 'required'),
			array('fundraiser_id,sender_id', 'numerical', 'integerOnly'=>true),
			array('receiver_email, service_provider', 'length', 'max'=>250),
			array('status', 'length', 'max'=>1),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, receiver_email, fundraiser_id, service_provider, sender_id, created_at, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'fundraiser' => array(self::BELONGS_TO, 'SetupFundraiser', 'fundraiser_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'receiver_email' => Yii::t('app', 'Receiver Email'),
			'fundraiser_id' => null,
			'service_provider' => Yii::t('app', 'Service Provider'),
			'sender_id' => Yii::t('app', 'Sender'),
			'created_at' => Yii::t('app', 'Created At'),
			'status' => Yii::t('app', 'Status'),
			'fundraiser' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('receiver_email', $this->receiver_email, true);
		$criteria->compare('fundraiser_id', $this->fundraiser_id);
		$criteria->compare('service_provider', $this->service_provider, true);
		$criteria->compare('sender_id', $this->sender_id, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}