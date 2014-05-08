<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smk-project-stepcurator-jurnal-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'comment');
                    echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255));
                    echo $form->error($model,'comment');
                ?>
	</div>

	<div class="row">
		<?php 
                    echo $form->labelEx($model,'current_percent');
                    echo $form->textField($model,'current_percent');
                    echo $form->error($model,'current_percent');
                ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->