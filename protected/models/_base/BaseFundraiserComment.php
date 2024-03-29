<?php

/**
 * This is the model base class for the table "fundraiser_comment".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "FundraiserComment".
 *
 * Columns in table "fundraiser_comment" available as properties of the model,
 * followed by relations of table "fundraiser_comment" available as properties of the model.
 *
 * @property integer $id
 * @property integer $fundraiser_reference_id
 * @property string $name
 * @property string $email
 * @property string $comment
 * @property string $comment_status
 * @property string $approval_date
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 *
 * @property SetupFundraiser $fundraiserReference
 */
abstract class BaseFundraiserComment extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'fundraiser_comment';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'FundraiserComment|FundraiserComments', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('fundraiser_reference_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>255),
			array('comment_status, status', 'length', 'max'=>1),
			array('updated_date', 'length', 'max'=>45),
			array('comment, approval_date, created_date', 'safe'),
			array('fundraiser_reference_id, name, email, comment, comment_status, approval_date, created_date, updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, fundraiser_reference_id, name, email, comment, comment_status, approval_date, created_date, updated_date, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'fundraiserReference' => array(self::BELONGS_TO, 'SetupFundraiser', 'fundraiser_reference_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'fundraiser_reference_id' => null,
			'name' => Yii::t('app', 'Name'),
			'email' => Yii::t('app', 'Email'),
			'comment' => Yii::t('app', 'Comment'),
			'comment_status' => Yii::t('app', 'Comment Status'),
			'approval_date' => Yii::t('app', 'Approval Date'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
			'fundraiserReference' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('fundraiser_reference_id', $this->fundraiser_reference_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('comment', $this->comment, true);
		$criteria->compare('comment_status', $this->comment_status, true);
		$criteria->compare('approval_date', $this->approval_date, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}