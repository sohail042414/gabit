<?php

Yii::import('application.models._base.BaseTestimonial');

class Testimonial extends BaseTestimonial
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('testimonial_by,testimonial_company,testimonial_picture', 'required'),
            array('testimonial_text', 'length', 'max' => 455),
            array('testimonial_by, testimonial_company', 'length', 'max' => 45),
            array('status', 'length', 'max' => 1),
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('testimonial_picture', 'file', 'allowEmpty'=>false, 'types'=>'jpg,jpeg,gif,png'),
            array('updated_date,user_type', 'safe'),
            array('testimonial_text, updated_date', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, testimonial_text, testimonial_by, testimonial_picture, testimonial_company, created_date, updated_date, status,user_id,user_type', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
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
            'testimonial_text' => Yii::t('app', 'Testimonial Message'),
            'testimonial_by' => Yii::t('app', 'Testimonial By'),
            'testimonial_picture' => Yii::t('app', 'Picture'),
            'testimonial_company' => Yii::t('app', 'Testimonial Company'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_type', $this->user_type);
        $criteria->compare('testimonial_text', $this->testimonial_text, true);
        $criteria->compare('testimonial_by', $this->testimonial_by, true);
        $criteria->compare('testimonial_picture', $this->testimonial_picture, true);
        $criteria->compare('testimonial_company', $this->testimonial_company, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);
        $criteria->compare('status', $this->status, true);

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
        } else {
            $this->updated_date = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }
}