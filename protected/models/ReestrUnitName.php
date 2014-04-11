<?php

class ReestrUnitName extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'reestr_unit_name';
	}

    public function rules(){
        return array(
            array('name, caption',
                'length',
                'max'=>50
            ),
            array('name,caption,systemid',
                'required',
            ),
            array('caption',
                'unique'
            ),
            array('id, name, caption',
                'safe',
                'on'=>'search'
            ),
        );
    }

    public function relations(){
        return array(
            'ReestrSystemName'=>array(self::BELONGS_TO, 'ReestrSystemName', 'systemid'),                
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'name' => 'Имя шкафа',
            'caption' => 'Название шкафа',
            'systemid'=>'Система',
            'ReestrSystemName.caption'=>'Привязанная система'
        );
    }

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('caption',$this->caption,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}