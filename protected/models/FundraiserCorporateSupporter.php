<?php

/**
 * This is the model class for table "corporate_supporter".
 *
 * The followings are the available columns in table 'corporate_supporter':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $website_url
 */
class FundraiserCorporateSupporter extends CActiveRecord
{


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fundraiser_corporate_supporters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fundraiser_id,corporate_supporter_id', 'required'),
			array('fundraiser_id,corporate_supporter_id','numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'fundraiser' => array(self::BELONGS_TO, 'Fundraiser', 'fundraiser_id'),
			'supporter' => array(self::BELONGS_TO, 'CorporateSupporter', 'corporate_supporter_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fundraiser_id' => 'Fundraiser',
			'corporate_supporter_id' => 'Corporate Supporter'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fundraiser_id',$this->fundraiser_id);
		$criteria->compare('corporate_supporter_id',$this->corporate_supporter_id);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CorporateSupporter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
