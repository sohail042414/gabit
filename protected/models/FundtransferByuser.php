<?php

/**
 * This is the model class for table "fundtransfer_byuser".
 *
 * The followings are the available columns in table 'fundtransfer_byuser':
 * @property integer $id
 * @property integer $user_id
 * @property integer $fundraiser_account
 * @property integer $created_by
 * @property string $created_date
 * @property integer $updated_by
 * @property string $updated_date
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class FundtransferByuser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fundtransfer_byuser';
	}


	public static function label($n = 1)
	{
		return Yii::t('app', 'Fund Transfer Requests', $n);
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public $is_checked;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fundraiser_id,thankyou_message_for_supporters,account_number,bank_name,account_name', 'required'),
			array('user_id,reward_program,fundraiser_account, created_by, updated_by,account_number,amount_transferred', 'numerical', 'integerOnly' => true),
			array('status_new', 'length', 'max' => 1),
			array('status', 'length', 'max' => '20'),
			array('admin_message', 'length', 'max' => '300'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, fundraiser_account, thankyou_message_for_supporters,fund_manger_account_details, fundraiser_success_testimony, created_by,account_number,bank_name,account_name, created_date, updated_by, updated_date, status', 'safe', 'on' => 'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'fundraiser' => array(self::BELONGS_TO, 'Fundraiser', 'fundraiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'fundraiser_account' => 'Fund Manager Account no.',
			'fund_manger_account_details' => 'Enter Fund Manager Account Details',
			'bank_name' => 'Bank Name',
			'account_number' => 'Account Number',
			'account_name' => 'Account Name',
			'thankyou_message_for_supporters' => 'Enter A Thank You Message For Your Supporters And Donors',
			'fundraiser_success_testimony' => 'Enter Your Fundraiser Success Testimony',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'updated_by' => 'Updated By',
			'updated_date' => 'Updated Date',
			'fundraiser_id' => 'Select Fundraiser',
			'status' => 'Status',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('fundraiser_account', $this->fundraiser_account);
		$criteria->compare('fund_manger_account_details', $this->fund_manger_account_details);

		$criteria->compare('bank_name', $this->bank_name);
		$criteria->compare('account_number', $this->account_number);
		$criteria->compare('account_name', $this->account_name);

		$criteria->compare('thankyou_message_for_supporters', $this->thankyou_message_for_supporters);
		$criteria->compare('fundraiser_success_testimony', $this->fundraiser_success_testimony);
		$criteria->compare('created_by', $this->created_by);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_by', $this->updated_by);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
		));
	}

	/**
	 * return sum of all fund transfer requests that were against fundraisers on reward parogram
	 * and have been completed. 
	 */
	public function getRewardPayoutTotal(){
		
		$total_amount  = Yii::app()->db->createCommand()
		->select('sum(frq.amount_transferred) as total_amount')
		->from('fundtransfer_byuser as frq')
		->join('setup_fundraiser fr','frq.fundraiser_id = fr.id')
		->where('frq.status = \'completed\'')
		->andWhere('frq.reward_program = 1')
		->andWhere('fr.reward_program = 1')
		->queryScalar();

		return $total_amount;	
	}

	public function getNormalPayoutTotal(){
		
		$total_amount  = Yii::app()->db->createCommand()
		->select('sum(frq.amount_transferred) as total_amount')
		->from('fundtransfer_byuser as frq')
		->join('setup_fundraiser fr','frq.fundraiser_id = fr.id')
		->where('frq.status = \'completed\'')
		->andWhere('frq.reward_program = 0')
		->queryScalar();

		return $total_amount;	
	}


	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FundtransferByuser the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
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
