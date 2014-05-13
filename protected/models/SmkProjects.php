<?php
class SmkProjects extends CAssaRecord
{
    public $list;
    
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'smk_projects';
    }

    public function rules(){
        return array(
/*            array('Name, Npgvr, dogovor, Works, customer, end_customer, object, path, managerid, kuratorid'
                , 'required'
            ),
 * 
 */
            array('Npgvr, managerid, kuratorid'
                , 'required'
            ),
            array('Name, Npgvr, path, project'
                , 'length'
                , 'max'=>255
            ),
            array('Name, Npgvr, path'
                ,'unique'
            ),
            array(  'id, Name, Npgvr, dogovor, approved, Works, customer, project, end_customer, 
                    object,path,managerid,kuratorid,current_step,percentage_complet, signaturecreator, datecreaterecord,
                    approved, stepsapproved, mailcountmanager, nexttimemailmanager, mailcountshefOUP, nexttimemailshefOUP,
                    mailcounttechdirecor, nexttimemiletechdirector,
                    subdivision, datestart, datestop, dateagreement, datepayment1, datepayment2, datepayment3, dateTTN, nTTN, datesignatureTTN,
                    datetorg12, dateendpnr, datefinanseact, prim'
                ,   'safe'
            ),
            array('id, Name, Npgvr, dogovor, approved, Works, customer, end_customer, object,path,managerid,kuratorid,current_step,percentage_complet, signaturecreator, datecreaterecord'
                , 'safe'
                , 'on'=>'search'
            ),
        );
    }
   
    public function relations(){
        return array(
            'manager'=>array(self::BELONGS_TO, 'ServUsers', 'managerid'),
            'kurator'=>array(self::BELONGS_TO, 'ServUsers', 'kuratorid'),
            'shefOUP'=>array(self::BELONGS_TO, 'ServUsers', 'signatureshefOUPid'),
            'techdirector'=>array(self::BELONGS_TO, 'ServUsers', 'signaturetechdirectorid'),
            'SmkProjectStep'=>array(self::HAS_MANY, 'SmkProjectStep', 'projectid'),
        );
    }

    public function attributeLabels(){
        return array(
            'Name' => 'Наименование',
            'Npgvr' => '№ ПГВР',
            'dogovor' => '№ договора',
            'Works' => 'Работы',
            'customer' => 'Заказчик',
            'end_customer'=>'Конечный пользователь',
            'object' => 'Объект',
            'path' =>'Путь к файлам проекта',
            'date_make' =>'Дата посл. коррекции',
            'percentage_complet'=>'Вып.%',
            'signaturecreator'=>'Создатель',
            'datecreaterecord'=>'Дата создания',
            'lastcorrection'=>'№ посл. коррекции',
            'kuratorid' =>'Куратор',
            'managerid' =>'Руководитель проекта',
            'signaturemanagerid'=>'подпись Рук.Пр.',
            'datesignaturemanager'=>'дата подписи Рук.Пр.',
            'signatureshefOUPid'=>'начальник ОУП',
            'datesignatureshefOUP'=>'дата подписи начальника ОУП',
            'signaturetechdirectorid'=>'технический директор',
            'datesignaturetechdirector'=>'дата подписи тех. дир-ра',
            'approved'=>'Утверждено',
            'project'=>'Проект',
            'subdivision'=>'Подразделения',
            'datestart'=>'Дата начала работ',
            'datestop'=>'Плановая дата завершения работ',
            'dateagreement'=>'Дата отправки ПГВР на согласование',
            'datepayment1'=>'Поступление оплаты по договору аванс',
            'datepayment2'=>'Поступление оплаты по договору 2 платеж',
            'datepayment3'=>'Поступление оплаты по договору 3 платеж',
            'dateTTN'=>'дата, по которой оформляем первичку',
            'nTTN'=>'№ТТН, по которой оформляем первичку',
            'datesignatureTTN'=>'Дата подписания ТТН Заказчиком',
            'datetorg12'=>'Дата подписания ТОРГ-12 Заказчиком',
            'dateendpnr'=>'Дата завершения ПНР (по тех. акту)',
            'datefinanseact'=>'Дата выставления финансового акта, счф, счета на последний платеж',
            'prim'=>'Примечание',
            'list'=>'list'
        );
    }
        public function getName($data, $row, $grid){
            $str='<p class="layer200">';
            $str.=$data->Name;
            $str.='</p>';
            return $str;
        }
        
        public function getNpgvrValue($data, $row, $grid){
            return  CHtml::ajaxLink($data->Npgvr,
                            CHtml::normalizeURL(array(
                                ('SmkProjects/view&id='.$data->id))),
                            array('type' => 'POST',
                                'update' =>'.SmkProjectsSection'
                            )
                        );
        }
        
        public function getDogovor($data, $row, $grid){
            $str='<p class="layer100">';
            $str.=$data->dogovor;
            $str.='</p>';
            return $str;
        }
        public function getWorks($data, $row, $grid){
            $str='<p class="layer200">';
            $str.=$data->Works;
            $str.='</p>';
            return $str;
        }
        public function getCustomer($data, $row, $grid){
            $str='<p class="layer200">';
            $str.=$data->customer;
            $str.='</p>';
            return $str;
        }
        public function getEnd_customer($data, $row, $grid){
            $str='<p class="layer200">';
            $str.=$data->end_customer;
            $str.='</p>';
            return $str;
        }
        public function getObject($data, $row, $grid){
            $str='<p class="layer200">';
            $str.=$data->object;
            $str.='</p>';
            return $str;
        }
        
        public function getRowHtmlOptions($row, $data, $grid){
            $stylestr='';
            $min=200;
            $max=255;
            $R=$min;
            $B=$min;
            $kg=($max-$min)/100;
            $G=$kg*$data->percentage_complet+$min;
            if($G<$min){
                $G=$min;
                //$R=$G;
            }
            if($G>$max) $G=$max;
            $R=$max+$min-$G;
/*            if($data->approved==0){
                $R=$max;
                $G=150;
                $B=150;
                $stylestr='border-color: #FF0000;';
            }
 * 
 */
            $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
            $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
            $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
            $stylestr.='background-color:'."#$R$G$B".';';
            return array('style'=>$stylestr);
        }

        public function getManagerLine(){
            $a=$this->getUserLink($this->manager);
            if($this->signaturemanagerid){
                $a.=' - - <span style=color:white;background-color:green;">Согласовано<span>';
                if(Yii::app()->user->id==$this->managerid && $this->approved==0){
                    $a.='<span>'.CHtml::link(' - - Удалить',
                            CHtml::normalizeUrl(array('SmkProjects/update','id'=>$this->id,'par'=>'managerid','ok'=>0)),
                            array('style'=>'background-color:white;')
                    ).'<span>';
                }
            }
            else{
                $a.=' - - <span style=color:white;background-color:red;">На согласовании<span>';
                if(Yii::app()->user->id==$this->managerid && $this->approved==0){
                    $a.='<span>'.CHtml::link(' - - Согласовать',
                            CHtml::normalizeUrl(array('SmkProjects/update','id'=>$this->id,'par'=>'managerid','ok'=>Yii::app()->user->id)),
                            array('style'=>'background-color:white;')
                    ).'<span>';
                }
            }
            return $a;
        }
        
        public function getshefOUPLine(){
            $a='';
            if(isset($this->shefOUP)) $a.=$this->getUserLink($this->shefOUP);
            if($this->signatureshefOUPid){
                $a.=' - - <span style=color:white;background-color:green;">Согласовано<span>';
                if(Yii::app()->user->id==$this->signatureshefOUPid && $this->approved==0){
                    $a.='<span>'.CHtml::link(' - - Удалить',
                            CHtml::normalizeUrl(array('SmkProjects/update','id'=>$this->id,'par'=>'signatureshefOUPid','ok'=>0)),
                            array('style'=>'background-color:white;')
                    ).'<span>';
                }
            }
            else{
                $a.=' - - <span style=color:white;background-color:red;">На согласовании<span>';
                $shefOUPid=18;                                                  // начальник ОУП - Атучина Л.В. - потом исправить на правильное присвоение пока затычка
                if(Yii::app()->user->id==$shefOUPid && $this->approved==0){
                    $a.='<span>'.CHtml::link(' - - Согласовать',
                            CHtml::normalizeUrl(array('SmkProjects/update','id'=>$this->id,'par'=>'signatureshefOUPid','ok'=>Yii::app()->user->id)),
                            array('style'=>'background-color:white;')
                    ).'<span>';
                }
            }
            return $a;
        }   
        public function gettechdirectorLine(){
            $a=CHtml::link(CHtml::encode($this->techdirector["FIO2"]),
                                array("ServUsers/view","id"=>$this->signaturetechdirectorid)
                            );
            if($this->signaturetechdirectorid)
                $a.=' - - <span style=color:white;background-color:green;">Согласовано<span>';
                if(Yii::app()->user->id==$this->signaturetechdirectorid && $this->approved==0){
                    $a.='<span>'.CHtml::link(' - - Удалить',
                            CHtml::normalizeUrl(array('SmkProjects/update','id'=>$this->id,'par'=>'signaturetechdirectorid','ok'=>0)),
                            array('style'=>'background-color:white;')
                    ).'<span>';
                }
            else
                $a.=' - - <span style=color:white;background-color:red;">На согласовании<span>';
                if(Yii::app()->user->id==$this->signaturetechdirectorid && $this->approved==0){
                    $a.='<span>'.CHtml::link(' - - Согласовать',
                            CHtml::normalizeUrl(array('SmkProjects/update','id'=>$this->id,'par'=>'signaturetechdirectorid','ok'=>Yii::app()->user->id)),
                            array('style'=>'background-color:white;')
                    ).'<span>';
                }
            return $a;
        }
        
        public function getStepsRowHtmlOptions($row, $data, $grid){
            $min=200;
            $max=255;
            //if($data->current_persent==100){
            //    $G=150;
            //    $R=0;
            //    $B=0;
            //}
            //else{
                $B=$min+($max-$min)*0.67;
                $date1=getdate();
                $date2=getdate(strtotime($data->datestart));
                $dd=$date1[0]-$date2[0];
                if($dd<0) $R=$min;
                else{
                    $date3=getdate(strtotime($data->datestop));
                    $dd1=$date3[0]-$date2[0];
                    $kr=($max-$min)/($dd1?$dd1:1);
                    $R=$dd*$kr+$min;
                    if($R>$max) $R=$max;
                    if($data->current_persent>=100) $R=$min;
                }
                $kg=($max-$min)/100;
                $G=$kg*$data->current_persent+$min;
                if($G<0) $G=$min;
                if($G>$max) $G=$max;
            //}
            $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
            $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
            $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
            return array('style'=>'background-color:'."#$R$G$B");
        }
        
        public function getUserLink($data){
            $a=CHtml::link(
                CHtml::encode($data->GetUsersFIO2($data->id)),
                "http://intranet.sintek.net/phone/newwin.php?menu_marker=si_employeeview&dn=CN=".$data->GetUsersFIO($data->id).",OU=".$data->GetReestrOfficeLocate($data->officelocate).",OU=SINTEK,DC=intranet-sintek,DC=net",
                array('target'=>'_blank')
            );
            return $a;
        }

    public function search(){
        $criteria=new CDbCriteria;
        $criteria->compare('Name',$this->Name,true);
        $criteria->compare('Npgvr',$this->Npgvr,true);
        $criteria->compare('dogovor',$this->dogovor,true);
        $criteria->compare('Works',$this->Works,true);
        $criteria->compare('customer',$this->customer,true);
        $criteria->compare('object',$this->object,true);
        $criteria->compare('percentage_complet',$this->percentage_complet);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => 32),//Yii::app()->params['postsPerPage']),
            'sort'=>array(
                'attributes'=>array(
                    'Name'=>array(
                        'asc' => $expr='Name',
                        'desc' => $expr.' DESC',
                    ),
                    'Npgvr'=>array(
                        'asc' => $expr='Npgvr',
                        'desc' => $expr.' DESC',
                    ),
                    'dogovor'=>array(
                        'asc' => $expr='dogovor',
                        'desc' => $expr.' DESC',
                    ),
                    'Works'=>array(
                        'asc' => $expr='Works',
                        'desc' => $expr.' DESC',
                    ),
                    'customer'=>array(
                        'asc' => $expr='customer',
                        'desc' => $expr.' DESC',
                    ),
                    'object'=>array(
                        'asc' => $expr='object',
                        'desc' => $expr.' DESC',
                    ),
                    'percentage_complet'=>array(
                        'asc' => $expr='object',
                        'desc' => $expr.' DESC',
                    ),
                )
            )
        ));
    }
    public function srch($par=0){
        $criteria=new CDbCriteria;
        if($par){
            switch ($par){
                case 'open':
                    $criteria->condition = 'percentage_complet<100';
                    break;
                case 'close':
                    $criteria->condition = 'percentage_complet >=100';
                    break;
                case 'nogaranty':
                    //$criteria->condition = 'percentage_complet = :userId AND date_create < NOW()';
                    break;
            }
        }
        $criteria->compare('Name',$this->Name,true);
        $criteria->compare('Npgvr',$this->Npgvr,true);
        $criteria->compare('percentage_complet',$this->percentage_complet);
        //$criteria->order = 'Npgvr, percentage_complet';
        return new CActiveDataProvider($this,
            array(
                'criteria'=>$criteria,
                'pagination'=>array('pageSize' => 320),
            )
        );
    }
}