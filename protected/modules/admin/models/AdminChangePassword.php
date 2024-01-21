<?php

class AdminChangePassword extends CFormModel
{
    public $current_password;
    public $new_password;
    public $repeat_password;

    public function rules()
    {
        return array(
            array('current_password,new_password,repeat_password', 'required'),

            array('new_password, repeat_password', 'required', 'on' => 'insert'),
            array('new_password, repeat_password', 'length', 'min' => 5, 'max' => 40),
            array('repeat_password', 'compare', 'compareAttribute' => 'new_password'),
        );
    }
}

