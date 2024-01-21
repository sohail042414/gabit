<?php

Yii::import('application.models._base.BaseUsers');

class Users extends BaseUsers
{
    public $confirm_password;
    public $agree_to_terms;
    public $fundraiser_id;
    //public $user_image;
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'User|Users', $n);
    }

    public static function representingColumn()
    {
        return 'username';
    }
    public function relations() {
        return array(
            'meetings' => array(self::HAS_MANY, 'Meeting', 'user_id'),
            'userType' => array(self::BELONGS_TO, 'UserRoles', 'user_type'),
            'group' => array(self::BELONGS_TO, 'Groups', 'group_id'),
            'rewardPoints' => array(self::HAS_MANY, 'RewardPoints', 'user_id'),
            'socialShares' => array(self::HAS_MANY, 'UserSocialShare', 'user_id'),
        );
    }

    public function rules()
    {
        if (Yii::app()->controller->action->id == 'signup') {

            return array(
                array('username, email, age, sex,phone', 'required'),
                array('user_type,referrer_id,comment_count,comment_count_other', 'numerical', 'integerOnly' => true),
                array('first_name, last_name', 'length', 'max' => 150),
                array('phone', 'length', 'max' => 16),
                array('username, email', 'length', 'max' => 250),
                array('password', 'length', 'max' => 32),
                array('referral_code', 'length', 'max' => 12),              
                array('sex, status', 'length', 'max' => 1),
                array('email', 'email'),
                array('email', 'unique', 'className' => 'Users', 'attributeName' => 'email', 'message'=>'This Email is already in use'),
                array('age','numerical','integerOnly' => true ,'message' => 'Please enter valid age.'),
                array('age', 'length', 'max' => 3,),
                array('age', 'compare', 'compareValue' => 18, 'operator' => '>='),
                array('password, confirm_password', 'required', 'on' => 'insert'),
                array('password, confirm_password', 'length', 'min' => 5, 'max' => 40),
                array('confirm_password', 'compare', 'on' => 'insert', 'compareAttribute' => 'password'),
                array('agree_to_terms', 'required', 'message' => 'Please you must select terms of service'),

                array('status', 'length', 'max' => 1),
                array('updated_date,fb_access_token,fb_payload,role,referral_code,referrer_id', 'safe'),
                array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
                array('id, user_type, first_name, last_name, username, email, age, sex, password, created_date, updated_date, status', 'safe', 'on' => 'search'),
            );

        }else{

            return array(
                array('username, email,age,sex,phone', 'required'),
                array('user_type,age,group_id,referrer_id,comment_count,comment_count_other', 'numerical', 'integerOnly' => true),
                array('first_name, last_name', 'length', 'max' => 150),
                array('username, email', 'length', 'max' => 250),
                array('password', 'length', 'max' => 32),
                array('phone', 'length', 'max' => 16),
                array('sex, status', 'length', 'max' => 1),
                array('referral_code', 'length', 'max' => 12),
                array('age', 'length', 'max' => 3),
                array('email', 'unique'),
                array('email', 'email','message' => 'Please enter valid email address'),
                array('age', 'compare', 'compareValue' => 18, 'operator' => '>='),
                array('password, confirm_password', 'length', 'min' => 5, 'max' => 40),
                array('confirm_password', 'compare', 'on'=>array('insert','update'), 'compareAttribute' => 'password'),

                array('agree_to_terms', 'required', 'message' => 'Please you must select terms of service'),

                array('status', 'length', 'max' => 1),
                array('updated_date,role,referral_code,referrer_id', 'safe'),
                array('updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
                array('id, user_type, first_name, last_name, username, email,age, sex,password, created_date, updated_date, status', 'safe', 'on' => 'search'),


            );
        }

    }

    public function attributeLabels()
    {
        if (Yii::app()->controller->action->id == 'signup') {
            return array(
                'id' => Yii::t('app', 'ID'),
                'user_type' => null,
                'first_name' => Yii::t('app', 'First Name'),
                'last_name' => Yii::t('app', 'Last Name'),
                'username' => Yii::t('app', 'Full Name'),
                'email' => Yii::t('app', 'Email'),
                'age' => Yii::t('app', 'Age'),
                'sex' => Yii::t('app', 'Sex'),
                'password' => Yii::t('app', 'Password'),
                'confirm_password'=> Yii::t('app', 'confirm password'),
                'created_date' => Yii::t('app', 'Created Date'),
                'updated_date' => Yii::t('app', 'Updated Date'),
                'status' => Yii::t('app', 'Status'),
                'status_new' => Yii::t('app', 'status_new'),
                'meetings' => null,
                'userType' => null,
                'role' => 'Role',
                'referral_code' => 'Referral Code',
                'referrer_id' => 'Referrer',
                'comment_count' => 'Comments Count',
                'comment_count_other' => 'Comments Count Others',
                'phone' => 'Phone',
            );
        }else{
            return array(
                'id' => Yii::t('app', 'ID'),
                'user_type' => null,
                'first_name' => Yii::t('app', 'First Name'),
                'last_name' => Yii::t('app', 'Last Name'),
                'username' => Yii::t('app', 'Full Name'),
                'email' => Yii::t('app', 'Email'),
                'age' => Yii::t('app', 'Age'),
                'sex' => Yii::t('app', 'Sex'),
                'user_image' => Yii::t('app', 'Image'), 
                'password' => Yii::t('app', 'Password'),
                'created_date' => Yii::t('app', 'Created Date'),
                'updated_date' => Yii::t('app', 'Updated Date'),
                'status' => Yii::t('app', 'Status'),
                'status_new' => Yii::t('app', 'status_new'),
                'meetings' => null,
                'userType' => null,
                'role' => 'Role',
                'referral_code' => 'Referral Code',
                'referrer_id' => 'Referrer',
                'comment_count' => 'Comments Count',
                'comment_count_other' => 'Comments Count Others',
                'phone' => 'Phone'
            );
        }
    }


    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('role', $this->role);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('age', $this->age, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('updated_date', $this->updated_date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('status_new', $this->status_new, true);

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
    
    public function createReferralCode(){
        return 'GYB-'.$this->id;            
    }

    public function checkReferralCode(){

        $this->referral_code = $this->createReferralCode();
        $this->update(false);

        // if(empty($this->referral_code)){
        //     $this->referral_code = $this->createReferralCode();
        //     $this->update(false);
        // }

    }

    public function getReferralCount(){
        $user_count =  $this->count('referrer_id = :referrer_id',array('referrer_id' => $this->id));
        $donation_count = Donations::model()->count('referral_code = :referral_code',array('referral_code' => $this->referral_code));

        return $user_count + $donation_count;
    }

    public function findByReferralCode($referral_code){
        return $this->find("referral_code =:referral_code",array('referral_code' => $referral_code));
    }

    public function getImage(){        
        $img =  '<img class="preview_image" src="' . SITE_ABS_PATH_USER_IMAGE_THUMB . $this->user_image. '" alt="" />';
        return $img;
    }

    public function getPhone(){
        $donation = Donations::model()->find(array('condition'=> 'user_id = :user_id OR donor_email= :donor_email', 
            'params' => array(
                'user_id' => $this->id,
                'donor_email' => $this->email
            ),
            'order' => 'id DESC'
        ));

        if(is_object($donation)){
            return $donation->donor_phone_no;
        }

        return NULL;
    }

    public function getTotalSocialSharesCount(){

        $month = strtolower(date('F'));
        $year = date('Y');

        $record = UserSocialShare::model()->find('user_id = :user_id AND month=:month AND year=:year',array(
            'user_id' => $this->id,
            'month' => $month,
            'year' => $year
        ));

        if(is_object($record)){
            return $record->total_shares;
        }

        return 0;
    }


    public function getTotalInvitesSent(){

        $count = ReportInvitefriends::model()->count('sender_id = :sender_id',array(
            'sender_id' => $this->id
        ));
        
        return $count;
    }


    public function getUserDonationCount($user_id = 0){

        if($user_id == 0){
            $user_id = $this->id;
        }

        $donation_count = Donations::model()->count('user_id = :user_id',array(
            'user_id' => $user_id,
        ));
        
        return $donation_count;
    }

}