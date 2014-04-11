<?php

class NewDefectForm extends CFormModel
{
    public $mnemoid;
    public $nodeid;
    public $describe;
    public $defectvedomost;
    public $tocategoryid;
    public $touserid;
    public $priority = array('Высок','Средн','Низк');
    public $comment;

    public function rules(){
        return array(
            array('mnemoid, nodeid, describe, defectvedomost, tocategoryid, touserid, priority, comment', 'required'),
            array('priority, autorid', 'numerical', 'integerOnly'=>true),
            array('projectid', 'length', 'max'=>8),
            array('mnemoid', 'length', 'max'=>3),
            array('mnemoid, nodeid, priority, describe, comment, defectvedomost, tocategoryid, touserid', 'safe', 'on'=>'search'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }
    public function attributeLabels(){
        return array(
            'mnemoid'=>'Мнемосхема',
            'nodeid'=>'Сборочный узел',
            'priority'=>'Приоритет',
            'describe'=>'Описание дефекта',
            'comment'=>'Что требуется',
            'defectvedomost'=>'Дефектная ведомость',
            'tocategoryid'=>'для кого (категория)',
            'touserid'=>'для кого (конкретно)',
        );
    }
}