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
            array('describe, linkrd, where, attachepath', 'length', 'max'=>255),
            array('autorid, laststate', 'length', 'max'=>10),
            array('createdate', 'safe'),
            array('id, projectid, describe, linkrd, mnemoid, unitid, priority, defectvedomostid, autorid, laststate, createdate, touserid', 'safe', 'on'=>'search'),
            //array('describe', 'default','value'=>'Обязательно к заполнению'),
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
            'users_email_copy1'=>'Копия1',
            'users_email_copy2'=>'Копия2',
            'users_email_copy3'=>'Копия3',
            'users_email_copy4'=>'Копия4',
            'users_email_copy5'=>'Копия5',
            'linkrd'=>'Ссылка на РД',
            'where'=>'Где',
            'attachepath'=>'Приложение'
        );
    }

    public function search($projectid,$par=0){
        $criteria=new CDbCriteria;
        switch ($par){
            case 'open':
                $criteria->condition = 'laststate>0';
                break;
            case 'close':
                $criteria->condition = 'laststate=0';
                break;
            case 'all':
                break;
            default :
                $criteria->condition = 'laststate>0';
            break;
        }        
        $criteria->compare('id',$this->id,true);
        $criteria->compare('projectid',$projectid);
        $criteria->compare('`where`',$this->where,true);
        $criteria->compare('describe',$this->describe,true);
        $criteria->compare('mnemoid',$this->mnemoid,false);
        $criteria->compare('unitid',$this->unitid,true);
        $criteria->compare('priority',$this->priority,true);
        $criteria->compare('defectvedomostid',$this->defectvedomostid,true);
        $criteria->compare('autorid',$this->autorid);
        $criteria->compare('laststate',$this->laststate,true);
        $criteria->compare('createdate',$this->createdate,true);
        $criteria->compare('touserid',$this->touserid);
        //$criteria->order = 'laststate DESC';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => 32),
            'sort'=>array(
                'defaultOrder'=>'priority ASC',
            )
        ));
    }
    
    public function getRowHtmlOptions($row, $data, $grid){
        $RT=0;$GT=0;$BT=0;
        $R=255;$G=255;$B=255;
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
                $RT=255;$GT=255;$BT=255;
                break;
            case 5:
                $R=200;$G=200;$B=200;
                break; 
        }
        $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
        $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
        $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
        $RT=str_pad(dechex($RT), 2, "0", STR_PAD_LEFT);
        $GT=str_pad(dechex($GT), 2, "0", STR_PAD_LEFT);
        $BT=str_pad(dechex($BT), 2, "0", STR_PAD_LEFT);
        $value=array('style'=>'background-color:'."#$R$G$B".';color:'."#$RT$GT$BT");
        return $value;
    }
}