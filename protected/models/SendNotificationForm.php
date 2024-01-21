<?php

class SendNotificationForm extends CFormModel
{
    public $name;
    public $email;
    public $message;
    public $subject;
    public $is_checked;
    public function rules()
    {
        return array(
            array('message,subject', 'required'),
            array('email', 'email'),
        );
    }
    
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Message'),
            'subject' => Yii::t('app', 'Subject'),
            
        );
    }
}
