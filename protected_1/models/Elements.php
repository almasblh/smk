<?php

class Elements extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName(){
        return 'elements';
    }

    public function rules(){
        return array(
            array('manufactureid', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>50),
            array('caption, p_n', 'length', 'max'=>100),
            array('referens', 'length', 'max'=>15),
            array('id, name, caption, p_n, manufactureid, referens', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'ReestrElementManufacture'=>array(self::BELONGS_TO, 'ReestrElementManufacture', 'manufactureid'),

        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'caption' => 'Caption',
            'p_n' => 'P N',
            'manufactureid' => 'Manufactureid',
            'referens' => 'Referens',
        );
    }

    public function search(){
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('caption',$this->caption,true);
        $criteria->compare('p_n',$this->p_n,true);
        $criteria->compare('manufactureid',$this->manufactureid);
        $criteria->compare('referens',$this->referens,true);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
}