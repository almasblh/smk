<?php

class SmkProjectStepName extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'smk_project_step_name';
	}

	public function rules()
	{
		return array(
			array('name', 'length', 'max'=>50),
			array('id, name, controllerid', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
                    'SmkProjects'=>array(self::HAS_MANY, 'SmkProjects', 'stepid'),
                    'ServControllers'=>array(self::BELONGS_TO, 'ServControllers', 'controllerid'),
                );
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Наименование',
                        'controllerid'=>'Контроллер'
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}