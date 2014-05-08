<?php

class ServUsers extends CAssaRecord{
    
/*    public $departament;
    public $dolgnost;
    public $otdel;
 * 
 */
    public $office;

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'serv_users';
    }

    public function rules(){
        return array(
            array('fname, sname, tname, departamentid, dolgnostid, category, otdelid, officelocate, elbezid', 'required'),
            array('category, active', 'numerical', 'integerOnly'=>true),
            array('fname, sname, tname', 'length', 'max'=>32),
            array('pass', 'length', 'max'=>41),
            array('departamentid, dolgnostid', 'length', 'max'=>3),
            array('email', 'length', 'max'=>50),
            array('email', 'email'),
            array('tel_in', 'length', 'max'=>10),
            array('tel_mob', 'length', 'max'=>18),

            array('id, fname, sname, tname, pass, departamentid, dolgnostid, otdelid, category, active, email, tel_in,tel_mob, officelocate, elbezid', 'safe', 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'ServUsersCategory' => array(self::BELONGS_TO, 'ServUsersCategory', 'category'),
            'ServUsersDepartament' => array(self::BELONGS_TO, 'ServUsersDepartament', 'departamentid'),
            'ServUsersDolgnost' => array(self::BELONGS_TO, 'ServUsersDolgnost', 'dolgnostid'),
            'ServUsersOtdel' => array(self::BELONGS_TO, 'ServUsersOtdel', 'otdelid'),
            'Categories'=>array(self::MANY_MANY, 'Categories', 'serv_cat_user(catid, srv_userid)'),
            'ServUsersRole' => array(self::HAS_MANY, 'ServUsersRole', 'userid'),
            'ReestrOfficeLocate' => array(self::BELONGS_TO, 'ReestrOfficeLocate', 'officelocate'),
            'ElbezUserCard' => array(self::HAS_MANY, 'ElbezUserCard', 'userid'),
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'fname' => 'Фамилия',
            'sname' => 'Имя',
            'tname' => 'Отчество',
            'pass' => 'Пароль',
            'departamentid' => 'Департамент',
            'dolgnostid' => 'Должность',
            'category' => 'Категория',
            'otdelid' => 'Отдел',
            'active' => 'Активность',
            'email' =>'E-mail',
            'tel_in' => 'Внутренний телефон',
            'tel_mob' => 'Мобильный телефон',
            'officelocate' => 'Офис',
            'departament' => 'Департамент',
            'dolgnost' => 'Должность',
            'otdel' => 'Отдел',
            'elbezid'=>'эл/без.'
        );
    }
    
    public function afterConstruct() {
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM reestr_offises_locate;')->queryAll() as $row=>$val){//ициализируем массив $officeallocate из таблицы reestr_offises_locate
            $this->office[$val['id']]=$val['name'];
        }
    }
