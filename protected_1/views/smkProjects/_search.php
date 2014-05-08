<?php
    $form=$this->beginWidget('CActiveForm'
        , array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
        )
    );
?>
	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php   echo $form->textField($model,
                        'Name',
                        array('size'=>60,
                            'maxlength'=>255,
                            'onfocus'=>"this.value = 'assa'",
                    ));
                ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Npgvr'); ?>
		<?php echo $form->textField($model,'Npgvr',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dogovor'); ?>
		<?php echo $form->textField($model,'dogovor',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Works'); ?>
		<?php echo $form->textField($model,'Works',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer'); ?>
		<?php echo $form->textField($model,'customer',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'object'); ?>
		<?php echo $form->textField($model,'object',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->