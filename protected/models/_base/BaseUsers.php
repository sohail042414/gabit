<?php

/**
 * This is the model base class for the table "users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Users".
 *
 * Columns in table "users" available as properties of the model,
 * followed by relations of table "users" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_type
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 *
 * @property Meeting[] $meetings
 * @property UserRoles $userType
 */
abstract class BaseUsers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Users|Users', $n);
	}

	public static function representingColumn() {
		return 'first_name';
	}

	public function rules() {
		return array(
			array('user_type, first_name, last_name, username, email,designation,created_date', 'required'),
			array('user_type', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name', 'length', 'max'=>150),
			array('username, email , designation', 'length', 'max'=>250),
			array('password', 'length', 'max'=>32),
			array('status', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_type, first_name, last_name, username, email, designation ,password, created_date, updated_date, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'meetings' => array(self::HAS_MANY, 'Meeting', 'user_id'),
			'userType' => array(self::BELONGS_TO, 'UserRoles', 'user_type'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_type' => null,
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'username' => Yii::t('app', 'Username'),
			'email' => Yii::t('app', 'Email'),
			'designation' => Yii::t('app', 'Designation'),
			'password' => Yii::t('app', 'Password'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
			'meetings' => null,
			'userType' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_type', $this->user_type);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}