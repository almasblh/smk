<?php

class LoginForm extends CFormModel
{
    public $username;
    public $password;
    private $_identity;

    public function rules(){
        return array(
            array('username, password', 'required'),
            array('password', 'authenticate'),
        );
    }
	public function attributeLabels(){
            return array(
                'username' => 'Пользователь',
                'password' => 'Пароль',
            );
            
	}
    
    
    public function authenticate($attribute,$params){
        if(!$this->hasErrors()){
            $this->_identity=new UserIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
                $this->addError('password','Incorrect username or password.');
        }
    }
    
    public function GetUsersList(){                                             //Кешированный список всех пользователей системы
        $list=Yii::app()->cache->get('UsersList');
        if($list===false)                        
            {   $list=CHtml::listData(ServUsers::model()->findAll(array('condition'=>'active=1','order'=>'fname')), 'id', 'FIO');
                Yii::app()->cache->set('UsersList',$list);
            }
        return $list;
    }
        
    public function login(){
        if($this->_identity===null){
            $this->_identity=new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE){
            //$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            $duration=3600*24*30;
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }
}
