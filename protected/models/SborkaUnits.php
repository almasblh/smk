<?php

/**
 * This is the model class for table "sborka_units".
 *
 * The followings are the available columns in table 'sborka_units':
 * @property string $id
 * @property string $kdcolectionid
 * @property string $refdesid
 * @property string $partnom
 * @property string $sernum
 * @property string $operationid
 * @property string $datecreate
 * @property string $signaturecreator
 */
class SborkaUnits extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SborkaUnits the static model class
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
		return 'sborka_units';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kdcolectionid, refdesid, operationid, signaturecreator', 'length', 'max'=>10),
			array('partnom', 'length', 'max'=>1),
			array('sernum', 'length', 'max'=>20),
			array('datecreate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, kdcolectionid, refdesid, partnom, sernum, operationid, datecreate, signaturecreator', 'safe', 'on'=>'search'),
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
			'kdcolectionid' => 'Kdcolectionid',
			'refdesid' => 'Refdesid',
			'partnom' => 'Partnom',
			'sernum' => 'Sernum',
			'operationid' => 'Operationid',
			'datecreate' => 'Datecreate',
			'signaturecreator' => 'Signaturecreator',
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
		$criteria->compare('kdcolectionid',$this->kdcolectionid,true);
		$criteria->compare('refdesid',$this->refdesid,true);
		$criteria->compare('partnom',$this->partnom,true);
		$criteria->compare('sernum',$this->sernum,true);
		$criteria->compare('operationid',$this->operationid,true);
		$criteria->compare('datecreate',$this->datecreate,true);
		$criteria->compare('signaturecreator',$this->signaturecreator,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}