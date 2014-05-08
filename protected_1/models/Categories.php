<?php

class Categories extends CActiveRecord
{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'categories';
    }

    public function rules(){
        return array(
            array('lft, rgt, level, controllerid, actionid, caption', 'required'),
            array('lft, rgt, level, controllerid, actionid', 'numerical', 'integerOnly'=>true),

            array('id, lft, rgt, level, controllerid, actionid, caption', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'ServControllers'=>array(self::BELONGS_TO, 'ServControllers', 'controllerid'),
            'ServControllersAction'=>array(self::BELONGS_TO, 'ServControllersAction', 'actionid'),
            'ServUsers'=>array(self::MANY_MANY, 'ServUsers','serv_cat_user(catid, srv_userid)'),
            'ServUsersCategory'=>array(self::MANY_MANY, 'ServUsersCategory','serv_cat_cat(catid, srv_catid)'),
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
        );
    }

    public function search(){
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('lft',$this->lft);
        $criteria->compare('rgt',$this->rgt);
        $criteria->compare('level',$this->level);

        $criteria->with=array('serv_controllers','serv_controllers_action','serv_category_access_controllers','serv_users_access_controllers');
        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }

    public function behaviors(){
        return array(
            'TreeBehavior' => array(
                'class' => 'application.extensions.nestedset.TreeBehavior',
                '_idCol' => 'id',
                '_lftCol' => 'lft',
                '_rgtCol' => 'rgt',
                '_lvlCol' => 'level',
            ),
            'TreeViewTreebehavior' => array(
                'class' => 'application.extensions.nestedset.TreeViewTreebehavior',
            )
        );
    }
    public function getNameExt(){
        $str=str_repeat(' . ',$this->level).' '.$this->caption;
        if(isset($this->controllerid) && $this->controllerid<>0) $str.=' - '.ServControllers::model()->findByPK($this->controllerid)->name;
        if(isset($this->actionid) && $this->actionid<>0) $str.='/'.ServControllersAction::model()->findByPK($this->actionid)->name;
        return $str;
    }
}