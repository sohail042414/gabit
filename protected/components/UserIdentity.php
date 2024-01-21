<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_UN_AUTHENTICATED_ACCOUNT = 1;
    const ERROR_USERNAME_INVALID=1;
	const ERROR_PASSWORD_INVALID=2;
	const ERROR_UNKNOWN_IDENTITY=100;
    const ERROR_INACTIVE_ACCOUNT=3;

    public function authenticate()
    {

        $model = Users::model()->find("username = :username OR email = :username", array(':username' => $this->username));

        if(!is_object($model)){           
            Yii::app()->user->setFlash('error', Yii::t("messages", "Invalid username or password, please try again later.!"));
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }


        if ($model->status != 'Y') {
            Yii::app()->user->setFlash('error', Yii::t("messages", "Your account is not active, please try again later.!"));
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
            return false;
        }
            
        if (trim($model->email_verification) != 'Y') {
            Yii::app()->user->setFlash('error', Yii::t("messages", "Your account is not active, please try again later.!"));
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
            return false;
        }

        if ($model->password != md5($this->password)) {
            //echo 'here1';
            Yii::app()->user->setFlash('error', Yii::t("messages", "Invalid username or password, please try again later.!"));
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        } 

        Yii::app()->frontUser->setState('id', $model->id);
        Yii::app()->frontUser->setState('username', $model->username);
        Yii::app()->frontUser->setState('email', $model->email);
        Yii::app()->frontUser->setState('first_name', $model->first_name);
        Yii::app()->frontUser->setState('last_name', $model->last_name);
        Yii::app()->frontUser->setState('created_date', $model->created_date);
        Yii::app()->frontUser->setState('role', $model->role);
        //Yii::app()->frontUser->setState('roleID', $model->user_type);
        Yii::app()->frontUser->setState('front_name', !empty($model->first_name) ? $model->first_name : $model->username);
        //Yii::app()->frontUser->setState('mobi_type', $model->user_type);
        //Yii::app()->frontUser->setState('user_type', $model->user_type);
        $this->errorCode = self::ERROR_NONE;
        return true;
    }


    public function directLogin($ask_password=false)
    {

        $model = Users::model()->find("username = :username OR email = :username", array(':username' => $this->username));

        if(!is_object($model)){           
            Yii::app()->user->setFlash('error', Yii::t("messages", "Invalid username or password, please try again later.!"));
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }

        Yii::app()->frontUser->setState('id', $model->id);
        Yii::app()->frontUser->setState('username', $model->username);
        Yii::app()->frontUser->setState('email', $model->email);
        Yii::app()->frontUser->setState('first_name', $model->first_name);
        Yii::app()->frontUser->setState('last_name', $model->last_name);
        Yii::app()->frontUser->setState('role', $model->role);
        Yii::app()->frontUser->setState('front_name', !empty($model->first_name) ? $model->first_name : $model->username);
        if($ask_password){
            Yii::app()->frontUser->setState('ask_password', 'Y');
        }

        $this->errorCode = self::ERROR_NONE;
        return true;
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

	public function authenticate_old()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}