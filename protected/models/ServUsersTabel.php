<?php

/**
 * This is the model class for table "serv_users_tabel".
 *
 * The followings are the available columns in table 'serv_users_tabel':
 * @property integer $id
 * @property string $userid
 * @property string $date
 * @property string $timestart
 * @property string $timestop
 * @property string $nexttimeremamber
 * @property integer $year
 * @property integer $month
 *
 * The followings are the available model relations:
 * @property ServUsers $user
 */
class ServUsersTabel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServUsersTabel the static model class
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
		return 'serv_users_tabel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, year, month', 'numerical', 'integerOnly'=>true),
			array('userid', 'length', 'max'=>10),
			array('date, timestart, timestop, nexttimeremamber', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, date, timestart, timestop, nexttimeremamber, year, month', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'ServUsers', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userid' => 'Userid',
			'date' => 'Date',
			'timestart' => 'Timestart',
			'timestop' => 'Timestop',
			'nexttimeremamber' => 'Nexttimeremamber',
			'year' => 'Year',
			'month' => 'Month',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($userid=0,$date=0)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
                if($userid>0)
                    $criteria->compare('userid',$this->userid,true);
                else
                    $criteria->compare('userid',$userid,true);
                if($date>0)
                    $criteria->compare('date',$date,true);
                else
                    $criteria->compare('date',$this->date,true);
		$criteria->compare('timestart',$this->timestart,true);
		$criteria->compare('timestop',$this->timestop,true);
		$criteria->compare('nexttimeremamber',$this->nexttimeremamber,true);
		$criteria->compare('year',$year);
		$criteria->compare('month',$month);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}