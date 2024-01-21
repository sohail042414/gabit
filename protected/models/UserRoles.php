<?php

Yii::import('application.models._base.BaseUserRoles');

class UserRoles extends BaseUserRoles
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'User Role|User Roles', $n);
    }

    public static function representingColumn()
    {
        return 'user_role';
    }

    public function rules()
    {
        return array(
            array('user_role', 'required'),
            array('user_role', 'unique'),
            array('user_role', 'length', 'max' => 250),
            array('created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 1),
            array('updated_date', 'safe'),
            array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, user_role, created_date, updated_date, created_by, updated_by, status', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'user_role' => Yii::t('app', 'User Role'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'users' => null,
        );
    }
}