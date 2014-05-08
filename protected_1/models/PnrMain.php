<?php

class PnrMain extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'pnr_main';
	}

	public function rules()
	{
		return array(
			array('ready', 'numerical'),
			array('projectid, shkafid, skafn1, skafn2, skafn3, typeid, arm_visible_all, connection_all, kabel_all, low_device_all', 'length', 'max'=>10),
			array('klemma', 'length', 'max'=>60),
			array('name', 'length', 'max'=>255),
			array('typename', 'length', 'max'=>100),

			array('id, projectid, shkafid, skafn1, skafn2, skafn3, klemma, name, typeid, typename, arm_visible_all, connection_all, kabel_all, low_device_all, ready', 'safe', 'on'=>'search'),
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
			'projectid' => 'Проект',
			'shkafid' => 'Shkafid',
			'skafn1' => 'Skafn1',
			'skafn2' => 'Skafn2',
			'skafn3' => 'Skafn3',
			'klemma' => 'Klemma',
			'name' => 'Name',
			'typeid' => 'Typeid',
			'typename' => 'Typename',
			'arm_visible_all' => 'Arm Visible All',
			'connection_all' => 'Connection All',
			'kabel_all' => 'Kabel All',
			'low_device_all' => 'Low Device All',
			'ready' => 'Ready',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id,true);
		$criteria->compare('projectid',$this->projectid,true);
		$criteria->compare('shkafid',$this->shkafid,true);
		$criteria->compare('skafn1',$this->skafn1,true);
		$criteria->compare('skafn2',$this->skafn2,true);
		$criteria->compare('skafn3',$this->skafn3,true);
		$criteria->compare('klemma',$this->klemma,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('typeid',$this->typeid,true);
		$criteria->compare('typename',$this->typename,true);
		$criteria->compare('arm_visible_all',$this->arm_visible_all,true);
		$criteria->compare('connection_all',$this->connection_all,true);
		$criteria->compare('kabel_all',$this->kabel_all,true);
		$criteria->compare('low_device_all',$this->low_device_all,true);
		$criteria->compare('ready',$this->ready);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}