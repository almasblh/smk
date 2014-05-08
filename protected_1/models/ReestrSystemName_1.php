<?php

class ReestrSystemName extends CActiveRecord{

    public static function model($className=__CLASS__){
            return parent::model($className);
    }

    public function tableName(){
            return 'reestr_system_name';
    }

    public function rules(){
        return array(
            array('name',
                'length',
                'max'=>50
            ),
            array('caption',
                'length',
                'max'=>255
            ),
            array('name,caption',
                'required',
            ),
            array('name,caption',
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
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'name' => 'Наименование',
            'caption' => 'Условное обозначение',
        );
    }

    public function search(){
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('caption',$this->caption,true);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
}