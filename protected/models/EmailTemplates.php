<?php

Yii::import('application.models._base.BaseEmailTemplates');

class EmailTemplates extends BaseEmailTemplates
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
        } else {
            $this->updated_at = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    public function findByShortCode($short_code){
        return $this->find("short_code =:short_code",array('short_code' => $short_code));
    }

}