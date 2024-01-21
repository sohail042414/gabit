<?php

Yii::import('application.models._base.BaseFundraiserQuestions');

class FundraiserQuestions extends BaseFundraiserQuestions
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('user_id, topic_id,questions_text, status', 'required'),
            array('user_id, topic_id', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 1),
            array('updated_date', 'safe'),
            array('updated_date', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, user_id, topic_id, questions_text, created_date, updated_date, notify_status,status', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'fundraiserAnswers' => array(self::HAS_MANY, 'FundraiserAnswer', 'questions_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'topic' => array(self::BELONGS_TO, 'Topic', 'topic_id'),
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
            'user_id' => null,
            'topic_id' => null,
            'questions_text' => Yii::t('app', 'Questions'),
            'notify_status' => Yii::t('app', 'Notify Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'fundraiserAnswers' => null,
            'fundraiser' => null,
            'user' => null,
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('topic_id', $this->topic_id);
        $criteria->compare('questions_text', $this->questions_text, true);
        $criteria->compare('notify_status', $this->notify_status, true);
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