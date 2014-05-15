<?php

class ServUsers extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'serv_users';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fname, sname, tname, departamentid, dolgnostid, category', 'required'),
			array('departamentid, dolgnostid, category, active', 'numerical', 'integerOnly'=>true),
			array('fname, sname, tname', 'length', 'max'=>32),
			array('pass', 'length', 'max'=>41),

			array('id, fname, sname, tname, pass, departamentid, dolgnostid, category, active, email', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
            return array(
                'ServUsersCategory' => array(self::BELONGS_TO, 'ServUsersCategory', 'category'),
                'ServUsersDepartament' => array(self::BELONGS_TO, 'ServUsersDepartament', 'departamentid'),
                'ServUsersDolgnost' => array(self::BELONGS_TO, 'ServUsersDolgnost', 'dolgnostid'),
                'Categories'=>array(self::MANY_MANY, 'Categories', 'serv_cat_user(catid, srv_userid)'), 
            );
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fname' => 'Фамилия',
			'sname' => 'Имя',
			'tname' => 'Отчество',
			'pass' => 'Пароль',
			'ServUsersDepartament.name' => 'Департамент',
			'ServUsersDolgnost.name' => 'Должность',
			'ServUsersCategory.name' => 'Категория',
			'active' => 'Активность',
                        'email' =>'E-mail'
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('category',$this->category);
                if(isset($_GET['Departament'])) $criteria->compare('ServUsersDepartament.name',$_GET['Departament']);
                if(isset($_GET['Dolgnostt'])) $criteria->compare('ServUsersDolgnostt.name',$_GET['Dolgnostt']);
                if(isset($_GET['Category'])) $criteria->compare('ServUsersCategory.name',$_GET['Category']);
                $criteria->compare('active',true);
                $criteria->with=array('ServUsersDepartament','ServUsersCategory','ServUsersDolgnost');
                return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize' => Yii::app()->params['postsPerPage']),
                        'sort'=>array('attributes'=>array(
                            'fname'=>array(
                                'asc' => $expr='fname',
                                'desc' => $expr.' DESC',
                            ),
                            'sname'=>array(
                                'asc' => $expr='sname',
                                'desc' => $expr.' DESC',
                            ),
                            'tname'=>array(
                                'asc' => $expr='tname',
                                'desc' => $expr.' DESC',
                            ),
                            'Dolgnost'=>array(
                                'asc' => $expr='ServUsersDolgnost.name',
                                'desc' => $expr.' DESC',
                            ),
                            'Category'=>array(
                                'asc' => $expr='ServUsersCategory.name',
                                'desc' => $expr.' DESC',
                            ),
                            'Departament'=>array(
                                'asc' => $expr='ServUsersDepartament.name',
                                'desc' => $expr.' DESC',
                            ),
                        ))
		));
	}
    public function getFIO(){
        $str=$this->fname.' '.$this->sname.' '.$this->tname;
        return $str;
    }
}