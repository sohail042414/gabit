<?php

/**
 * This is the model class for table "fundraiser_sub_type".
 *
 * The followings are the available columns in table 'fundraiser_sub_type':
 * @property integer $id
 * @property string $fundraiser_subtyp
 * @property string $type_description
 * @property string $created_date
 * @property string $updated_date
 * @property string $status
 * @property integer $p_id
 */
class FundraiserSubType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fundraiser_sub_type';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Fundraiser Category|Fundraiser Categories', $n);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fundraiser_subtyp, status, p_id', 'required'),
			array('p_id', 'numerical', 'integerOnly'=>true),
			array('fundraiser_subtyp, created_date, updated_date, status', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fundraiser_subtyp, type_description, created_date, updated_date, status, p_id', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'FundraiserType', 'p_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fundraiser_subtyp' => 'Fundraiser Type',
			'type_description' => 'Description',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
			'status' => 'Status',
			'p_id' => 'Category',
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
		$criteria->compare('fundraiser_subtyp',$this->fundraiser_subtyp,true);
		$criteria->compare('type_description',$this->type_description,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('p_id',$this->p_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FundraiserSubType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_date = new CDbExpression('NOW()');
			$this->updated_date = new CDbExpression('NOW()');
        } else {
            $this->updated_date = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }
}
