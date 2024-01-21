<?php

Yii::import('application.models._base.BaseDonations');

class Donations extends BaseDonations
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('fundraiser_id, donation_amount, donor_name, donor_email, donor_phone_no', 'required'),
            array('fundraiser_id, user_id', 'numerical', 'integerOnly' => true),
            array('donation_amount', 'numerical'),
            array('donor_name, donor_email, donor_phone_no', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('updated_date', 'safe'),
            array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, fundraiser_id, donation_amount, donor_name, donor_email, donor_phone_no, donor_message, user_id, created_date, updated_date, status', 'safe', 'on' => 'search'),
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
            'donation_amount' => Yii::t('app', 'Donation Amount'),
            'donor_name' => Yii::t('app', 'Name'),
            'donor_email' => Yii::t('app', 'Email'),
            'donor_phone_no' => Yii::t('app', 'Phone number'),
            'donor_message' => Yii::t('app', 'Donor Message'),
            'user_id' => Yii::t('app', 'User'),
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
        $criteria->compare('donation_amount', $this->donation_amount);
        $criteria->compare('donor_name', $this->donor_name, true);
        $criteria->compare('donor_email', $this->donor_email, true);
        $criteria->compare('donor_phone_no', $this->donor_phone_no, true);
        $criteria->compare('donor_message', $this->donor_message, true);
        $criteria->compare('user_id', $this->user_id);
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