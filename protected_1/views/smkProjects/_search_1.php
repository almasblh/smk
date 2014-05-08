<div class="wide form">

<?php
    $form=$this->beginWidget('CActiveForm'
        , array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
        )
    );
?>
	<div class="row">
		<?php 
                    echo $form->label($model,'ncorrect');
                    //echo $form->textField($model,'ncorrect',array('size'=>10,'maxlength'=>255));
                    echo CHtml::dropDownList('ncorrect','1',$model->listKorrection,array('size'=>1));
                    echo CHtml::submitButton('Применить');
                ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->