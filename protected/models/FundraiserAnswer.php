<?php

Yii::import('application.models._base.BaseFundraiserAnswer');

class FundraiserAnswer extends BaseFundraiserAnswer
{
    public $answer_text;
    public $question_id;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('id, user_id, questions_id', 'required'),
            array('id, user_id, questions_id', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 1),
            array('updated_date', 'safe'),
            array('updated_date', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, user_id, questions_id, answer_text, created_date, updated_date, status', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'questions' => array(self::BELONGS_TO, 'FundraiserQuestions', 'questions_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
            'questions_id' => null,
            'answer_text' => Yii::t('app', 'Answer'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'questions' => null,
            'user' => null,
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('questions_id', $this->questions_id);
        $criteria->compare('answer_text', $this->answer_text, true);
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