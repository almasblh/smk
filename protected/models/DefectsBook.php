<?php
class DefectsBook extends CActiveRecord{
    
    public $status = array('Открыт','Переоткрыт','Отклонен','Выполнен','Проверен','Закрыт');
    public $prior = array('Высок','Средн','Низк');
    public $active;

    
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'defects_book';
    }

    public function rules(){
        return array(
//            array('projectid, priority', 'required'),
//            array('priority, autorid', 'numerical', 'integerOnly'=>true),
//            array('projectid', 'length', 'max'=>8),
//            array('mnemoid', 'length', 'max'=>3),

            array('id, projectid, describe, mnemoid, nodeid, priority, autorid, defectvedomostid, tocategoryid, touserid, curstate, createdate', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'SmkProjects' => array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
            'PrMnemoschemaName' => array(self::BELONGS_TO, 'PrMnemoschemaName', 'mnemoid'),
            'PrNodesName' => array(self::BELONGS_TO, 'PrNodesName', 'nodeid'),
            'ServUsers'=>array(self::BELONGS_TO,'ServUsers','autorid'),
            'DefectsBookStateDefect'=> array(self::HAS_MANY,'DefectsBookStateDefect','id'),
            'ToUser'=>array(self::BELONGS_TO,'ServUsers','touserid'),
            'ToCategory'=>array(self::BELONGS_TO,'ServUsersCategory','tocategoryid'),        
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'projectid' => 'Проект',
            'describe' => 'Описание',
            'mnemoid' => 'Мнемо-схема',
            'nodeid' => 'Устрой-ство',
            'priority' => 'Прио-ритет',
            'autorid' => 'Автор',
            'defectvedomostid' => 'Дефектная ведомость',
            'curstate'=>'Статус',
            'createdate'=>'Дата создания',
            'tocategoryid'=>'кому (категория)',
            'touserid'=>'кому (конкретно)',
        );
    }

    public function search(){
        $criteria=new CDbCriteria;

//        $criteria->compare('id',$this->id,true);
        $criteria->compare('projectid',Yii::app()->user->getState('activeproject'),true);
        $criteria->compare('describe',$this->describe,true);
        $criteria->compare('mnemoid',$this->mnemoid,true);
        $criteria->compare('nodeid',$this->nodeid,true);
        $criteria->compare('priority',$this->priority);
        $criteria->compare('autorid',$this->autorid);
        $criteria->compare('curstate',$this->curstate);
        $criteria->compare('createdate',$this->createdate);
        $criteria->compare('defectvedomostid',$this->defectvedomostid,true);
        $criteria->compare('tocategoryid',$this->tocategoryid,true);
        $criteria->compare('touserid',$this->touserid,true);        
        $criteria->with=array('DefectsBookStateDefect','PrMnemoschemaName','PrNodesName','ServUsers');
        $criteria->order='priority';

        return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                        'pagination' => array(
                            'pageSize' => Yii::app()->params['postsPerPage'],
                        ),
                    )
                );
    }
}