/*        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_dolgnost;')->queryAll() as $row=>$val){//ициализируем массив $dolgnost из таблицы serv_users_dolgnost
            $this->dolgnost[$val['id']]=$val['name'];
        }
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_departament;')->queryAll() as $row=>$val){//ициализируем массив $departament из таблицы serv_users_departament
            $this->departament[$val['id']]=$val['name'];
        }
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_otdel;')->queryAll() as $row=>$val){//ициализируем массив $otdel из таблицы serv_users_otdel
            $this->otdel[$val['id']]=$val['name'];
        }
        parent::afterConstruct();
    }
 * 
 */

    public function srchManager(){
        $criteria=new CDbCriteria;

        $criteria->compare('ServUsersRole->category',4096,true);

        //$criteria->order='active';
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function search(){
        $criteria=new CDbCriteria;
        $criteria->with = array('ElbezUserCard');
        $criteria->compare('id',$this->id,true);
        //$criteria->compare('elbezid',isset($this->elbezid)?$this->elbezid:false);
        $criteria->compare('fname',$this->fname,true);
        $criteria->compare('sname',$this->sname,true);
        $criteria->compare('tname',$this->tname,true);
        $criteria->compare('departamentid',$this->departamentid);
        $criteria->compare('dolgnostid',$this->dolgnostid);
        $criteria->compare('otdelid',$this->otdelid);
        $criteria->compare('category',$this->category);
        $criteria->compare('officelocate',$this->officelocate);
        $criteria->compare('active',1);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('tel_in',$this->tel_in,true);
        $criteria->compare('tel_mob',$this->tel_mob,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>32),
        ));
    }
    
    public function getFIO(){
        return $this->fname.' '.$this->sname.' '.$this->tname;
    }
    public function getFIO2(){
        return $this->fname.' '.mb_substr($this->sname,0,1,"UTF-8").'.'.mb_substr($this->tname,0,1,"UTF-8").'.';
    }
    public function getElBezHtmlOptions($row, $data, $grid){
        $str='';
        if(isset($data->ElbezUserCard[0]['status'])){
            switch ($data->ElbezUserCard[0]['status']){
                case 1:
                    $str='rozeBackground';
                break;
                case 2:
                    $str='yelloBackground';
                break;
                case 3:
                    $str='greenBackground';
                break;
            }
        }
        return $str;
    }    
    public function getElBez($data, $row, $grid){
        $d='./images/elbez/gr0.png';;                                           //сформировать название файля для граф вывода как групы по эл-без-ти нет
        if(isset($data->elbezid)){                                              //если существует запись на группу, то сформировать название файля для граф вывода как номер группы
            $a=$data->ElbezUserCard[0]['grup'];                                 //взять группу
            //$b=($this->DiffNow($data->ElbezUserCard[0]['nextdateinspection'])>0)?1:0;
            $d = './images/elbez/'.'gr'.(int)($a/10).($a%10).(($this->DiffNow($data->ElbezUserCard[0]['nextdateinspection'])>0)?1:0).'.png';//сформировать название файла для граф вывода
        }
        if(isset($data->elbezid)){                                              //если существует запись на группу
            $e=CHtml::link(CHtml::imageButton($d),                              //сформировать графическую ссылку на карточку пользователя по эл.без=ти
                array('ElbezUserCard/view','id'=>$data->elbezid) //isset($data->elbezid)?$data->elbezid:0,'userid'=>$data->id)
            );                
        }else{                                                                  //если не существует записи на группу
            if(isset(Yii::app()->user->getState('usermainrole')[0]['category']) && ((Yii::app()->user->getState('usermainrole')[0]['category']&&8192==true))){
               $e=CHtml::Link(
                    CHtml::image($d),                       //сформировать графическую ссылку на карточку пользователя по эл.без=ти
                    array('ElbezUserCard/create','userid'=>$data->id),
                    array(
                        'id'=>$data->id,
                        //'update'=>'.InputForm',
                        'onclick'=>'a();'
                    )
                );
            }else{
                $e=CHtml::image($d);
            }
        }
        //формирование еще одной графической кнопки
        if(isset($data->elbezid)){                                              //если существует запись на группу
            if(Yii::app()->user->id==$data->id){                                // и это вы, то
                switch ($data->ElbezUserCard[0]['status']){
                    case 1:                                                     //если статус - здать
                        $e.=CHtml::link(CHtml::imageButton('./images/elbez/test.png'),//то вывести граф ссылку сдать
                                array('ElBezQuests/index','id'=>$data->elbezid)
                            );
                    break;
                    case 2:                                                     //если статус оформить протокол (т.е. здал)
                        $e.=CHtml::link(CHtml::imageButton('./images/elbez/protprn.png'),//то вывести граф ссылку оформить протокол
                                array('ElBezQuests/index','id'=>$data->elbezid)
                            );
                    break;
                    case 3:                                                     //если статус вложить скан протокола
                        $e.=CHtml::link(CHtml::imageButton('./images/elbez/protscan.png'),//то вывести граф ссылку вложить скан протокола
                                array('ElBezQuests/index','id'=>$data->elbezid)
                            );
                    break;
                }
            }else{                                                              //если это не вы
                switch ($data->ElbezUserCard[0]['status']){
                    case 1:                                                     //если статус - здать
                        $e.=CHtml::image('./images/elbez/test.png');            //то вывести картинку сдать
                    break;
                    case 2:                                                     //если статус оформить протокол (т.е. здал)
                        $e.=CHtml::image('./images/elbez/protprn.png');         //то вывести картинку оформить протокол
                    break;
                    case 3:                                                     //если статус вложить скан протокола
                        $e.=CHtml::image('./images/elbez/protscan.png');        //то вывести картинку вложить скан протокола
                    break;
                }
            }
        }
        return $e;
    }
    
    //Функция вычисления разности между сегодня и даты из параметра
    //вход: $date - дата
    private function  DiffNow($date){
        $date=getdate(strtotime($date));
        $now=getdate();
        return ($date[0]-$now[0]);
    }
    
    public function getUserLink($data, $row, $grid){
        $a=CHtml::link(
            CHtml::encode($data->fname),
            "http://intranet.sintek.net/phone/newwin.php?menu_marker=si_employeeview&dn=CN=".$data->fname.' '.$data->sname.' '.$data->tname.",OU=".$this->office[$data->officelocate].",OU=SINTEK,DC=intranet-sintek,DC=net",
            array('target'=>'_blank')
        );
        return $a;
    }
}