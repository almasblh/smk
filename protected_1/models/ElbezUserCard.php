<?php
class ElbezUserCard extends CAssaRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'serv_users_elbez';
	}

	public function rules(){
            return array(
                array('id, userid, grup, dateinspection, ndocument, rating, typeinspection, exttypeinspection, nprotokol, lastgrup, lastdateinspection, lastrating, nextdateinspection, signatureusertest1, signatureusertest2, signatureusertest3, signatureusertest4, signatureusertest5, typepersonal, status',
                    'safe',
                //    'on'=>'search'
                ),
                array('userid, grup, typeinspection, status, typepersonal, signatureusertest1, signatureusertest2, signatureusertest3', 'required', 'on'=>'insert'),
                array('id, userid, grup, dateinspection, ndocument, rating, typeinspection, nprotokol, status', 'required', 'on'=>'update'),
                array('id, userid, ndocument, nprotokol, signatureusertest1, signatureusertest2, signatureusertest3, signatureusertest4, signatureusertest5', 'length', 'max'=>11),
                array('grup, lastgrup', 'length', 'max'=>2),
                array('rating, lastrating', 'length', 'max'=>1),
                array('typeinspection', 'length', 'max'=>24),
                array('exttypeinspection', 'length', 'max'=>255),
                array('typepersonal', 'length', 'max'=>35),

            );
	}

	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'ServUsers', 'userid'),
		);
	}

	public function getLastGgrup($data, $row, $grid){
            $a=(($data['lastgrup']%10)==0)?'до 1000В':'до и св. 1000В';
            $b=(int)($data['lastgrup']/10);
            return $b.'гр. '.$a.' ';
        }
        
        public function getGgrup($data, $row, $grid){
            $a=(($data['grup']%10)==0)?'до 1000В':'до и св. 1000В';
            $b=(int)($data['grup']/10);
            return $b.'гр. '.$a.' '.$data['typepersonal'].'персонал';
        }

	public function attributeLabels(){
            return array(
                'id' => 'ID',
                'userid' => 'Пользователь',
                'grup' => 'Группа',
                'dateinspection' => 'Дата текущей проверки',
                'ndocument' => '№ уд.',
                'rating' => 'Оценка',
                'typeinspection' => 'Вид проверки',
                'exttypeinspection' => 'Дополнение',
                'nprotokol' => '№ прот.',
                'lastgrup' => 'Предыд. гр.',
                'lastdateinspection' => 'Дата последней проверки',
                'lastrating' => 'Предыдущая оценка',
                'nextdateinspection' => 'Дата следующей проверки',
                'signatureusertest1' => 'Председатель комисии',
                'signatureusertest2' => '1-й член комиссии',
                'signatureusertest3' => '2-й член комиссии',
                'signatureusertest4' => '3-й член комиссии',
                'signatureusertest5' => '4-й член комиссии',
                'typepersonal' => 'Персонал',
                'status'=>'статус'
            );
	}

	public function search(){
            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id,true);
            $criteria->compare('userid',$this->userid);
            $criteria->compare('grup',$this->grup,true);
            $criteria->compare('dateinspection',$this->dateinspection,true);
            $criteria->compare('ndocument',$this->ndocument,true);
            $criteria->compare('rating',$this->rating,true);
            $criteria->compare('typeinspection',$this->typeinspection,true);
            $criteria->compare('exttypeinspection',$this->exttypeinspection,true);
            $criteria->compare('nprotokol',$this->nprotokol,true);
            $criteria->compare('lastgrup',$this->lastgrup,true);
            $criteria->compare('lastdateinspection',$this->lastdateinspection,true);
            $criteria->compare('lastrating',$this->lastrating,true);
            $criteria->compare('nextdateinspection',$this->nextdateinspection,true);
            $criteria->compare('signatureusertest1',$this->signatureusertest1,true);
            $criteria->compare('signatureusertest2',$this->signatureusertest2,true);
            $criteria->compare('signatureusertest3',$this->signatureusertest3,true);
            $criteria->compare('signatureusertest4',$this->signatureusertest4,true);
            $criteria->compare('signatureusertest5',$this->signatureusertest5,true);
            $criteria->compare('status',$this->status,true);
            $criteria->compare('typepersonal',$this->typepersonal,true);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array('pageSize'=>32),
            ));
	}
}