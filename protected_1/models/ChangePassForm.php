<?php

class ChangePassForm extends CFormModel
{
    public $oldpass;
    public $newpass1;
    public $newpass2;
    public $verifyCode;

    public function rules(){
        return array(
            array('oldpass, newpass1, newpass2', 'required'),
            array('oldpass, newpass1, newpass2', 'safe', 'on'=>'search'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }
    public function attributeLabels(){
        return array(
            'oldpass'=>'Старый пароль',
            'newpass1'=>'Новый пароль',
            'newpass2'=>'Новый пароль еще раз',
            'verifyCode'=>'Код верификации',
        );
    }
}