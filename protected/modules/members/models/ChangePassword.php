<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePassword extends CFormModel
{
	public $oldpassword;
	public $newpassword;
	public $renewpassword;

	private $_user;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	
	public function __construct(){
		parent::__construct();
	}
	
	public function rules()
	{
		return array(
			// username and password are required
			array('oldpassword, newpassword, renewpassword', 'required'),
			array('renewpassword', 'compare', 'compareAttribute'=>'newpassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldpassword'=>'Old Password',
			'newpassword'=>'New Password',
			'renewpassword'=>'Re-Enter New Password',
		);
	}

	public function save()
	{	
		$this->_user = new Users;
		$this->_user->attributes = $this->attributes;
		$this->_user->generatePassword($this->password);
		if ( $this->_user->save() ){
			return true;
		}
		
	}
	
}