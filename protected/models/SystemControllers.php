<?php

Yii::import('application.models._base.BaseSystemControllers');

class SystemControllers extends BaseSystemControllers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}