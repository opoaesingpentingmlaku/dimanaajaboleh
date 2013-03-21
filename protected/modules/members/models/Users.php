<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fullname
 * @property string $createtime
 * @property string $lastvisit
 * @property integer $status
 * @property string $kesatuanId

 */
class Userss extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
	 */
        public $newpassword;
	public $repeatnewpassword;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, createtime, kesatuanId', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, email', 'length', 'max'=>128),
			array('fullname', 'length', 'max'=>50),
			array('kesatuanId', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, fullname, createtime, lastvisit, status, kesatuanId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function setPassword($password)
	{
		$salt = $this->generateSalt();
		$this->password = $this->hashPassword($password,$salt);
		$this->salt = $salt;
		
	}
        public function validatePassword($password)
	{
		//return $this->hashPassword($password,$this->salt)===$this->password;
		return $password===$this->password;
	}
        public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}
        public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'userkesatuan' => array(self::BELONGS_TO, 'Kesatuan', 'kesatuanId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'fullname' => 'Fullname',
			'createtime' => 'Createtime',
			'lastvisit' => 'Lastvisit',
			'status' => 'Status',
			'kesatuanId' => 'Kesatuan',
			'level'=>'Level',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('lastvisit',$this->lastvisit,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('kesatuanId',$this->kesatuanId,true);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	
                
        }
        
        
}
