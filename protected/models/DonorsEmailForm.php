<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class DonorsEmailForm extends CFormModel
{

	//public $status = false;
	public $user_id;
	public $to_all = false;
    public $to_active = false;
    public $to_inactive = false;
	public $subject = '';
	public $message = '';

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('subject,message','required'),
			//array('status','safe'),
			array('user_id,to_all,to_active,to_inactive', 'validateEmailForm'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user_id'=>'User',
            'to_all' => 'To All Donors',
            'to_active' => 'To Active Users',
            'to_inactive' => 'To Inactive Users'
		);
	}


    public function validateEmailForm($attribute, $params)
    { 
        if(empty($this->user_id) && $this->to_all == false && $this->to_active == false && $this->to_inactive == false){
            $this->addError('user_id', "Please Select a User , or check one the options , To All, To Active Users, To Inactive Users"); 
        }          
    }  




}
