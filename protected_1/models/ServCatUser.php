<?php

class ServCatUser extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'serv_cat_user';
	}

	public function rules(){
            return array(
                //array('id, catid, controllerid, actionid', 'safe', 'on'=>'search'),
            );
	}
    public function search(){
        $a=$this->create;
        $criteria=new CDbCriteria;
    }
}