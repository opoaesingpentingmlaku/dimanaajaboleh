<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ResetPasswordForm extends CFormModel
{

	public $password;
	public $repassword;
	public $email;

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
			array('password, repassword,email', 'required'),
			array('repassword', 'compare', 'compareAttribute'=>'password'),
			// rememberMe needs to be a boolean
			// password needs to be authenticated
			//array('username', 'exist'),
			//array('email', 'existemail'),
			//array('last_name', 'safe'),
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

	public function save()
	{	
		$this->_user = User::model()->find("email ='".$this->email."'");
		//$this->_user->attributes = $this->attributes;
		$this->_user->generatePassword($this->password);
		if ( $this->_user->save() ){
			return true;
		}
		
	}	
	
}
