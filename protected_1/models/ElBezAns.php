<?php

/**
 * This is the model class for table "el_bez_ans".
 *
 * The followings are the available columns in table 'el_bez_ans':
 * @property string $questid
 * @property string $nans
 * @property integer $right
 * @property string $name
 *
 * The followings are the available model relations:
 * @property ElBezQuests $quest
 */
class ElBezAns extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ElBezAns the static model class
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
		return 'el_bez_ans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('questid, nans, right, name', 'required'),
			array('right', 'numerical', 'integerOnly'=>true),
			array('questid, nans', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('questid, nans, right, name', 'safe', 'on'=>'search'),
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
			'quest' => array(self::BELONGS_TO, 'ElBezQuests', 'questid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'questid' => 'Questid',
			'nans' => 'Nans',
			'right' => 'Right',
			'name' => 'Name',
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

		$criteria->compare('questid',$this->questid,true);
		$criteria->compare('nans',$this->nans,true);
		$criteria->compare('right',$this->right);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}