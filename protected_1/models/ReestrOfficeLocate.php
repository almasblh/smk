<?php
class ReestrOfficeLocate extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'reestr_offises_locate';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>100),
			array('caption', 'length', 'max'=>100),
			array('id, name, caption', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'caption' => 'Caption',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('caption',$this->conductors,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}