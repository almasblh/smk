<?php
class DatesStartStopValidator extends CValidator
{
    public $DateStart=0;
    public $DateStop=0;
    
    protected function validateAttribute($object,$attribute){
        $value=$object->$attribute;
        if(getdate(strtotime($value))[0]-getdate(strtotime($this->DateStart))[0]<0){
            $error='Дата начала этапа не может быть позже даты окончания этапа. Вернитесь и введите корректные данные';
            $this->addError($object,$attribute,$error);
        }
    }
}
?>
