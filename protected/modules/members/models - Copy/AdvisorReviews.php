<?php

/**
 * This is the model class for table "advisor_reviews".
 *
 * The followings are the available columns in table 'advisor_reviews':
 * @property integer $id
 * @property string $reference_code
 * @property string $title
 * @property string $review
 * @property string $rating
 * @property integer $user_id
 */
class AdvisorReviews extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdvisorReviews the static model class
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
		return 'advisor_reviews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,review','required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('reference_code, rating', 'length', 'max'=>100),
			array('title', 'length', 'max'=>255),
			array('review', 'safe'),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, reference_code, title, review, rating, user_id', 'safe', 'on'=>'search'),
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
			'reference_code' => 'Reference Code',
			'title' => 'Title',
			'review' => 'Review',
			'rating' => 'Rating',
			'user_id' => 'User',
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
		$criteria->compare('reference_code',$this->reference_code,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('review',$this->review,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function RatingReview()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = "review_id = '".$this->id."'";
		
		
		return $ratingReview = AdvisorReviewrating::model()->findAll($criteria);
		
	}
	
	public function RecentReview($limit = 1)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->limit = $limit;
		//$criteria->join = 'LEFT join advisor_factory_review a ON t.reference_code = a.reference_code';
		
		/*
		$criteria->compare('id',$this->id);
		$criteria->compare('reference_code',$this->reference_code,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('review',$this->review,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('user_id',$this->user_id);
		*/
		return $this->findAll($criteria);
	}
	
	public function getFactory(){
		return AdvisorFactoryReview::model()->find('reference_code = :rf',array(':rf'=>$this->reference_code));
	}
}