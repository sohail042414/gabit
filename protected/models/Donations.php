<?php

Yii::import('application.models._base.BaseDonations');

class Donations extends BaseDonations
{
    
    public $country_code;
    public $checked_bx;
    
    //Rate in percentage.
    public $interswith_fee_rate = 1.5;
    public $giveyourbit_fee_rate = 6;
    public $processing_fee = 0;
    public $signup_check = 1;


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('fundraiser_id, donation_amount, donor_email, donor_message,age,sex', 'required'),
            array('fundraiser_id, user_id', 'numerical', 'integerOnly' => true),
            array('donation_amount', 'numerical'),
            array('referral_code', 'length', 'max' => 15),
            array('trans_ref,donor_name, donor_email, donor_phone_no', 'length', 'max' => 255),
            array('status,status_new,sex', 'length', 'max' => 1),
            array('updated_date,signup_check,reward_program,referral_code,payment_mode,processed_by', 'safe'),
            array('donor_email', 'email'),
//            array('donor_phone_no', 'length','max'=>10),
            array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id,fundraiser_id, donation_amount, donor_name, donor_email, donor_phone_no, donor_message, user_id, created_date, updated_date, status,payment_mode,payment_type', 'safe', 'on' => 'search'),
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
            'donation_amount' => Yii::t('app', 'Donation Amount'),
            'donor_name' => Yii::t('app', 'Name'),
            'donor_email' => Yii::t('app', 'Email'),
            'donor_phone_no' => Yii::t('app', 'Phone number'),
            'donor_message' => Yii::t('app', 'Donor Message'),
            'user_id' => Yii::t('app', 'User'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
            'fundraiser' => null,
            'signup_check' => 'Signup me for Donor Reward Program',
            'reward_program' => 'Reward Program',
            'payment_mode' => 'Payment Mode',
            'processed_by' => 'Processed By'
        );
    }

    public function search()
    {

        $criteria = $this->makeCriteria();

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
        ));
    }

    public function getTotal(){

        $criteria = $this->makeCriteria();
        $criteria->select = "sum(donation_amount) as sum";
        $sum = $this->commandBuilder->createFindCommand($this->getTableSchema(), $criteria)->queryScalar();
        return ($sum > 0 ? $sum : 0);
    }

    public function getAverage(){

        $criteria = $this->makeCriteria();
        $criteria->select = "avg(donation_amount) as avg";
        $avg = $this->commandBuilder->createFindCommand($this->getTableSchema(), $criteria)->queryScalar();
        return ($avg > 0 ? number_format($avg,2) : 0);
    }
    

    public function makeCriteria(){

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
        $criteria->addCondition('status= \'Y\'');
        
        if(!empty($this->payment_type) && $this->payment_type !='all' ){
            $criteria->compare('payment_type', $this->payment_type, false);
        }

        if(!empty($this->payment_mode) && $this->payment_mode !='all' ){
            $criteria->compare('payment_mode', $this->payment_mode, false);
        }

        if(($this->reward_program ==1 || $this->reward_program == 0) && $this->reward_program !='all' ){
            $criteria->compare('reward_program', $this->reward_program, false);
        }
        
        //$criteria->compare('status', $this->status, true);
        
        
        return $criteria;
    }

    public function afterFind(){
        $this->processing_fee = number_format(($this->interswitch_fee + $this->giveyourbit_fee),2,'.',',');
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

    public function getPaymentTypes(){
        return array(
            'all' => 'ALL',
            'ussd' => 'USSD', 
            'card' => 'Card'
        );
    }

    public function getPaymentModes(){
        return array(
            'all' => 'ALL',
            'live' => 'live', 
            'test' => 'test'
        );
    }



    public function getUserFirstDonationInMonth($user_id = 0){

        if($user_id == 0){
            $user_id = Yii::app()->frontUser->id;
        }

        $year = date('Y');
        $month = date('F');

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

         return Donations::model()->find(array(
            'condition' => 'user_id = :user_id AND created_date BETWEEN :start_date AND :end_date', 
            'params' => array(
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'user_id' => $user_id,
            ),
            'order' => 'id ASC'
        ));
        
    }

    

    public function getUserCurrentMonthDonationsCount($user_id = 0){

        if($user_id == 0){
            $user_id = Yii::app()->frontUser->id;
        }

        $donation_count = 0;

        $year = date('Y');
        $month = date('F');

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $donation_count = Donations::model()->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date',array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
        ));
        

        return $donation_count;

    }


    public function getUserMonthlyDonationsCount($user_id,$month,$year){

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $donation_count = Donations::model()->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date',array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
        ));
        

        return $donation_count;

    }


    public function getUserCurrentMonthTotalDonation($user_id = 0){

        $user = Yii::app()->frontUser;

        if(!$user->isGuest && $user_id==0){
            $user_id = $user->getState('id');
        }

        $year = date('Y');
        $month = date('F');

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $sql = "SELECT sum(transaction_amount) from donations  WHERE user_id = $user_id AND created_date BETWEEN '".$start_date."' AND '".$end_date."';";

        $donation_sum= Yii::app()->db->createCommand($sql)->queryScalar();
		
        // if($donation_sum > 0){
        // }

        $donation_sum = number_format($donation_sum,2);

        return $donation_sum;

    }

    public function getDistinctDonors(){
        
        $criteria = new CDbCriteria;
        $criteria->select = 'DISTINCT donor_email ,donor_name,id';
        $records = $this->findAll($criteria);

        return $records;
    }


    public function getRewardInflow(){

		$total_amount  = Yii::app()->db->createCommand()
		->select('sum(dn.donation_amount) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 1')
		->queryScalar();

		return $total_amount;
		
	}


    public function getNormalInflow(){

        $total_amount  = Yii::app()->db->createCommand()
		->select('sum(dn.donation_amount) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 0')
		->queryScalar();

		return $total_amount;
    }

    public function getTotalInflow(){

        $total_amount  = Yii::app()->db->createCommand()
		->select('sum(dn.transaction_amount) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
		->queryScalar();

		return $total_amount;
    }


    public function getPlatformNormalInflow(){

        $interswitch_fee  = Yii::app()->db->createCommand()
		->select('sum(dn.interswitch_fee) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 0')
		->queryScalar();

        $giveyourbit_fee  = Yii::app()->db->createCommand()
		->select('sum(dn.giveyourbit_fee) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 0')
		->queryScalar();

        $total_amount = $interswitch_fee +$giveyourbit_fee;

		return $total_amount;
    }


    public function getPlatformRewardInflow(){

        $interswitch_fee  = Yii::app()->db->createCommand()
		->select('sum(dn.interswitch_fee) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 1')
		->queryScalar();

        $giveyourbit_fee  = Yii::app()->db->createCommand()
		->select('sum(dn.giveyourbit_fee) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 1')
		->queryScalar();

        $total_amount = $interswitch_fee +$giveyourbit_fee;

		return $total_amount;
    }

    public function getRewardInflow3Perccent(){

        $total_amount  = Yii::app()->db->createCommand()
		->select('sum(dn.transaction_amount) as total_amount')
		->from('donations as dn')
		->where('dn.status = \'Y\'')
        ->where('dn.reward_program = 1')
		->queryScalar();


        $reward_inflow = (3/100)*$total_amount;

		return $reward_inflow;
    }

    public function checkAllowDelete(){
        if($this->payment_mode =='test'){
            return 1;
        }
        return 0;
    }
}
