<?php

Yii::import('application.models._base.BaseSystemRoleBasePermission');

class SystemRoleBasePermission extends BaseSystemRoleBasePermission
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'User Permission|User Permissions', $n);
    }

    public function rules()
    {
        return array(
            array('role_id, controller_id,allow_all_actions', 'required'),
            array('action_id', 'required', 'on' => 'allow_action_validation'),

            array('role_id, controller_id, action_id', 'numerical', 'integerOnly' => true),
            array('allow_all_actions, status', 'length', 'max' => 1),
            array('action_id, allow_all_actions, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, role_id, controller_id, action_id, allow_all_actions, status', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'role_id' => 'Role',
            'controller_id' => 'Controller',
            'action_id' => 'Action',
            'allow_all_actions' => Yii::t('app', 'Allow All Actions'),
            'status' => Yii::t('app', 'Status'),
            'action' => 'Action',
            'controller' => 'Controller',
            'role' => 'Role',
        );
    }

    public function beforeSave()
    {
        return true;
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('controller_id', $this->controller_id);
        $criteria->compare('action_id', $this->action_id);
        $criteria->compare('allow_all_actions', $this->allow_all_actions, true);
        $criteria->compare('status', $this->status, true);
        $criteria->addCondition("role_id != 1");

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}