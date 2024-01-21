<?php

Yii::import('application.models._base.BaseReportFundraiser');

class ReportFundraiser extends BaseReportFundraiser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public $fundraiser_title;
	public $user_id;
        public function rules() {
		return array(
			array('fundraiser_id, user_name, email, description, created_date', 'required'),
			array('fundraiser_id', 'numerical', 'integerOnly'=>true),
			array('user_name, email, description', 'length', 'max'=>250),
			array('email','email'),
			array('status', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, fundraiser_id, user_name, email, description, created_date, updated_date, status', 'safe', 'on'=>'search'),
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
			'fundraiser_id' => Yii::t('app', 'Fundraiser'),
			'user_name' => Yii::t('app', 'Name'),
			'email' => Yii::t('app', 'Email'),
			'description' => Yii::t('app', 'Describe your reason for flagging this page:'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('fundraiser_id', $this->fundraiser_id);
		$criteria->compare('user_name', $this->user_name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
		));
	}
}
