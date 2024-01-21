<?php

/**
 * This is the model class for table "user_messaging".
 *
 * The followings are the available columns in table 'user_messaging':
 * @property integer $id
 * @property string $user_id
 * @property string $name
 * @property string $email
 * @property string $message
 */
class UserMessaging extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_messaging';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, message', 'required'),
			array('user_id, name, email', 'length', 'max'=>200),
                        array('email', 'email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, email, message', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' =>  Yii::t('app', 'ID'),
                        'user_mail' =>  Yii::t('app', 'Mail Address To Send'),
			'user_id' =>  Yii::t('app', 'User'),
			'name' =>  Yii::t('app', 'Your Name'),
			'email' =>  Yii::t('app', 'Your Email'),
			'message' =>  Yii::t('app', 'Message'),
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
                $criteria->compare('user_mail',$this->user_mail,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMessaging the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
