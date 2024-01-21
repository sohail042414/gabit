<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class InviteFriendForm extends CFormModel
{
    public $email;
    //public $sender_name;
    public $contact_numbers;
    public $type;
    public $fundraiser_name;
    public $greeting;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        //p($_REQUEST);die;
        if ($_REQUEST['type'] == 'email') {
            return array(
                array('email,fundraiser_name,greeting', 'required'),
                array('greeting', 'length', 'max'=>50),
            );
        } else {
            return array(
                array('contact_numbers,fundraiser_name,greeting', 'required'),
                array('greeting', 'length', 'max'=>50),
            );
        }
    }


    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Email ID',
            'fundraiser_name' => 'Select Fundraiser',
            'contact_numbers' => Yii::t('app', 'Contact No.'),
            'greeting' => 'Personal Greeting'
        );
    }
}
