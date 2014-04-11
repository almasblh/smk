<?php

class CAssaRecord extends CActiveRecord
{
    public function GetUsersFIO2($id=-1){                                       //Кешированный список фамилий ИО всех пользователей системы
        $users=Yii::app()->cache->get('UsersFIO2');
        if($users===false){
            foreach(Yii::app()->db->createCommand('SELECT id,fname,sname,tname FROM serv_users;')->queryAll() as $row=>$val){
                $users[$val['id']]=$val['fname'].' '.mb_substr($val['sname'],0,1,"UTF-8").'.'.mb_substr($val['tname'],0,1,"UTF-8").'.';
            }
            Yii::app()->cache->set('UsersFIO2',$users);
        }
        if($id<>-1) return $users[$id];
        else        return $users;
    }
    
    public function GetUsersFIO($id=-1){                                        //Кешированный список фамилий ИО всех пользователей системы
        $users=Yii::app()->cache->get('UsersFIO');
        if($users===false){
            foreach(Yii::app()->db->createCommand('SELECT id,fname,sname,tname FROM serv_users;')->queryAll() as $row=>$val){
                $users[$val['id']]=$val['fname'].' '.$val['sname'].' '.$val['tname'];
            }
            Yii::app()->cache->set('UsersFIO',$users);
        }
        if($id<>-1) return $users[$id];
        else        return $users;
    }
    
    public function GetUsersList(){                                             //Кешированный список всех пользователей системы
        $list=Yii::app()->cache->get('UsersList');
        if($list===false)                        
            {   $list=CHtml::listData(ServUsers::model()->findAll(array('condition'=>'active=1','order'=>'fname')), 'id', 'FIO');
                Yii::app()->cache->set('UsersList',$list);
            }
        return $list;
    }
    
    public function GetReestrReklamationStatusName($id=-1){                     //Кешированный список наименований всех статусов
        $list=Yii::app()->cache->get('ReestrReklamationStatusName');
        if($list===false)                        
            {   $list=CHtml::listData(ReestrReklamationStatusName::model()->findAll(array('order'=>'name')), 'id', 'name');
                Yii::app()->cache->set('ReestrReklamationStatusName',$list);
            }
        if($id<>-1) return $list[$id];
        else        return $list;
    }
    
    public function GetPGVRList($id=-1){                                        //Кешированный список всех ПГВР-ов
        $list=Yii::app()->cache->get('PGVRList');
        if($list===false)
            {   $list=CHtml::listData(SmkProjects::model()->findAll(array('select'=>'id,CONCAT(Npgvr," - ",IF(LENGTH(Name)<80, Name, CONCAT(LEFT(Name,80),"..."))) as list','order'=>'Npgvr' )), 'id', 'list');
                Yii::app()->cache->set('PGVRList',$list,3600);
            }
        if($id<>-1) return $list[$id];
        else        return $list;
    }

    public function GetServUsersDolgnost($id=-1){                               //Кешированный список всех должностей пользователей системы
        $list=Yii::app()->cache->get('ServUsersDolgnost');
        if($list===false)                        
            {   $list=CHtml::listData(ServUsersDolgnost::model()->findAll(array('order'=>'name')), 'id', 'name');
                Yii::app()->cache->set('ServUsersDolgnost',$list);
            }
        if($id<>-1) return $list[$id];
        else        return $list;
    }
    
    public function GetServUsersDepartament($id=-1){                            //Кешированный список всех департаментов компании
        $list=Yii::app()->cache->get('ServUsersDepartament');
        if($list===false)                        
            {   $list=CHtml::listData(ServUsersDepartament::model()->findAll(array('order'=>'name')), 'id', 'name');
                Yii::app()->cache->set('ServUsersDepartament',$list);
            }
        if($id<>-1) return $list[$id];
        else        return $list;
    }
    
    public function GetServUsersOtdel($id=-1){                                  //Кешированный список всех отделов компании
        $list=Yii::app()->cache->get('ServUsersOtdel');
        if($list===false)                        
            {   $list=CHtml::listData(ServUsersOtdel::model()->findAll(array('order'=>'name')), 'id', 'name');
                Yii::app()->cache->set('ServUsersOtdel',$list);
            }
        if($id<>-1) return $list[$id];
        else        return $list;
    }
    
    public function GetReestrOfficeLocate($id=-1){                              //Кешированный список всех офисов компании
        $list=Yii::app()->cache->get('ReestrOfficeLocate');
        if($list===false)                        
            {   $list=CHtml::listData(ReestrOfficeLocate::model()->findAll(array('order'=>'name')), 'id', 'name');
                Yii::app()->cache->set('ReestrOfficeLocate',$list);
            }
        if($id<>-1) return $list[$id];
        else        return $list;
    }
}