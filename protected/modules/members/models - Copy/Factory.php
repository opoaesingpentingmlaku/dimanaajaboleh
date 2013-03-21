<?php

/**
 * This is the model class for table "factory".
 *
 * The followings are the available columns in table 'factory':
 * @property integer $id
 * @property string $contact_person
 * @property string $pre_contact
 * @property string $company_name
 * @property string $telp_number
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $address
 * @property string $distric
 * @property string $city
 */
class Factory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Factory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'factory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name', 'required'),
			array('contact_person, pre_contact, company_name, telp_number, mobile, fax, email, address, distric, city', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_created, contact_person, pre_contact, company_name, telp_number, mobile, fax, email, address, distric, city', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contact_person' => 'Contact Person',
			'pre_contact' => 'Pre Contact',
			'company_name' => 'Factory Name',
			'telp_number' => 'Phone',
			'mobile' => 'Mobile',
			'fax' => 'Fax',
			'email' => 'Email',
			'address' => 'Address',
			'distric' => 'Distric',
			'city' => 'City',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('pre_contact',$this->pre_contact,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('telp_number',$this->telp_number,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('distric',$this->distric,true);
		$criteria->compare('city',$this->city,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}