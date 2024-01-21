<?php

Yii::import('application.models._base.BaseTopic');

class Topic extends BaseTopic
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('topic_type, created_by, status', 'required'),
            array('created_by', 'numerical', 'integerOnly' => true),
            array('topic_type', 'length', 'max' => 250),
            array('status', 'length', 'max' => 1),
            array('updated_date', 'safe'),
            array('updated_date', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, topic_type, created_by, created_date, updated_date, status', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'fundraiserQuestions' => array(self::HAS_MANY, 'FundraiserQuestions', 'topic_id','condition'=>'fundraiserQuestions.status = "Y"  '),
            'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
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
            'topic_type' => Yii::t('app', 'Topic Type'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'fundraiserQuestions' => null,
            'createdBy' => null,
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('topic_type', $this->topic_type, true);
        $criteria->compare('created_by', $this->created_by);
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