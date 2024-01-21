<?php
/**
 * This class has same fields in table as of Donations
 * A transaction is copied to donations when it is completed. 
 */

class Transactions extends CActiveRecord
{
    
    public $country_code;
    public $checked_bx;

    //Rate in percentage.
    public $interswith_fee_rate = 1.5;
    public $giveyourbit_fee_rate = 6.5;
    public $giveyourbit_fee_rate_trdp = 9.5;
    public $processing_fee = 0;
    ///public $signup_check = 1;


	public function tableName() {
		return 'transactions';
	}

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('fundraiser_id,transaction_amount, donor_email, donor_message,age,sex', 'required'),
            array('fundraiser_id,user_id,age', 'numerical', 'integerOnly' => true),
            array('donation_amount,reward_program,transaction_amount,interswitch_fee,giveyourbit_fee', 'numerical'),
            array('trans_ref,donor_name, donor_email, donor_phone_no', 'length', 'max' => 255),
            array('status,sex', 'length', 'max' => 1),
            array('referral_code', 'length', 'max' => 15),
            array('updated_date,payment_response,signup_check,reward_program,referral_code,payment_mode,processed_by', 'safe'),
            array('donor_email', 'email'),

            array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, fundraiser_id, donation_amount, donor_name, donor_email, donor_phone_no, donor_message, user_id, created_date, updated_date, status', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'fundraiser' => array(self::BELONGS_TO, 'SetupFundraiser', 'fundraiser_id'),
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
            'fundraiser_id' => null,
            'transaction_amount' => Yii::t('app', 'Transaction Amount'),
            'donation_amount' => Yii::t('app', 'Donation Amount'),
            'interswitch_fee' => 'Interswitch Fee',
            'giveyourbit_fee' => 'Platform Fee',
            'donor_name' => Yii::t('app', 'Name'),
            'donor_email' => Yii::t('app', 'Email'),
            'donor_phone_no' => Yii::t('app', 'Phone number'),
            'donor_message' => Yii::t('app', 'Donor Message'),
            'user_id' => Yii::t('app', 'User'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'processing_fee' => Yii::t('app', 'Processing Fee'),
            'age' => 'Age',
            'sex' => 'Sex',
            'signup_check' => 'Donor Signup',
            'reward_program' => 'Reward Program',
            'referral_code' => 'Referral Code',
            'payment_mode' => 'Payment Mode',
            'processed_by' => 'Processed By'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fundraiser_id', $this->fundraiser_id);
        $criteria->compare('donation_amount', $this->donation_amount);
        $criteria->compare('donor_name', $this->donor_name, true);
        $criteria->compare('donor_email', $this->donor_email, true);
        $criteria->compare('donor_phone_no', $this->donor_phone_no, true);
        $criteria->compare('donor_message', $this->donor_message, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);
        //$criteria->compare('status', $this->status, true);
        $criteria->addCondition('status= \'Y\'');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function afterFind(){
        $this->processing_fee = number_format(($this->interswitch_fee + $this->giveyourbit_fee),2,'.',',');        
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            
            $fundraiser = Fundraiser::model()->findByPk($this->fundraiser_id);

            $this->interswitch_fee = (($this->interswith_fee_rate/100)*$this->transaction_amount);
            
            if($fundraiser->reward_program == 1){
                $this->reward_program = 1;
                $this->giveyourbit_fee = ((($this->giveyourbit_fee_rate_trdp/100)*$this->transaction_amount)+5);  
            }else{
                $this->giveyourbit_fee = ((($this->giveyourbit_fee_rate/100)*$this->transaction_amount)+5);  
                $this->reward_program = 0;
            }

            $this->donation_amount = $this->transaction_amount - $this->interswitch_fee - $this->giveyourbit_fee;

            $this->created_date = new CDbExpression('NOW()');
        } else {
            $this->updated_date = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }
}
