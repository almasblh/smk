<?php
class ServUsersCategory extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public function tableName()
	{
		return 'serv_users_category';
	}

        public function rules()
	{
		return array(
			array('id, name', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
            return array(
                'ServUsers'=>array(self::HAS_MANY, 'ServUsers', 'id'),
                'Categories'=>array(self::MANY_MANY, 'Categories', 'serv_cat_cat(catid, srv_userid)'), 
            );
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}