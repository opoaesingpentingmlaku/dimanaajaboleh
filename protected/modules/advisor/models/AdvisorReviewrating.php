<?php

/**
 * This is the model class for table "advisor_reviewrating".
 *
 * The followings are the available columns in table 'advisor_reviewrating':
 * @property integer $id
 * @property integer $review_id
 * @property integer $rating_id
 * @property string $value
 */
class AdvisorReviewrating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdvisorReviewrating the static model class
	 */
	public $total_rating,$num_reviews,$average_rating;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'advisor_reviewrating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('review_id, rating_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, review_id, rating_id, value', 'safe', 'on'=>'search'),
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
			'relrating'=>array(self::BELONGS_TO,'advisorrating','rating_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'review_id' => 'Review',
			'rating_id' => 'Rating',
			'value' => 'Value',
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
		$criteria->compare('review_id',$this->review_id);
		$criteria->compare('rating_id',$this->rating_id);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCalculate($reference_code){
		$criteria=new CDbCriteria;
		$criteria->select 	= 'rating_id,SUM(`value`) AS total_rating,COUNT(rating_id) AS num_reviews, AVG(`value`) AS average_rating';
		$criteria->join 	= 'LEFT JOIN '.AdvisorReviews::model()->tableName().' b ON t.review_id = b.id';
		$criteria->condition = "b.reference_code = '".$reference_code."'";
		$criteria->group 	= "t.rating_id";
		$result 			= $this->findAll($criteria);
		
		if ($result)
		foreach ( $result as $values){
			$return[$values->rating_id] = $values;
		}
		return $return;
	}
	
	public function deleteAllByReviewId($review_id){
		$criteria=new CDbCriteria;
		$criteria->condition = "review_id = '".$review_id."'";
		return $this->deleteAll($criteria);
	}
}