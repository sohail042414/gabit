<?php

Yii::import('application.models._base.BaseSupporter');

class Supporter extends BaseSupporter
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('supporter_email', 'required'),
            array('user_id, fundraiser_id', 'numerical', 'integerOnly' => true),
            array('supporter_email, supporter_image', 'length', 'max' => 255),
            array('status,status_new', 'length', 'max' => 1),
            array('supporter_email', 'email'),
	        array('supporter_email', 'checkuniqueEmail','on'=>'insert'),
            array('updated_date', 'safe'),
            array('supporter_image', 'file', 'allowEmpty'=>false, 'types'=>'jpg,jpeg,gif,png'),
            array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, user_id, supporter_email, fundraiser_id, supporter_image, supporter_message, created_date, updated_date, status,status_new', 'safe', 'on' => 'search'),
        );
    }
    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'user_id' => null,
            'supporter_email' => Yii::t('app', 'Supporter Email'),
            'fundraiser_id' => null,
            'supporter_image' => Yii::t('app', 'Supporter Image'),
            'supporter_message' => Yii::t('app', 'Supporter Message'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'fundraiser' => null,
            'user' => null,
        );
    }
    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('supporter_email', $this->supporter_email, true);
        $criteria->compare('fundraiser_id', $this->fundraiser_id);
        $criteria->compare('supporter_image', $this->supporter_image, true);
        $criteria->compare('supporter_message', $this->supporter_message, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('status_new', $this->status_new);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
        ));
    }

    public function relations()
    {
        return array(
            'fundraiser' => array(self::BELONGS_TO, 'SetupFundraiser', 'fundraiser_id'),
            'relation' => array(self::BELONGS_TO, 'Relationship', 'relation_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
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
    public function checkuniqueEmail($attribute,$params)
    {
      $check_unique_email = Supporter::model()->findAllByAttributes(array('supporter_email' =>$this->supporter_email,'fundraiser_id'=>$this->fundraiser_id));

        if(count($check_unique_email)>0){
             $this->addError($attribute, 'You are already a supporter of this fundraiser.');
        }
    }



    public function getCurrentMonthSupporterCount($user_id = 0){

        $user = Yii::app()->frontUser;

        $donation_count = 0;

        if(!$user->isGuest && $user_id==0){
            $user_id = $user->getState('id');
        }

        $year = date('Y');
        $month = date('F');

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $donation_count = $this->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date',array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
        ));
        
        return $donation_count;

    }


    public function getUserMonthSupporterCount($year,$month,$user_id = 0){

        $user = Yii::app()->frontUser;

        $donation_count = 0;

        if(!$user->isGuest && $user_id==0){
            $user_id = $user->getState('id');
        }

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $donation_count = $this->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date',array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
        ));
        
        return $donation_count;

    }
}
