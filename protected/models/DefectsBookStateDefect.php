<?php

class DefectsBookStateDefect extends CActiveRecord{
    
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'defects_book_state_defect';
    }

    public function rules(){
        return array(
          //  array('defectid, state, comment, date, signatureuserid', 'required'),
          //  array('defectid, signatureuserid, tocategoryid, tocategoryid, touserid', 'length', 'max'=>11),
          //  array('state', 'length', 'max'=>1),

            array('id, defectid, state, comment, date, signatureuserid, tocategoryid, touserid', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'SignatureUser'=>array(self::BELONGS_TO,'ServUsers','signatureuserid'),
            'ToUser'=>array(self::BELONGS_TO,'ServUsers','touserid'),
            'ToCategory'=>array(self::BELONGS_TO,'ServUsersCategory','tocategoryid'),
            'DefectsBook'=>array(self::BELONGS_TO,'DefectsBook','defectidid'),
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'defectid' => 'Номер дефекта',
            'state' => 'Состояние дефекта',
            'comment' => 'Соментарии',
            'date' => 'Дата записи',
            'signatureuserid' => 'Подпись',
            'tocategoryid' => 'кому(категория)',
            'touserid' => 'кому(конкретно)',
        );
    }

    public function search($defectid){
        $criteria=new CDbCriteria;

        //$criteria->compare('id',$this->id,true);
        $criteria->compare('defectid',$defectid);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('signatureuserid',$this->signatureuserid,true);
        $criteria->compare('tocategoryid',$this->tocategoryid,true);
        $criteria->compare('touserid',$this->touserid,true);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
}