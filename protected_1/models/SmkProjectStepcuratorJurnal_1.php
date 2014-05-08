<?php

class SmkProjectStepcuratorJurnal extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'smk_project_stepcurator_jurnal';
	}

	public function rules()
	{
		return array(
                    array(
                        'current_percent,comment'
                        ,'required'
                    )
                    ,array('current_percent'
                        ,'numerical'
                        ,'min'=>0
                        ,'max'=>100
                    )
                    ,array('projectstepid, signaturestepcurator'
                        ,'length'
                        ,'max'=>10
                    )
                    ,array('comment'
                        ,'length'
                        ,'max'=>255
                    )
                    ,array('daterecord'
                        ,'safe'
                    )
                    ,array('id, projectstepid, signaturestepcurator, daterecord, comment, current_percent'
                        ,'safe'
                        ,'on'=>'search'
                    )
		);
	}

	public function relations()
	{
		return array(
                    'SmkProjectStep'=>array(self::BELONGS_TO, 'SmkProjectStep', 'projectstepid'),
                    'ServUsers'=>array(self::BELONGS_TO, 'ServUsers', 'signaturestepcurator'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'projectstepid' => 'Projectstepid',
			'signaturestepcurator' => 'Signaturestepcurator',
			'daterecord' => 'Дата записи',
			'comment' => 'Комментарии ответственного исполнителя',
			'current_percent' => 'Процент завершения этапа',
		);
	}

	public function search($array)
	{
		return new CArrayDataProvider($array, array(
			//'criteria'=>$criteria,
		));
	}
}