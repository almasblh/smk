<?php

class OimPribors extends CActiveRecord
{
	public $dataProvider;
        public $newpassport;
        public $id;
        public $name;
        public $descr;
        public $zavn;
        public $passnom;
        public $lastpoverdate;
        public $nextpoverdate;
        public $wherenow;
        public $passpath;
        public $priborid;
        public $povererid;
        public $poverer;
        public $newpoverdate;
        public $svidpath;
        public $svidnom;
        
	public static function model($className=__CLASS__){
            return parent::model($className);
	}

        public function afterConstruct(){
            //$this->povererList=Yii::app()->db->createCommand('SELECT name FROM oim_pribors_poverer;')->queryAll();
            $count=Yii::app()->db->createCommand("SELECT COUNT(*) FROM oim_pribors;")->queryScalar();
            $sql="SELECT p.*,f.*,(SELECT name FROM oim_pribors_poverer WHERE id=f.povererid) poverer FROM oim_pribors p LEFT JOIN oim_pribors_files f ON p.id = f.priborid WHERE p.lastpoverdate='2000-01-01' OR p.lastpoverdate=f.newpoverdate ";
            $this->dataProvider=new CSqlDataProvider($sql, array(
                'totalItemCount'=>$count,
                'sort'=>array(
                    'attributes'=>array(
                        'name', 'descr','nextpoverdate','wherenow'
                    ),
                ),
                'pagination'=>array(
                        'pageSize'=>20,
                ),
            ));
        }
                
	public function tableName(){
		return 'oim_pribors';
	}

	public function rules(){
            return array(
                array('name, descr', 'length', 'max'=>60),
                array('zavn', 'length', 'max'=>30),
                array('passnom', 'length', 'max'=>50),
                array('wherenow', 'length', 'max'=>11),
                array('lastpoverdate, nextpoverdate, passpath', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, descr, zavn, passnom, lastpoverdate, nextpoverdate, wherenow, passpath', 'safe', 'on'=>'search'),
                array('newpassport','file','types'=>'jpg,pdf,tiff,gif,png,zip','allowEmpty'=>true),//правило для сохранения файла с пасспортом прибора
            );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
                'id' => 'ID',
                'name' => 'Наименование',
                'descr' => 'Описание',
                'zavn' => 'Зав.№',
                'passnom' => 'пасспорт',
                'lastpoverdate' => 'посл. поверка',
                'nextpoverdate' => 'след. поверка',
                'wherenow' => 'Где сейчас',
                'passpath' => 'Руководство прибора',
            );
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{   // Warning: Please modify the following code to remove attributes that should not be searched.
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('descr',$this->descr,true);
            $criteria->compare('zavn',$this->zavn,true);
            $criteria->compare('passnom',$this->passnom,true);
            $criteria->compare('lastpoverdate',$this->lastpoverdate,true);
            $criteria->compare('nextpoverdate',$this->nextpoverdate,true);
            $criteria->compare('wherenow',$this->wherenow,true);
            //$criteria->compare('passpath',$this->passpath,true);


            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
	}
}