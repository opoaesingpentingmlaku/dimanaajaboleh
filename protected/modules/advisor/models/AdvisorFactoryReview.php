<?php

/**
 * This is the model class for table "advisor_factory_review".
 *
 * The followings are the available columns in table 'advisor_factory_review':
 * @property integer $id
 * @property integer $factory_id
 * @property string $reference_code
 */
class AdvisorFactoryReview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdvisorFactoryReview the static model class
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
		return 'advisor_factory_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('factory_id', 'numerical', 'integerOnly'=>true),
			array('reference_code', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, factory_id, detil_rating,reference_code', 'safe', 'on'=>'search'),
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
			'relfactory'=>array(self::BELONGS_TO,'Factory','factory_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'factory_id' => 'Factory',
			'reference_code' => 'Reference Code',
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
		$criteria->compare('factory_id',$this->factory_id);
		$criteria->compare('reference_code',$this->reference_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function averageRating(){
		$val = 0;
		$total = 0;
		$dtRat = json_decode($this->detil_rating,true);
		$average = 0;
		if ( $dtRat ) { 
			foreach ( $dtRat as $ratingId=>$ratingValue){
				$val += ($ratingId * $ratingValue);
				$total += $ratingValue;
			}	
			$average = round( $val / $total);
		}
		
		
		return $average;
	}
	
	public function bestRating(){
		$criteria = new CDbCriteria;
		$criteria->order = 'num_reviews desc, average_value desc';
		$criteria->limit = 1;
		$best = $this->find($criteria);
		return $best;
	}
	
	public function detilRating($rating = ''){
		$ratings = json_decode($this->detil_rating,true);
		return (empty($rating) ? $ratings : (empty($ratings->$rating) ? 0 : $ratings->$rating));
	}
	
}