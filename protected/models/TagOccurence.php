<?php

/**
 * This is the model class for table "tbl_tag_occurence".
 *
 * The followings are the available columns in table 'tbl_tag_occurence':
 * @property integer $tag_occurence_id
 * @property integer $oid
 * @property integer $strength
 * @property integer $seenTick
 * @property integer $reader_id
 *
 * The followings are the available model relations:
 * @property Reader $reader
 */
class TagOccurence extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_tag_occurence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oid, strength, seenTick, reader_id', 'required'),
			array('oid, strength, seenTick, reader_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tag_occurence_id, oid, strength, seenTick, reader_id', 'safe', 'on'=>'search'),
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
			'reader' => array(self::BELONGS_TO, 'Reader', 'reader_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tag_occurence_id' => 'Tag Occurence',
			'oid' => 'Oid',
			'strength' => 'Strength',
			'seenTick' => 'Seen Tick',
			'reader_id' => 'Reader',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('tag_occurence_id',$this->tag_occurence_id);
		$criteria->compare('oid',$this->oid);
		$criteria->compare('strength',$this->strength);
		$criteria->compare('seenTick',$this->seenTick);
		$criteria->compare('reader_id',$this->reader_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TagOccurence the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
