<?php
class ServUsersRole extends CActiveRecord{
    
    public $diffdays;
    
    public static function model($className=__CLASS__){
        return parent::model($className);
    }
    
    public function tableName(){
        return 'serv_users_role';
    }
    
    public function rules(){
        return array(
            array('userid', 'required'),
            array('userid, projectid, projectstepid, category, signaturecreator', 'numerical', 'integerOnly'=>true),
            array('id, userid, projectid, projectstepid, category, signaturecreator, datecreaterecord', 'safe'),

            array('id, userid, projectid, projectstepid, category, signaturecreator, datecreaterecord', 'safe', 'on'=>'search'),
        );
    }
    public function relations(){
        return array(
            'ServUsers' => array(self::BELONGS_TO, 'ServUsers', 'userid'),
            'SmkProjects' => array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
            'SmkProjectStep' => array(self::BELONGS_TO, 'SmkProjectStep', 'projectid'),
            'SmkProjectStepName' => array(self::BELONGS_TO, 'SmkProjectStepName', 'projectstepid'),
            'ServUsersCategory' => array(self::BELONGS_TO, 'ServUsersCategory', 'category'),
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'userid' => 'Userid',
            'projectid' => 'Проект',
            'projectstepid' => 'Этап',
            'category' => 'Категория пользователя',
            'signaturecreator'=>'подпись создавшего запись',
            'datecreaterecord'=>'Дата создания записи',
            'diffdays'=>'до завершения (дней)'
        );
    }
    public function search($id){
        $criteria=new CDbCriteria;

/*        $criteria->with=array(
            'ServUsers',
            'SmkProjects',
            'SmkProjectStep',
            'ServUsersCategory'            
        );
 * 
 */
        $criteria->condition='t.userid='.$id;
//        $criteria->condition='t.userid='.$id.' AND (t.datestop=0 OR (t.datestop<>0 AND t.datestop>NOW()))';
        //$criteria->condition='t.datestop>NOW()';
        // $criteria->compare('userid',$id);
         
        //$criteria->compare('userid',$this->userid);
        //$criteria->compare('projectid',$this->projectid);
        //$criteria->compare('projectstepid',$this->projectstepid);
        //$criteria->compare('category',$this->category);
        //$criteria->compare('datestart',$this->datestart,true);
        //$criteria->compare('datestop',$this->datestop,true);


       
        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array('pageSize' => Yii::app()->params['postsPerPage']),
        ));
    }
    
    public function  GetDaysBetween($date1 , $date2){
        if($date2==0) return '-';
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2)->days;
        if($datetime1>$datetime2) $interval=-$interval;
        return $interval;
    }
}