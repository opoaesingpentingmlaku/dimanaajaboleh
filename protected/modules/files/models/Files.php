<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $filename
 * @property string $type
 * @property string $path
 * @property string $journal_id
 * @property string $caption
 * @property string $description
 * @property integer $vreated_at

 */
class Files extends CActiveRecord
{	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, path, type, created_at, size, container', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, filename, type, size, container', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'filename' => 'Filename',
			'type' => 'Type',
			'path' => 'Path',
			'size' => 'Size',
			'journal_id' => 'Journal Id',
			'container' => 'Container',
			'caption' => 'Caption',
			'description' => 'Description'
		);
	}
}
