<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

    private $_identity;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
            'username' => Yii::t('app', 'Email'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate()){
                if ($this->_identity->errorCode == UserIdentity::ERROR_UNKNOWN_IDENTITY) {
                    $this->addError("password", "Your account is inactive, please try again later.!");
                }
                if ($this->_identity->errorCode == UserIdentity::ERROR_UN_AUTHENTICATED_ACCOUNT) {
                    $this->addError("password", "Your account is not activate, please try again later.!");
                } else {
                    $this->addError('password','Incorrect username or password.');
                }

            }
		}
	}

    public function login()
    {
        $login_model = new UserIdentity($this->username, $this->password);
        if ($login_model->authenticate()) {
            if ($login_model->errorCode === UserIdentity::ERROR_NONE) {
                $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
                Yii::app()->frontUser->login($login_model, $duration);
                
                $curr_datetime = date("Y-m-d H:i:s");
                $curr_user_id = Yii::app()->frontUser->id;
                
                $user = Yii::app()->db->createCommand()
                        ->update('users', array(
                            'last_login_date' => $curr_datetime,
                        ), 'id=:id', array(':id'=>$curr_user_id));
                /*
                $counter_total = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('visiters')
                        ->where()
                        ->queryAll();
                
                $counter_plus = $counter_total[0]['counter'] + 1;
                */

                $counter_total = Yii::app()->db->createCommand()
                ->select('count(*) as total')
                ->from('visiters')
                ->queryScalar();
                
                $counter_plus = $counter_total + 1;
                
                $visiters = Yii::app()->db->createCommand()
                        ->update('visiters', array(
                            'counter' => $counter_plus,
                        ), 'id=:id', array(':id'=>'1'));
                
                return true;
            }
        } else {
            
            if ($login_model->errorCode == UserIdentity::ERROR_INACTIVE_ACCOUNT) {
                Yii::app()->user->setFlash('error', Yii::t("messages", "Your account is inactive, please try again later.!"));
            }
            if ($login_model->errorCode == UserIdentity::ERROR_UN_AUTHENTICATED_ACCOUNT) {
                Yii::app()->user->setFlash('error', Yii::t("messages", "Your account is not activate, please try again later.!"));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("messages", "Invalid username or password, please try again later.!"));
            }
        }
        return false;
    }



	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
//	public function login()
//	{
//		if($this->_identity===null)
//		{
//			$this->_identity=new UserIdentity($this->username,$this->password);
//			$this->_identity->authenticate();
//		}
//		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
//		{
//			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
//			Yii::app()->user->login($this->_identity,$duration);
//			return true;
//		}
//		else
//			return false;
//	}
}
