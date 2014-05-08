<?php
class TmpPE extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName()
    {
            return 'tmp_PE';
    }

    public function rules(){
        return array(
            //array('pos_str', 'length', 'max'=>50),
            //array('count_int', 'length', 'max'=>10),
            array('id, pos_str, element_str, manufacture_str, count_int'
                , 'safe'
                //, 'on'=>'search'
            ),
        );
    }

    public function relations()
    {
            return array(
            );
    }

    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'pos_str' => 'Поз. обозн.',
                    'element_str' => 'Наименование',
                    'manufacture_str' => 'Производитель',
                    'count_int' => 'Кол.',
            );
    }

    public function search(){
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('pos_str',$this->pos_str,true);
        $criteria->compare('element_str',$this->element_str,true);
        $criteria->compare('manufacture_str',$this->manufacture_str,true);
        //$criteria->compare('count_int',$this->count_int,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>32)
        ));
    }
}