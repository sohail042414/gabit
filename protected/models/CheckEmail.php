<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CheckEmail extends CFormModel
{
    public $email;
    public $fundraiser;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
       
        return array(
            
            array('email,fundraiser', 'required'),
            array('email', 'email'),
            //array('contact_numbers', 'numerical', 'integerOnly' => true),
            
        );
    } 

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Email ID',
            'fundraiser'=>'Select Fundraiser',
        );
    }

   
}
