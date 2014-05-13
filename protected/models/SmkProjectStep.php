<?php

class SmkProjectStep extends CAssaRecord
{
        public $listKorrection=array(0);
        public $projkuratorid;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
   
        
	public function tableName()
	{
		return 'smk_project_step';
	}

    public function rules(){
        return array(
            array('current_persent,projectid,stepid,signaturecurator,signaturecreator'
                , 'numerical'
            )
            ,array('current_persent,projectid,stepid,signaturecurator,curatorid,signaturecreator'
                , 'length'
                , 'max'=>11
            ),
            array('stepcomment'
                , 'length'
                , 'max'=>255
            ),            
            array('datestart,datestop,curatorid'
                ,'required'
            )
            ,array('datestop'
                ,'DatesStartStopValidator','DateStart'=>$this->datestart,'DateStop'=>$this->datestop
            )
            ,array('curatorid'
                ,'numerical'
                ,'min'=>1
            )
            ,array('current_persent'
                ,'numerical'
                ,'min'=>0
                ,'max'=>100
            )
            ,array('stepid'
                ,'unique'
                ,'on'=>'create'
            )
//            ,array(
//                'datestart,datestop,datestartfact,datestopfact,datecreaterecord'
//                ,'date'
//            )
            ,array('id, projectid, stepid, datestart, datestop, ncorrect,ordern,
                , datestartfact, datestopfact, current_persent
                , signaturecurator, curatorid, signaturecreator, datecreaterecord'
                ,'safe'
            )
            ,array('id, projectid, stepid, datestart, datestop, ncorrect,stepcomment,
                datestartfact, datestopfact, current_persent,
                signaturecurator, curatorid, signaturecreator, datecreaterecord'
                , 'safe'
                , 'on'=>'search,srchView'
            ),
        );
    }

	public function relations()
	{
		return array(
                    'SmkProjects'=>array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
                    'SmkProjectStepName'=>array(self::BELONGS_TO, 'SmkProjectStepName', 'stepid'),
                    'ServUsersManager'=>array(self::BELONGS_TO, 'ServUsers', 'signaturemanager'),                    
                    'ServUsersStepCurator'=>array(self::BELONGS_TO, 'ServUsers', 'curatorid'),
                    'SmkProjectStepcuratorJurnal'=>array(self::HAS_MANY, 'SmkProjectStepcuratorJurnal', 'projectstepid'),
                    'ServUsersRole'=>array(self::HAS_MANY, 'ServUsersRole', 'projectstepid'),
                );
	}

	public function attributeLabels(){
            return array(
                'id' => 'ID',
                'projectid' => 'Проект',
                'stepid' => 'Этап',
                'datestart' => 'Начало (план)',
                'datestop' => 'Окончание (план)',
                'ncorrect' => 'Номер коррекции плана',
                'datestartfact' => 'Начало (факт)',
                'datestopfact' => 'Окончание (факт)',
                'current_persent' => 'Выполнено (%)',
                'signaturemanager' => 'Подпись менеджера проекта',
                'curatorid' => 'Ответственный исполнитель',
                'signaturecurator'=>'согласовано',
                'agreed'=>'Согласовано',
                'stepcomment'=>'-',
                'ordern'=>'№'
            );
	}
        
    public function getSignatureCuratorValue($data, $row, $grid){
        $a=$data->signaturecurator>0 ? $data->ServUsersStepCurator['fname'].' '.CHtml::image('./images/18.png','Ok') : "-";
        if( $data->signaturecurator==0 &&
            $data->curatorid==Yii::app()->user->id
            ){
            $a=CHtml::Link(
                        CHtml::button('Согласовать',
                            array('style'=>'width:120px')
                        ),
                        CHtml::normalizeUrl(array('SmkProjectStep/update&id='.$data->id.'&sign=1'))
                    );
        }
        return $a;
    }        
        
    public function getOrdern($data, $row, $grid){
        $a="";
        if(((Yii::app()->user->id==217) || ($this->projkuratorid == Yii::app()->user->id))){
            $a.=CHtml::ajaxlink('^',
                CHtml::normalizeUrl(array('SmkProjectStep/update','projectid'=>$data->projectid,'ordern'=>$data->ordern,'par'=>'1')),
                    array('type' => 'POST',
                          'update' => '.ProjectTable'
                    ),
                    array('id'=>'n1'.$row)
            );
            $a.=$data->ordern;
            $a.=CHtml::ajaxlink('v',
                CHtml::normalizeUrl(array('SmkProjectStep/update','projectid'=>$data->projectid,'ordern'=>$data->ordern,'par'=>'2')),
                    array('type' => 'POST',
                          'update' => '.ProjectTable'
                    ),
                    array('id'=>'n2'.$row)
            );
        }
        else{
            $a=$data->ordern;
        }
        return $a;
    }
    
