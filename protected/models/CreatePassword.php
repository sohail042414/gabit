<?php

class CreatePassword extends CFormModel
{

    public $password;
    public $confirm_password;

    public function rules()
    {
        return array(
            array('password,confirm_password', 'required'),
            array('password, confirm_password', 'length', 'min' => 5, 'max' => 40),
            array('password', 'compare', 'compareAttribute' => 'confirm_password'),
        );
    }


    /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'Password',
            'confirm_password' => 'Confirm Password',
		);
	}

}

