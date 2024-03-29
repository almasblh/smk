<?php

/**
 * This is the model class for table "defects_book_state".
 *
 * The followings are the available columns in table 'defects_book_state':
 * @property string $id
 * @property string $defectid
 * @property string $state
 * @property string $comment
 * @property string $date
 * @property string $signaturecreatorid
 * @property string $touserid
 *
 * The followings are the available model relations:
 * @property DefectsBook $defect
 */
class DefectsBookState extends CAssaRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DefectsBookState the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'defects_book_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('defectid, projectid, date, signaturecreatorid', 'required'),
			array('defectid, touserid, projectid', 'length', 'max'=>11),
			array('state', 'length', 'max'=>1),
			array('comment', 'length', 'max'=>255),
			array('signaturecreatorid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, defectid, state, comment, date, signaturecreatorid, touserid', 'safe', 'on'=>'search'),
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
			'defect' => array(self::BELONGS_TO, 'DefectsBook', 'defectid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'defectid' => 'Дефект',
			'state' => 'Состояние',
			'comment' => 'Коментарий',
			'date' => 'Дата',
			'signaturecreatorid' => 'Подпись',
			'touserid' => 'Перенаправлено',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($defectid)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('defectid',$defectid,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('signaturecreatorid',$this->signaturecreatorid,true);
		$criteria->compare('touserid',$this->touserid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public function getRowHtmlOptions($row, $data, $grid){
        switch($data->state){
            case 0:
                $R=0;$G=255;$B=0;
                break;
            case 1:
                $R=255;$G=200;$B=200;
                break;
            case 2:
                $R=255;$G=255;$B=128;
                break;
            case 3:
                $R=0;$G=255;$B=255;
                break;
            case 4:
                $R=255;$G=150;$B=150;
                break;
        }
        $R=str_pad(dechex($R), 2, "0", STR_PAD_LEFT);
        $G=str_pad(dechex($G), 2, "0", STR_PAD_LEFT);
        $B=str_pad(dechex($B), 2, "0", STR_PAD_LEFT);
        $value=array('style'=>'background-color:'."#$R$G$B");
        return $value;
    }
}