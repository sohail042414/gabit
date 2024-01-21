<?php

Yii::import('application.models._base.BaseCms');

class Cms extends BaseCms
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function rules() {
		return array(
			array('page_name, page_title, meta_title, meta_desc, meta_keyword, page_content', 'required'),
			array('page_name, page_title, meta_desc, meta_keyword', 'length', 'max'=>255),
			array('meta_title', 'length', 'max'=>45),
			array('status', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, page_name, page_title, meta_title, meta_desc, meta_keyword, page_content, created_date, updated_date, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'page_name' => Yii::t('app', 'Page Name'),
			'page_title' => Yii::t('app', 'Page Title'),
			'meta_title' => Yii::t('app', 'Meta Title'),
			'meta_desc' => Yii::t('app', 'Meta Desc'),
			'meta_keyword' => Yii::t('app', 'Meta Keyword'),
			'page_content' => Yii::t('app', 'Page Content'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('page_name', $this->page_name, true);
		$criteria->compare('page_title', $this->page_title, true);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_desc', $this->meta_desc, true);
		$criteria->compare('meta_keyword', $this->meta_keyword, true);
		$criteria->compare('page_content', $this->page_content, true);
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