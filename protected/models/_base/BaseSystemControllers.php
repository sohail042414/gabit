<?php

/**
 * This is the model base class for the table "system_controllers".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SystemControllers".
 *
 * Columns in table "system_controllers" available as properties of the model,
 * followed by relations of table "system_controllers" available as properties of the model.
 *
 * @property integer $id
 * @property string $controller_name
 * @property string $status
 *
 * @property SystemActions[] $systemActions
 * @property SystemRoleBasePermission[] $systemRoleBasePermissions
 */
abstract class BaseSystemControllers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'system_controllers';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'SystemControllers|SystemControllers', $n);
	}

	public static function representingColumn() {
		return 'controller_name';
	}

	public function rules() {
		return array(
			array('controller_name', 'required'),
			array('controller_name', 'length', 'max'=>250),
			array('status', 'length', 'max'=>1),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, controller_name, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'systemActions' => array(self::HAS_MANY, 'SystemActions', 'controller_id'),
			'systemRoleBasePermissions' => array(self::HAS_MANY, 'SystemRoleBasePermission', 'controller_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'controller_name' => Yii::t('app', 'Controller Name'),
			'status' => Yii::t('app', 'Status'),
			'systemActions' => null,
			'systemRoleBasePermissions' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('controller_name', $this->controller_name, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}