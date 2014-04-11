<?php

class OimPriborsPoverka extends CActiveRecord
{
        public $PovererList;
        public $povererid;
        public $newpoverdate;
        public $svidnom;
        public $svidpath;
        public $name;
        public $descr;
        public $priborid;
        public $id;
        
        public static function model($className=__CLASS__){
            return parent::model($className);
	}

        public function GetAllTables(){
            $row=Yii::app()->db->createCommand('SELECT name FROM oim_pribors_poverer;')->queryAll();
            foreach($row as $rows=>$value){
                $this->PovererList[$rows+1]=$value['name'];
            }
            $row=Yii::app()->db->createCommand('SELECT name,descr FROM oim_pribors WHERE id='.$_GET['id'].';')->queryRow();
            $this->priborid=$_GET['id'];
            $this->name=$row['name'];
            $this->descr=$row['descr'];
        }
        
	public function SaveAll(){
            if($this->save()){
                $d=$this->newpoverdate;
                $nd=$this->DateAdd('y', 1, $d);
                $sql='UPDATE oim_pribors set lastpoverdate=\''.$d.'\', nextpoverdate=\''.$nd.'\' WHERE id='.$_GET['id'].';';
                Yii::app()->db->createCommand($sql)->query();
                return TRUE;
            }
            else
                return FALSE;
        }
        
        public function DateAdd($interval, $number, $date) {
            $c=explode('-',$date);
            switch ($interval) {
                case 'y':
                    $c[0]+=$number;
                    break;
                case 'm':
                    $c[1]+=$number;
                    break;
                case 'd':
                    $c[2]+=$number;
                    break;
            }
               $dat=getdate(mktime(0,0,0,$c[1],$c[2],$c[0]));
               $timestamp=$dat['year'].'-'.$dat['mon'].'-'.$dat['mday'];
               return $timestamp;
        }
        
        public function tableName(){
            return 'oim_pribors_files';
	}

	public function rules(){
            return array(
                array('svidnom', 'length', 'max'=>50),
                array('svidnom, newpoverdate', 'required'),
                array('povererid', 'default','value'=>0),
                
                array('svidpath','file','types'=>'jpg,pdf,tiff,tif'),//правило для сохранения файла со свидетельством прибора
                array('svidnom,newpoverdate','unique'),
                array('id,svidnom,povererid,svidpath,newpoverdate','safe'),
            );
	}

        public function relations(){
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
            );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
            return array(
                'svidpath' => 'Скан свидетельства о поверке',
                'newpoverdate' => 'Дата новой поверки',
                'povererid' => 'Поверяющая организация',
                'svidnom' => 'Номер свидетельства о поверке',
            );
	}
}