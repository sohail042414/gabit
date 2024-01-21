<?php

Yii::import('application.models._base.BaseLookup');

class Lookup extends BaseLookup
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}