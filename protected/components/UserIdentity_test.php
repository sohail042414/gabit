<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_UN_AUTHENTICATED_ACCOUNT = 1;

    public function authenticate()
    {
        $model = Users::model()->find("username = :username OR email = :username", array(':username' => $this->username));
        if (!empty($model)) {
            if ($model->email_verification == 'N') {
                $this->errorCode = self::ERROR_UN_AUTHENTICATED_ACCOUNT;
            } else if ($model->status == 'Y') {
                if ($model->password != md5($this->password)) {
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                } else {
                    Yii::app()->frontUser->setState('id', $model->id);
                    Yii::app()->frontUser->setState('username', $model->username);
                    Yii::app()->frontUser->setState('email', $model->email);
                    Yii::app()->frontUser->setState('first_name', $model->first_name);
                    Yii::app()->frontUser->setState('last_name', $model->last_name);
                    Yii::app()->frontUser->setState('created_date', $model->created_date);
                    Yii::app()->frontUser->setState('role', $model->userType->user_role);
                    Yii::app()->frontUser->setState('roleID', $model->user_type);
                    $this->errorCode = self::ERROR_NONE;
                    return true;
                }
            } else {
                $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
            }
        } else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        return false;
    }

//    public function getId()
//    {
//        return $this->_id;
//    }
//
//    public function getName()
//    {
//        return $this->_name;
//    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
//	public function authenticate()
//	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);
//		if(!isset($users[$this->username]))
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
//		elseif($users[$this->username]!==$this->password)
//			$this->errorCode=self::ERROR_PASSWORD_INVALID;
//		else
//			$this->errorCode=self::ERROR_NONE;
//		return !$this->errorCode;
//	}
}