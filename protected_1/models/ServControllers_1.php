<?php
class ServControllers extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'serv_controllers';
	}

	public function rules()
	{
		return array(
			array('name, caption', 'length', 'max'=>255),
			//array('parrentcontrollerid', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, caption', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
            return array(
            );
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя контролллера',
			'caption' => 'Caption',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('caption',$this->caption,true);
		//$criteria->compare('parrentcontrollerid',$this->parrentcontrollerid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getNameExt(){
        $ret=$this->name;
        if(isset($this->caption) && $this->caption<>'') $ret.=' - ('.$this->caption.')';
        return $ret;  
    }        

}