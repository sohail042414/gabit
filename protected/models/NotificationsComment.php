<?php

Yii::import('application.models._base.BaseNotificationsComment');

class NotificationsComment extends BaseNotificationsComment
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function beforeSave()
        {
            if ($this->isNewRecord) {
                $this->created_date = new CDbExpression('NOW()');
            } else {
                $this->updated_date = new CDbExpression('NOW()');
            }

            return parent::beforeSave();
        }
}