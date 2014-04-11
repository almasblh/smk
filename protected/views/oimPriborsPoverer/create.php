<?php
        $form=$this->beginWidget('CActiveForm', array(
                                                    'id'=>'oim-pribors-poverer-form',
                                                    'enableAjaxValidation'=>false,
                                                    'htmlOptions'=>array(
                                                    'class'=>'form',
                                                )
        ));
            echo $this->renderPartial('_form', array('model'=>$model));
        $this->endWidget(); 
?>
