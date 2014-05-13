<?php

class SmkProjectUnits extends CAssaRecord
{
        public $actions;
    
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'smk_project_units';
	}

	public function rules()
	{

		return array(
			array('projectid, unitid, vkpeN, lastKD'
                            , 'numerical'
                            , 'integerOnly'=>true
                        ),
                        array(
                            'projectid, unitid, vkpeN'
                            ,'required'
                        ),
/*                        array(
                            'vkpeN, unitid'
                            ,'unique'
                        ),
 * 
 */

			array('id, projectid, unitid, vkpeN, lastKD', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
                    'KdCollectionTemp'=>array(self::HAS_MANY, 'KdCollectionTemp', 'prunitid'), 
                    'SmkProjects'=>array(self::BELONGS_TO, 'SmkProjects', 'projectid'),
                    //'ReestrSystemName'=>array(self::BELONGS_TO, 'ReestrSystemName', 'systemid'),                
                    'ReestrUnitName'=>array(self::BELONGS_TO, 'ReestrUnitName', 'unitid'), 
		);
	}

	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'SmkProjects.Npgvr'=>'Проект',
                    'projectid' => 'Projectid',
                    //'ReestrSystemName.caption'=>'Система',
                    //'systemid' => 'Systemid',
                    'ReestrUnitName.caption'=>'Шкаф',
                    'unitid' => 'Unitid',
                    'vkpeN'=>'зав.№',
                    'lastKD'=>'Последняя версия КД'
                    ,'ReestrUnitName.ReestrSystemName.caption'=>'Система'
                    ,'actions'=>'Действия'
		);
	}

	public function search($projectid=0)
	{
            if(!$projectid) $projectid=Yii::app()->user->GetState('activeproject');
            $criteria=new CDbCriteria;

            $criteria->compare('projectid',$projectid);
            $criteria->compare('unitid',$this->unitid);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array('pageSize' => Yii::app()->params['postsPerPage']),
            ));
        }

}