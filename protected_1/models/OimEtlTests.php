<?php

class OimEtlTests extends CActiveRecord
{

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'oim_etl_tests';
    }

    public function rules(){
        return array(
            array('num, testid, projectid, tester1id, tester2id, tester3id, prunitid', 'required'),
            array('num, testid, projectid, tester1id, tester2id, tester3id, resume, prunitid', 'numerical', 'integerOnly'=>true),
            array('comment', 'length', 'max'=>255),

            array('id, num, testid, projectid, datecreaterecord, tester1id, tester2id, tester3id, resume, comment', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'ServUsersTester1'=>array(self::BELONGS_TO, 'ServUsers', 'tester1id'),
            'ServUsersTester2'=>array(self::BELONGS_TO, 'ServUsers', 'tester2id'),
            'ServUsersTester3'=>array(self::BELONGS_TO, 'ServUsers', 'tester3id'),
            'ReestrOimEtlTests'=>array(self::BELONGS_TO, 'ReestrOimEtlTests', 'testid'),
            'SmkProjects'=>array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
            'SmkProjectUnits'=>array(self::BELONGS_TO, 'SmkProjectUnits', 'prunitid'),
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'num' => '№ исп',
            'testid' => 'Наименование',
            'projectid' => '№ ПГВР',
            'datecreaterecord' => 'Дата создания записи',
            'datestart'=>'Дата начала испытания',
            'datestop'=>'Дата окончания испытания',
            'tester1id' => '1-й испытатель',
            'tester2id' => '2-й испытатель',
            'tester3id' => 'Протокол проверил',
            'resume' => 'Соотв. НД',
            'comment' => 'Comment',
            'prunitid'=>'Шкаф',
            'ServUsersTester1.FIO'=>'1-й тестер',
            'ServUsersTester2.FIO'=>'2-й тестер',
            'ServUsersTester3.FIO'=>'Протокол проверил',
            'SmkProjects.Npgvr' => '№ ПГВР',
            'ReestrOimEtlTests.name'=>'Испытание',
            'SmkProjectUnits.unitid'=>'Шкаф'
        );
    }

    public function search(){
        $criteria=new CDbCriteria;
/*
        $criteria->compare('id',$this->id,true);
        $criteria->compare('num',$this->num);
        $criteria->compare('testid',$this->testid);
        $criteria->compare('projectid',YII::app()->user->getState('activeproject'));
        $criteria->compare('prunitid',$this->prunitid,true);        
        $criteria->compare('datecreaterecord',$this->datecreaterecord,true);
        $criteria->compare('tester1id',$this->tester1id);
        $criteria->compare('tester2id',$this->tester2id);
        $criteria->compare('tester3id',$this->tester3id);
        $criteria->compare('resume',$this->resume);
        $criteria->compare('comment',$this->comment,true);
 * 
 */
        $criteria->order='id DESC';
        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            )
        );
    }
    
/*    public function srchmaxnum(){
        $criteria=new CDbCriteria;

        //$criteria->compare('num',$this->num);
        $criteria->compare('num','max(num)');
        $criteria->compare('projectid',YII::app()->user->getState('activeproject'));

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            )
        );
    }
 * 
 */
}