            public function getDateStart($data, $row, $grid){
            if((Yii::app()->user->id==217) || ($this->projkuratorid == Yii::app()->user->id)){
                $a=CHtml::ajaxLink(
                    CHtml::button($data->datestart,
                        array('style'=>'width:120px')
                    ),
                    CHtml::normalizeUrl(array("SmkProjectStep/update","id"=>$data->id)),
                    array('type' => 'POST',
                        'update' => '.SmkProjectStepIndexInputForm'
                    ),
                    array(
                        'name'=>'btnStart'.$data->id
                    )
                );
            }
            else(
                $a=$data->datestart
            );
            return $a;
        } 
        
        public function getDateStop($data, $row, $grid){
            if((Yii::app()->user->id==217) || ($this->projkuratorid == Yii::app()->user->id)){
                $a=CHtml::ajaxLink(
                        CHtml::button($data->datestop,
                            array('style'=>'width:120px')
                        ),
                        CHtml::normalizeUrl(array("SmkProjectStep/update","id"=>$data->id)),
                        array('type' => 'POST',
                            'update' => '.SmkProjectStepIndexInputForm'
                        ),
                    array(
                        'name'=>'btnStop'.$data->id
                    )
                );
            }
            else{
                $a=$data->datestop;
            }
            return $a;
        }
        
        public function getCurator($data, $row, $grid){
            if((Yii::app()->user->id==217) || ($this->projkuratorid == Yii::app()->user->id)){
                $a=CHtml::ajaxLink(
                        CHtml::button($data->ServUsersStepCurator["FIO2"],
                            array('style'=>'width:250px')
                        ),
                        CHtml::normalizeUrl(array("SmkProjectStep/update","id"=>$data->id)),
                        array('type' => 'POST',
                            'update' => '.SmkProjectStepIndexInputForm'
                        ),
                    array(
                        'name'=>'btnStepCurator'.$data->id
                    )
                );
            }
            else{
                $a=CHtml::link(CHtml::encode($data->ServUsersStepCurator["FIO2"]),array("ServUsers/view","id"=>$data->curatorid));
            }
            return $a;
        }
    
    public function srchView($id=0){
        if($this->projectid==0) $this->projectid='';
        if($this->datestart==0) $this->datestart='';
        if($this->datestop==0) $this->datestop='';
        if($this->curatorid==0) $this->curatorid='';        
        
        $criteria=new CDbCriteria;
        $criteria->compare('stepid','10',true);
        $criteria->compare('projectid',$this->projectid,true);
        $criteria->compare('datestart',$this->datestart,true);
        $criteria->compare('datestop',$this->datestop,true);
        $criteria->compare('datestartfact',$this->datestartfact,true);
        $criteria->compare('datestopfact',$this->datestopfact,true);
        //$criteria->compare('current_persent',$this->current_persent,true);
        $criteria->compare('curatorid',$this->curatorid,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => Yii::app()->params['postsPerPage']),
        ));
    }
    public function search($array){        
        $sort = new CSort;
        $sort->defaultOrder = 'datestart ASC';
        $sort->attributes = array('stepid','datestart','datestop','datestartfact','datestopfact','current_persent','curatorid');
        
        return new CArrayDataProvider($array
            , array(
                //'criteria'=>$criteria,
                'pagination'=>array('pageSize' => Yii::app()->params['postsPerPage']),
                'sort'=>$sort
        ));
    }

    public function srchProject($id=0,$cur=0){
        $this->projkuratorid=$cur;
        $criteria=new CDbCriteria;
        $criteria->compare('projectid',$id,true);
        $criteria->compare('ncorrect',$this->ncorrect,true);
        $criteria->compare('current_persent',$this->current_persent,true);
       
        $criteria->order='t.ordern';
        $a= new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => Yii::app()->params['postsPerPage']),
        ));
        return $a;
    } 
    
    
}