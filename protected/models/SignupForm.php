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
	public $fullname;
	public $created_at;
	public $birthdate;
	public $company;
	public $location;

	private $_user;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	
	public function __construct(){
		parent::__construct();
		Yii::import('application.modules.members.models.Users');
	}
	
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, email,fullname,reemail, birthdate', 'required'),
			array('email,reemail', 'email'),
			
			array('reemail', 'compare', 'compareAttribute'=>'email'),
			// rememberMe needs to be a boolean
			// password needs to be authenticated
			array('username', 'exist'),
			array('email', 'existemail'),
			array('company, location, created_at', 'safe')
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
			'birthdate' => 'Birth Date'
		);
	}

	public function exist($attribute,$params){
		$user = Users::model()->find("username = :us",array(':us'=>$this->username));
		if ($user){
			$attr = $this->attributeLabels();
			$this->addError('username',$attr['username'].' '.' already exist');
		}
	}
	
	public function existemail($attribute,$params){
		$user = Users::model()->find("email = :us",array(':us'=>$this->email));
		if ($user){
			$attr = $this->attributeLabels();
			$this->addError('email',$attr['email'].' '.' already exist');
		}
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