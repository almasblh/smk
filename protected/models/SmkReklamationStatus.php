<?php

class SmkReklamationStatus extends CAssaRecord
{
    public $NewComent='';

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'smk_reklamation_status';
	}

    public function rules(){
        return array(
            //array('responsibleuserid1', 'numerical', 'integerOnly'=>true),
            //array('reklamationid, statusid, signaturecreator', 'length', 'max'=>10),
            //array('comment', 'length', 'max'=>$max),
            //array('datecreaterecord, datestart, datestop', 'safe'),
/*            array(  'aktpath',
                    'file',
                    'types'=>'jpg,pdf,tiff,tif'
            ),
 * 
 */
            
            array('id, reklamationid, statusid, comment, signaturecreator, datecreaterecord, datestart, datestop, responsibleuserid1, steppersent,managercoment,attache','safe'),//, 'on'=>'search'),
        );
    }

    public function relations(){
        return array(
            'creator'=>array(self::BELONGS_TO, 'ServUsers', 'signaturecreator'),
            'responsibleuser1'=>array(self::BELONGS_TO, 'ServUsers', 'responsibleuserid1'),
            'status'=>array(self::BELONGS_TO, 'ReestrReklamationStatusName', 'statusid'),
            'attache'=>array(self::HAS_MANY, 'SmkReklamationAttaches', 'reklamationstatusid'),
        );
    }
    
    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'reklamationid' => 'Рекламация',
            'statusid' => 'Статус',
            'comment' => 'Коментарии',
            'signaturecreator' => 'Инициатор',
            'datecreaterecord' => 'Дата записи',
            'datestart' =>'Начало(план)',
            'datestop' => 'Окончание(план)',
            'datestartfact' =>'(факт)',
            'datestopfact' => '(факт)',
            'responsibleuserid1' => 'исполнитель',
            'attache' => 'Прил.',
            'aktpath' => 'Пр.',
            'steppersent' => 'вып.%',
            'managercoment'=>'--- Задача -->',
            //'NewComent'=>'Добавьте сюда свой коментарий___(пока этап не завершен - сюда можно добавлять сколько угодно коментариев)'
        );
    }
    
    public function afterSave() {
        parent::afterSave();
        Yii::app()->cache->delete('reclamations_cach_table');
    }
    
    public function getVisiblebtnComment($row, $data, $grid){
        return (($data->steppersent<100) && (($data->responsibleuserid1==Yii::app()->user->id)||Yii::app()->user->getState('reklmanager')));
    }
    
    public function getRowColor($row, $data, $grid){
        return array('style'=>'background-color:'."#A9D29B");
        $min=210;
        $max=255;
        if($data->statusid==-1){
            $R=0;$G=255;$B=0;
        }
        else{
            $date1=getdate();                                               //сегодня
            $date2=getdate(strtotime($data->datestart));                    //дата старта этапа
            $date3=getdate(strtotime($data->datestop));                     //дата окончания этапа
            $dd=$date1[0]-$date2[0];                                        //сколько времени прошло с момента старта этапа, если <0 значит этап еще не начался
            if(($date1[0]-$date3[0])>0){                                    //если дата оконания этапа уже прошла, то - то цвет - красный
                $R=255;$G=0;$B=0;
            }
            elseif($dd<0){                                                  //если этап еще не начался - то цвет - серый
                $R=$min;$G=$min;$B=$min;
            }
            else{                                                           //если сюда попали - значит этап действует сейчас и нужно расчитать цвет
                $B=$min;                                                    //расчет синей составляющей
                $dd1=$date3[0]-$date2[0];                                   //расчет продолжительности этапа
                $kr=($max-$min)/($dd1+1);                                   //расчет коэффициента угла наклона
                $R=$dd*$kr+$min;                                            //рачсет красной составляющей (увеличивается по мере продвижения этапа)
                if($R>$max) $R=$max;
                $G=$max-$dd*$kr;                                            //расчет зеленой составляющей (уменьшается по мере продвижения этапа)
                if($G<$min) $G=$min;
                if($G>$max) $G=$max;
            }
            /*
            //$B=$min+($max-$min)*0.67;
            $B=127;
            $date1=getdate();
            $date2=getdate(strtotime($data->datestart));
            $dd=$date1[0]-$date2[0];
            if($dd<0){
                $R=127;//$min;
                $G=255;
            }
            else{
                $date3=getdate(strtotime($data->datestop));
                $dd1=$date3[0]-$date2[0];
                $kr=($max-$min)/($dd1+1);
                $R=$dd*$kr+127;//$min;
                if($R>255) $R=255;
                $G=255-$dd*$kr;
                if($G<127) $G=127;
                if($G>255) $G=255;
                if($data->steppersent>=100){
                    $R=127;//$min;
                    $G=255;
                }
            }
            //$kg=($max-$min)/100;
            //$G=$kg*$data->steppersent+$min;
            //if($G<0) $G=$min;
            //if($G>$max) $G=$max;
             * 
             */
        }
        $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
        $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
        $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
        return array('style'=>'background-color:'."#$R$G$B");
    } 
        public function getComent($data, $row, $grid){
            $a=substr($data->comment,0,20);
            $str='<p class="layer300" title="'.$a.'">';
            if(strlen($data->comment)>200){
                $str.=Chtml::ajaxLink(
                        "More>>",
                        CHtml::normalizeUrl(array("SmkReklamationStatus/view",'id'=>$data->id,'par'=>'viewcomment')),
                        array('type' => 'POST',
                              'update' =>'.MoreComment',
                        )
                    ).'</br>';
            }
            $str.=$data->comment;
            $str.='</p>';
            return $str;
        }        
        public function getStatus($data, $row, $grid){
            $str='<p class="layer200" title="'.$data->status['name'].'">';
            $str.=$data->status['name'];
            $str.='</p>';
            return $str;
        }        
        public function getTask($data, $row, $grid){
            $str='<p class="layer200" title="'.$data->managercoment.'">';
            $str.=$data->managercoment;
            $str.='</p>';
            return $str;
        }
        
        public function getDateStop($data, $row, $grid){
            if( Yii::app()->user->getState('reklmanager') &&                    // если это менеджер по рекламациям
                $data->steppersent<100 &&                                       // и этап не завершен
                getdate(strtotime($data->datestop))[0]-getdate()[0]<0           // и просрочен
            ){
                $a=CHtml::ajaxButton(                                             // то - вывести кнопку для изменения сроков этапа
                    $data->datestop,
                    CHtml::normalizeUrl(array("SmkReklamationStatus/update",'id'=>$data->id,'par'=>'changedatestop')),
                    array('type' => 'POST',
                        'update' => '.InputForm'
                    )
                );
            }
            else(
                $a=$data->datestop                                              // иначе - вывести просто дату окончания этапа
            );
            return $a;
        }
        

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('reklamationid',$this->reklamationid,true);
		$criteria->compare('statusid',$this->statusid,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('signaturecreator',$this->signaturecreator,true);
		$criteria->compare('datecreaterecord',$this->datecreaterecord,true);
		$criteria->compare('datestart',$this->datestart,true);
		$criteria->compare('datestop',$this->datestop,true);
		$criteria->compare('responsibleuser1',$this->responsibleuser1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public function srcView($id){//фильтрация статусов по принадлежности к рекламации
        $criteria=new CDbCriteria;
        $criteria->compare('reklamationid',$id,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize' => 32),//Yii::app()->params['postsPerPage']),
        ));
    }
}