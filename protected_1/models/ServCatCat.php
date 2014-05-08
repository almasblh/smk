<?php

class ServCatCat extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'serv_cat_cat';
	}

	public function relations()
	{
		return array(
                    'ServUsersRole'=>array(self::MANY_MANY, 'ServUsersRole', 'serv_users_role(category, srv_catid)'),
                    'Categories' => array(self::BELONGS_TO, 'Categories', 'catid'),
		);
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