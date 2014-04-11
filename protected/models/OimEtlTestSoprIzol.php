<?php

/**
 * This is the model class for table "oim_etl_test_sopr_izol".
 *
 * The followings are the available columns in table 'oim_etl_test_sopr_izol':
 * @property string $id
 * @property string $testsid
 * @property string $from_to
 * @property string $Urab
 * @property string $cableid
 * @property string $cablemark
 * @property string $l1_n
 * @property string $l2_n
 * @property string $l3_n
 * @property string $l1_pe
 * @property string $l2_pe
 * @property string $l3_pe
 * @property string $l1_l2
 * @property string $l1_l3
 * @property string $l2_l3
 * @property string $dateizm
 * @property string $signaturecreator
 *
 * The followings are the available model relations:
 * @property OimEtlTests $tests
 */
class OimEtlTestSoprIzol extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'oim_etl_test_sopr_izol';
	}

	public function rules()
	{
		return array(
			array('testsid, Urab, cableid, l1_n, l2_n, l3_n, l1_pe, l2_pe, l3_pe, l1_l2, l1_l3, l2_l3, signaturecreator', 'length', 'max'=>10),
			array('from_to', 'length', 'max'=>255),
			array('cablemark', 'length', 'max'=>50),
			array('dateizm', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, testsid, from_to, Urab, cableid, cablemark, l1_n, l2_n, l3_n, l1_pe, l2_pe, l3_pe, l1_l2, l1_l3, l2_l3, dateizm, signaturecreator', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'tests' => array(self::BELONGS_TO, 'OimEtlTests', 'testsid'),
                        'CableName' => array(self::BELONGS_TO, 'ReestrCableName', 'cableid'),
		);
	}

	public function attributeLabels()
	{
                return array(
			'id' => 'ID',
			'testsid' => 'Testsid',
                        'from_to' => 'от - до',
			'Urab' => 'Uраб,В',
			'cableid' => 'Марка кабеля',
			'cablemark' => 'Маркировка',
			'l1_n' => 'L1-N',
			'l2_n' => 'L2-N',
			'l3_n' => 'L3-N',
			'l1_pe' => 'L1-Pe',
			'l2_pe' => 'L2-Pe',
			'l3_pe' => 'L3-Pe',
			'l1_l2' => 'L1-L2',
			'l1_l3' => 'L1-L3',
			'l2_l3' => 'L2-L3',
			'dateizm' => 'Дата измерения',
			'signaturecreator' => 'Подпись',
		);
	}

	public function search($id=0)
	{
		$criteria=new CDbCriteria;

		if($id>0) $criteria->compare('id',$id,true);
		$criteria->compare('testsid',$this->testsid,true);
		$criteria->compare('from_to',$this->from_to,true);
		$criteria->compare('Urab',$this->Urab,true);
		$criteria->compare('cableid',$this->cableid,true);
		$criteria->compare('cablemark',$this->cablemark,true);
		$criteria->compare('l1_n',$this->l1_n,true);
		$criteria->compare('l2_n',$this->l2_n,true);
		$criteria->compare('l3_n',$this->l3_n,true);
		$criteria->compare('l1_pe',$this->l1_pe,true);
		$criteria->compare('l2_pe',$this->l2_pe,true);
		$criteria->compare('l3_pe',$this->l3_pe,true);
		$criteria->compare('l1_l2',$this->l1_l2,true);
		$criteria->compare('l1_l3',$this->l1_l3,true);
		$criteria->compare('l2_l3',$this->l2_l3,true);
		$criteria->compare('dateizm',$this->dateizm,true);
		$criteria->compare('signaturecreator',$this->signaturecreator,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}