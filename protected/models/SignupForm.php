<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SignupForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $email;
	public $reemail;
	public $first_name;
	public $last_name;

	private $_user;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, email,first_name,reemail', 'required'),
			array('email,reemail', 'email'),
			
			array('reemail', 'compare', 'compareAttribute'=>'email'),
			// rememberMe needs to be a boolean
			// password needs to be authenticated
			array('username', 'exist'),
			array('email', 'existemail'),
			array('last_name', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'email'=>' Email',
			'reemail'=>'Re enter Email',
			'username'=>'Nick Name',
		);
	}

	public function exist($attribute,$params){
		$user = User::model()->find("username = :us",array(':us'=>$this->username));
		if ($user){
			$attr = $this->attributeLabels();
			$this->addError('username',$attr['username'].' '.' already exist');
		}
	}
	
	public function existemail($attribute,$params){
		$user = User::model()->find("email = :us",array(':us'=>$this->email));
		if ($user){
			$attr = $this->attributeLabels();
			$this->addError('email',$attr['email'].' '.' already exist');
		}
	}

	public function save()
	{	
		$this->_user = new User;
		$this->_user->attributes = $this->attributes;
		$this->_user->generatePassword($this->password);
		if ( $this->_user->save() ){
			return true;
		}
		
	}	
	
}
