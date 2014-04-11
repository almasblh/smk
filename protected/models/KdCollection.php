<?php
class KdCollection extends CActiveRecord
{
    public $BOMfile;
    public $lastKD=0;
    public $pars_str_error;
    public $id;
    
    public static function model($className=__CLASS__){
            return parent::model($className);
    }

    public function tableName(){
            return 'kd_collection';
    }

    public function rules(){
        return array(
/*            array('prunitid, assemblegid, ninassenblege, elementid, part1id, part2id, part3id, version, actual, signaturecreator,bascet,nio,ninbascet',
                'numerical',
                'integerOnly'=>true
            ),
            array('refdes, nominal, type, symbol'
                ,'length'
                ,'max'=>50
            ),
            array('note, chanelname'
                ,'length'
                ,'max'=>255
            ),

            array('prunitid'
                ,'required'
                //,'on'=>'create'
            ),
            array('prunitid, datecreate, BOMfile'
                ,'safe'
            ),

            array('BOMfile'
                ,'file'
                ,'types'=>'BOM,bom'
            ),
* 
 */
            array('id, prunitid, refdes, type, assemblegid, ninassenblege, elementid, part1id, part2id, part3id, symbol, note, nominal, chanelname, version, actual, datecreate, signaturecreator, bascet, nio, ninbascet'
                ,'safe'
                //,'on'=>'search'
            ),
        );
    }

    public function relations(){
        return array(
            'SmkProjectUnits'=>array(self::BELONGS_TO, 'SmkProjectUnits', 'prunitid'),
            //'ReestrSystemName'=>array(self::BELONGS_TO, 'ReestrSystemName', 'systemid'),                
            //'ReestrUnitName'=>array(self::BELONGS_TO, 'ReestrUnitName', 'unitid'),                
            'ReestrAssemblageName'=>array(self::BELONGS_TO, 'ReestrAssemblageName', 'assemblegid'),                
            'Elements'=>array(self::BELONGS_TO, 'Elements', 'elementid'),                
            'Part1'=>array(self::BELONGS_TO, 'Elements', 'part1id'),                
            'Part2'=>array(self::BELONGS_TO, 'Elements', 'part2id'),                
            'Part3'=>array(self::BELONGS_TO, 'Elements', 'part3id'),                
        );
    }

    public function attributeLabels(){
        return array(
            'id' => 'ID',
            'prunitid' => 'Шкаф',
            'refdes' => 'Refdes',
            'type' => 'Type',
            'assemblegid' => 'Сборка',
            'ninassenblege' => '№ в сборке',
            'elementid' => 'Элемент',
            'part1id' => 'Эл-т ч.1',
            'part2id' => 'Эл-т ч.2',
            'part3id' => 'Эл-т ч.3',
            'symbol' => 'Символ',
            'note' => 'Примечание',
            'nominal' => 'Номинал',
            'chanelname' => 'Канал',
            'version' => 'Версия КД',
            'actual' => 'Актуальность',
            'datecreate' => 'Дата созд.',
            'signaturecreator' => 'Подпись',
            'ReestrAssemblageName.name'=>'Сборка',
            'Elements.p_n'=>'Элемент',
            'bascet'=>'корз.',
            'nio'=>'№ кан.',
            'ninbascet'=>'№ в корз.'
        );
    }

    public function search($id=0){
        //if($this->bascet==0) $this->bascet='';
        //if($this->ninbascet==0) $this->ninbascet='';
        //if($this->nio==0) $this->nio='';
        $criteria=new CDbCriteria;
        
        $criteria->compare('prunitid',$id);
        //$criteria->compare('chanelname',$this->chanelname,true);
        $criteria->compare('bascet',$this->bascet);
        $criteria->compare('ninbascet',$this->ninbascet);
        $criteria->compare('nio',$this->nio);
        //$criteria->condition='bascet>0';

        //$criteria->order='bascet,ninbascet,nio';

        return new CActiveDataProvider($this
            , array(
                'criteria'=>$criteria,
                'pagination'=>array('pageSize'=>32,
            ),
        ));
    }
    
    public function srch2(){
            $criteria=new CDbCriteria;

            //$criteria->compare('id',$this->id);
            $criteria->compare('projectid',YII::app()->user->getState('activeproject'));
            $criteria->compare('systemid',$this->systemid,true);
            $criteria->compare('prunitid',$this->prunitid);
            //$criteria->compare('refdes',$this->refdes,true);
            //$criteria->compare('type',$this->type,true);
            //$criteria->compare('assemblegid',$this->assemblegid);
            //$criteria->compare('ninassenblege',$this->ninassenblege);
            //$criteria->compare('elementid',$this->elementid);
            //$criteria->compare('part1id',$this->part1id);
            //$criteria->compare('part2id',$this->part2id);
            //$criteria->compare('part3id',$this->part3id);
            //$criteria->compare('symbol',$this->symbol,true);
            //$criteria->compare('note',$this->note,true);
            //$criteria->compare('nominal',$this->nominal,true);
            $criteria->compare('chanelname',$this->chanelname,true);
            //$criteria->compare('version',$this->version);
            //$criteria->compare('actual',$this->actual);
            //$criteria->compare('datecreate',$this->datecreate,true);
            //$criteria->compare('signaturecreator',$this->signaturecreator);
            $criteria->compare('bascet',$this->bascet?$this->bascet:'bascet>0');
            $criteria->compare('nio',$this->nio);
            $criteria->compare('ninbascet',$this->ninbascet);
            //$criteria->condition='bascet>0';
            $criteria->order='bascet,ninbascet,nio';

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array('pageSize'=>32,
                ),
            ));
    }
/*    
    public function srchPE($id){
            $criteria=new CDbCriteria;

            //$criteria->compare('id',$this->id);
            //$criteria->compare('projectid',YII::app()->user->getState('activeproject'));
            $criteria->compare('refdes',$this->refdes);
            $criteria->compare('prunitid',$id);

            //$criteria->compare('type',$this->type,true);
            //$criteria->compare('assemblegid',$this->assemblegid);
            //$criteria->compare('ninassenblege',$this->ninassenblege);
            //$criteria->compare('elementid',$this->elementid);
            //$criteria->compare('part1id',$this->part1id);
            //$criteria->compare('part2id',$this->part2id);
            //$criteria->compare('part3id',$this->part3id);
            //$criteria->compare('symbol',$this->symbol,true);
            //$criteria->compare('note',$this->note,true);
            //$criteria->compare('nominal',$this->nominal,true);
            //$criteria->compare('chanelname',$this->chanelname,true);
            //$criteria->compare('version',$this->version);
            //$criteria->compare('actual',$this->actual);
            //$criteria->compare('datecreate',$this->datecreate,true);
            //$criteria->compare('signaturecreator',$this->signaturecreator);
            //$criteria->compare('bascet',$this->bascet?$this->bascet:'bascet>0');
            //$criteria->compare('nio',$this->nio);
            //$criteria->compare('ninbascet',$this->ninbascet);
            //$criteria->order='bascet,ninbascet,nio';

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array('pageSize'=>32,
                ),
            ));
    }
 * 
 */
}