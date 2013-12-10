<?php

/**
 * This is the model class for table "tbl_reader".
 *
 * The followings are the available columns in table 'tbl_reader':
 * @property integer $reader_id
 * @property string $uuid
 * @property integer $area_id
 * @property integer $positionX
 * @property integer $positionY
 *
 * The followings are the available model relations:
 * @property Area $area
 * @property TagOccurence[] $tagOccurences
 */
class Reader extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_reader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uuid, area_id, positionX, positionY', 'required'),
			array('area_id, positionX, positionY', 'numerical', 'integerOnly'=>true),
			array('uuid', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('reader_id, uuid, area_id, positionX, positionY', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO, 'Area', 'area_id'),
			'tagOccurences' => array(self::HAS_MANY, 'TagOccurence', 'reader_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reader_id' => 'Reader',
			'uuid' => 'Uuid',
			'area_id' => 'Area',
			'positionX' => 'Position X',
			'positionY' => 'Position Y',
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

		$criteria->compare('reader_id',$this->reader_id);
		$criteria->compare('uuid',$this->uuid,true);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('positionX',$this->positionX);
		$criteria->compare('positionY',$this->positionY);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reader the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
