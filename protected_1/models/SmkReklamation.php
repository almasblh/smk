<?php

class SmkReklamation extends CAssaRecord
{
    public $st;
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'smk_reklamation';
    }

    public function rules(){
        return array(
            array('signaturecreator', 'numerical', 'integerOnly'=>true),
            array(  'aktpath',
                    'file',
                    'types'=>'jpg,pdf,tiff,tif,png,xls,xlsx,doc,docx,eml',
                    'on'=>'insert'                
            ),
            array(
                'problemname, aktpath',
                'required',
                'on'=>'insert'
            ),
            array(
                'problemname, aktpath',
                'safe',
                'on'=>'insert'
            ),            
            //array('elementid, projectid, prunitid', 'length', 'max'=>11),
           // array('datecreaterecord', 'safe'),

            array('id, state, problemname, signaturecreator, datecreaterecord, countdays, projectid, object, dogovor, contactFIO, contactTel, laststatusid', 'safe', 'on'=>'search update insert'),
        );
    }

	public function relations(){
            return array(
                'creator'=>array(self::BELONGS_TO, 'ServUsers', 'signaturecreator'),
                //'StatusName'=>array(self::BELONGS_TO, 'ReestrReklamationStatusName', 'laststatusid'),
                'status'=>array(self::BELONGS_TO, 'SmkReklamationStatus', 'laststatusid'),
                'SmkProjects'=>array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
                'SmkProjectUnits'=>array(self::BELONGS_TO, 'SmkProjectUnits', 'prunitid'),
                'ReestrUnitName'=>array(self::BELONGS_TO, 'ReestrUnitName', 'prunitid'),
                'elements'=>array(self::BELONGS_TO, 'elements', 'elementid'),
            );
	}
        
        public function afterSave() {
            parent::afterSave();
            Yii::app()->cache->delete('reclamations_cach_table');
        }

	public function attributeLabels(){
            return array(
                'id' => '№',
                'problemname' => 'Проблемма',
                'signaturecreator' => 'Автор',
                'datecreaterecord' => 'Дата создания',
                'elementid' => 'Элемент',
                'projectid' => 'ПГВР',
                'prunitid' => 'Шкаф',
                'laststatusid'=>'Последний статус',
                'aktpath'=>'Акт рекламации',
                'status.responsibleuser1'=>'ответственный',
                'object' => 'Объект',
                'dogovor' => 'Договор',
                'contactFIO' => 'конт ФИО',
                'contactTel' => 'конт Тел',
                'state'=>'стат',
                'countdays'=>'Всего дней',
                'SmkProjects.Npgvr'=>'ПГВР',
                'st'=>'+'
            );
	}
        
        public function getVisiblebtnStatus($row, $data, $grid){
            return (($this->laststatusid==$data->id) && Yii::app()->user->getState('reklmanager'));
        }

        public function getProblemComent($data, $row, $grid){
            $str=Yii::app()->cache->get('prcomid='.$data->status['id']);        //получить кеш по номеру статуса
            if($str===false){
                $str='<p class="layer300" title="'.$data->problemname.'">'.CHtml::link($data->problemname,
                CHtml::normalizeURL(array(
                    'SmkReklamation/view&id='.$data->id
                    ))
                ).'</p>';
                Yii::app()->cache->set('prcomid='.$data->status['id'], $str, 100);//записать в кеш на 100 секунд
            }
            return $str;
        }        
            
        public function getRowHtmlOptions($row, $data, $grid){
            $value=Yii::app()->cache->get('rstatid='.$data->status['id']);      //получить кеш по номеру статуса
            if($value===false)
                {                                                               //если кеша нет, то просчитать цвет заново
                $min=210;
                $max=255;
                if(!$data->state){                                              //если рекламация закрыта - то цвет - зеленый
                    $R=0;$G=255;$B=0;
                }
                elseif($data->status['statusid']==0){                           //если это ввод новой рекламации
                    $R=239;$G=231;$B=126;                                       //то цвет - желтенький
                }
                elseif($data->status['steppersent']>=100){                      //если эта завершен на 100% - то цвет - зеленый
                    $R=150;$G=$max;$B=150;
                }
                else{
                    $date1=getdate();                                           //сегодня
                    $date2=getdate(strtotime($data->status['datestart']));      //дата старта этапа
                    $date3=getdate(strtotime($data->status['datestop']));       //дата окончания этапа
                    $dd=$date1[0]-$date2[0];                                    //сколько времени прошло с момента старта этапа, если <0 значит этап еще не начался
                    if(($date1[0]-$date3[0])>0){                                //если дата оконания этапа уже прошла, то - то цвет - красный
                        $R=255;$G=0;$B=0;
                    }
                    elseif($dd<0){                                              //если этап еще не начался - то цвет - серый
                        $R=$min;$G=$min;$B=$min;
                    }
                    else{                                                       //если сюда попали - значит этап действует сейчас и нужно расчитать цвет
                        $B=$min;                                                    //расчет синей составляющей
                        $dd1=$date3[0]-$date2[0];                                   //расчет продолжительности этапа
                        $kr=($max-$min)/($dd1+1);                                   //расчет коэффициента угла наклона
                        $R=$dd*$kr+$min;                                            //рачсет красной составляющей (увеличивается по мере продвижения этапа)
                        if($R>$max) $R=$max;
                        $G=$max-$dd*$kr;                                            //расчет зеленой составляющей (уменьшается по мере продвижения этапа)
                        if($G<$min) $G=$min;
                        if($G>$max) $G=$max;
                    }
                }
                $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
                $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
                $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
                $value=array('style'=>'background-color:'."#$R$G$B");
                Yii::app()->cache->set('rstatid='.$data->status['id'], $value, 100);//записать в кеш на 100 секунд
            }
                return $value;
        } 

        public function search(){
            $criteria=new CDbCriteria;
            $criteria->compare('id',$this->id,true);
            $criteria->compare('state',$this->state);
            $criteria->compare('problemname',$this->problemname,true);
            $criteria->compare('projectid',$this->projectid);
            $criteria->compare('signaturecreator',$this->signaturecreator,true);
            $criteria->compare('datecreaterecord',$this->datecreaterecord,true);
            $criteria->compare('countdays',$this->countdays,true);
            $criteria->compare('laststatusid',$this->laststatusid);
            $criteria->compare('responsibleuser1',$this->status['responsibleuser1'],true);
            
            $val= new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(                                            //определить размер страницы по колличеству открытых рекламаций
                    'pageSize' => Yii::app()->db->createCommand('SELECT COUNT(sr.id) as a FROM smk_reklamation sr WHERE sr.state;')->queryRow()['a']
                ),
                'sort'=>array(
                    'defaultOrder'=>'state DESC, id DESC',
                    'attributes'=>array(
                        'id'=>array(
                            'asc' => $expr='id',
                            'desc' => $expr.' DESC',
                        ),
                        'SmkProjects.Npgvr'=>array(
                            'asc' => $expr='SmkProjects.Npgvr',
                            'desc' => $expr.' DESC',
                        ),
                        'problemname'=>array(
                            'asc' => $expr='problemname',
                            'desc' => $expr.' DESC',
                        ),
                        'datecreaterecord'=>array(
                            'asc' => $expr='datecreaterecord',
                            'desc' => $expr.' DESC',
                        ),
                        'countdays'=>array(
                            'asc' => $expr='countdays',
                            'desc' => $expr.' DESC',
                        ),
                        'signaturecreator'=>array(
                            'asc' => $expr='signaturecreator',
                            'desc' => $expr.' DESC',
                        ),
                        'laststatusid'=>array(
                            'asc' => $expr='laststatusid',
                            'desc' => $expr.' DESC',
                        ),
                        'status.responsibleuser1'=>array(
                            'asc' => $expr='status.responsibleuser1',
                            'desc' => $expr.' DESC',
                        ),
                    )
                ),
            ));
            return $val;
	}
}