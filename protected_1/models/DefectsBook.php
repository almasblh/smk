<?php
class DefectsBook extends CAssaRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName(){
        return 'defects_book';
    }

    public function rules(){
        return array(
            array('describe', 'required'),
            array('touserid', 'numerical', 'integerOnly'=>true),
            array('projectid, mnemoid, unitid, priority, defectvedomostid', 'length', 'max'=>11),
            array('describe', 'length', 'max'=>255),
            array('autorid, laststate', 'length', 'max'=>10),
            array('createdate', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, projectid, describe, mnemoid, unitid, priority, defectvedomostid, autorid, laststate, createdate, touserid', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'unit' => array(self::BELONGS_TO, 'ReestrUnitName', 'unitid'),
            'mnemo' => array(self::BELONGS_TO, 'ReestrMnemoName', 'mnemoid'),
            'defectsBookStateDefects' => array(self::HAS_MANY, 'DefectsBookStateDefect', 'defectid'),
            'project' => array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'projectid' => 'Projectid',
            'describe' => 'Описание дефекта',
            'mnemoid' => 'Мнемосхема',
            'unitid' => 'Шкаф',
            'priority' => 'Важность',
            'defectvedomostid' => 'Рекл.№',
            'autorid' => 'Автор',
            'laststate' => 'Текущий статус',
            'createdate' => 'Дата создания',
            'touserid' => 'Кому направлено',
        );
    }

    public function search($projectid){
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('projectid',$projectid);
        $criteria->compare('describe',$this->describe,true);
        $criteria->compare('mnemoid',$this->mnemoid,false);
        $criteria->compare('unitid',$this->unitid,true);
        $criteria->compare('priority',$this->priority,true);
        $criteria->compare('defectvedomostid',$this->defectvedomostid,true);
        $criteria->compare('autorid',$this->autorid);
        $criteria->compare('laststate',$this->laststate,true);
        $criteria->compare('createdate',$this->createdate,true);
        $criteria->compare('touserid',$this->touserid);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
    
    public function getRowHtmlOptions($row, $data, $grid){
        switch($data->laststate){
            case 0:
                $R=0;$G=255;$B=0;
                break;
            case 1:
                $R=255;$G=200;$B=200;
                break;
            case 2:
                $R=255;$G=255;$B=128;
                break;
            case 3:
                $R=0;$G=255;$B=255;
                break;
            case 4:
                $R=255;$G=0;$B=0;
                break;
        }
        $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
        $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
        $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
        $value=array('style'=>'background-color:'."#$R$G$B");
        return $value;
    }
}