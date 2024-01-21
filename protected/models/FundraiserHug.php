<?php

Yii::import('application.models._base.BaseFundraiserHug');

class FundraiserHug extends BaseFundraiserHug
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('id, fundraiser_id, ip_address', 'required'),
            array('id, fundraiser_id', 'numerical', 'integerOnly' => true),
            array('ip_address', 'length', 'max' => 250),
            array('status', 'length', 'max' => 1),
            array('updated_date', 'safe'),
            array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, fundraiser_id, ip_address, created_date, updated_date, status', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'fundraiser' => array(self::BELONGS_TO, 'SetupFundraiser', 'fundraiser_id'),
        );
    }

    public function pivotModels()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'fundraiser_id' => null,
            'ip_address' => Yii::t('app', 'Ip Address'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'fundraiser' => null,
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fundraiser_id', $this->fundraiser_id);
        $criteria->compare('ip_address', $this->ip_address, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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