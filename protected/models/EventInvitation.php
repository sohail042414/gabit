<?php

Yii::import('application.models._base.BaseEventInvitation');

class EventInvitation extends BaseEventInvitation
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        
        public function rules() {
		return array(
			array('user_id, event_name, event_cordinator, email, event_type, event_desc, event_startdate, event_enddate, location, city, state, country, attached_itinerary, created_date', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),			
			array('attached_itinerary', 'file', 'allowEmpty'=>false, 'types'=>'doc,pdf'),
			array('email','email'),
			array('status_new','length', 'max'=>1),
			array('event_name, event_cordinator, email, event_type, event_desc, location, city, state, country', 'length', 'max'=>250),
			array('attached_itinerary', 'length', 'max'=>255),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, event_name, event_cordinator, email, event_type, event_desc, event_startdate, event_enddate, location, city, state, country, attached_itinerary, created_date, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => null,
			'event_name' => Yii::t('app', 'Event Name'),
			'event_cordinator' => Yii::t('app', 'Event Cordinator'),
			'email' => Yii::t('app', 'Email'),
			'event_type' => Yii::t('app', 'Event Type'),
			'event_desc' => Yii::t('app', 'Event Description'),
			'event_startdate' => Yii::t('app', 'Event Startdate'),
			'event_enddate' => Yii::t('app', 'Event Enddate'),
			'location' => Yii::t('app', 'Location'),
			'city' => Yii::t('app', 'City'),
			'state' => Yii::t('app', 'State'),
			'country' => Yii::t('app', 'Country'),
			'attached_itinerary' => Yii::t('app', 'Attach Itinerary'),
			'created_date' => Yii::t('app', 'Created Date'),
			'status' => Yii::t('app', 'Status'),
			//'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('event_name', $this->event_name, true);
		$criteria->compare('event_cordinator', $this->event_cordinator, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('event_type', $this->event_type, true);
		$criteria->compare('event_desc', $this->event_desc, true);
		$criteria->compare('event_startdate', $this->event_startdate, true);
		$criteria->compare('event_enddate', $this->event_enddate, true);
		$criteria->compare('location', $this->location, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('attached_itinerary', $this->attached_itinerary, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('status_new', $this->status_new);		

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
		));
	}
        
         public function beforeSave()
        {
            if ($this->isNewRecord) {
                $this->created_date = new CDbExpression('NOW()');
            }

            return parent::beforeSave();
        }
}