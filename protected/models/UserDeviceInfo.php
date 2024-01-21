<?php

Yii::import('application.models._base.BaseUserDeviceInfo');

class UserDeviceInfo extends BaseUserDeviceInfo
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}