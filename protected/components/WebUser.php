<?php
class WebUser extends CWebUser {
    private $_model = null;
    public $myReturnUrl;
 
    function getUseHttps() {
        if($user = $this->getModel()){
            // в таблице User есть поле useHttps
            return $user->useHttps;
        }
    }
 
    private function getModel(){
        if($this->_model === null){
            $this->_model = WebUser::model()->findByPk($this->id);
        }
        return $this->_model;
    }

    public function beforeLogin() {
        $this->setReturnUrl($this->getReturnUrl($this->myReturnUrl));
        return true;
    }
}

?>
