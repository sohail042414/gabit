<?php
/**
 * EAuthUserIdentity class file.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * EAuthUserIdentity is a base User Identity class to authenticate with EAuth.
 *
 * @package application.extensions.eauth
 */
class EAuthUserIdentity extends CBaseUserIdentity {

	const ERROR_NOT_AUTHENTICATED = 3;

	/**
	 * @var EAuthServiceBase the authorization service instance.
	 */
	protected $service;

	/**
	 * @var string the unique identifier for the identity.
	 */
	protected $id;
	protected $email;

	/**
	 * @var string the display name for the identity.
	 */
	protected $name;

	/**
	 * Constructor.
	 *
	 * @param EAuthServiceBase $service the authorization service instance.
	 */
	public function __construct($service) {
		$this->service = $service;
	}

	/**
	 * Authenticates a user based on {@link service}.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		if ($this->service->isAuthenticated) {
			$this->id = $this->service->id;
			$this->name = $this->service->getAttribute('name');
			$this->email = $this->service->getAttribute('email');

            $exist_user = Users::model()->find(array('select'=>'*','condition'=>'email = "'.$this->email.'" AND username = "'.$this->name.'" '));
            if(empty($exist_user)){
                $exist_user = new Users();
                $exist_user->username = $this->name;
                $exist_user->user_type = '2';
                $exist_user->email = $this->email;
                $exist_user->user_fb = 'Y';
                $exist_user->save(false);
            }
            Yii::app()->frontUser->setState('id', $exist_user->id);
            Yii::app()->frontUser->setState('name', $this->name);
            Yii::app()->frontUser->setState('service', $this->service->serviceName);
            Yii::app()->frontUser->setState('roleID', '2');
			// You can save all given attributes in session.
			//$attributes = $this->service->getAttributes();
			//$session = Yii::app()->session;
			//$session['eauth_attributes'][$this->service->serviceName] = $attributes;

			$this->errorCode = self::ERROR_NONE;
		}
		else {
			$this->errorCode = self::ERROR_NOT_AUTHENTICATED;
		}
		return !$this->errorCode;
	}

	/**
	 * Returns the unique identifier for the identity.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return string the unique identifier for the identity.
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the display name for the identity.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return string the display name for the identity.
	 */
	public function getName() {
		return $this->name;
	}
}
