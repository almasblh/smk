<?php
/* @var $this OimPriborsController */
/* @var $model OimPribors */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oim-pribors-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' =>array('enctype'=>'multipart/form-data' ) // говорим что форма может работать с файлами
)); ?>

	<p class="note">Поля, обозначенные <span class="required">*</span>, обязятельны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descr'); ?>
		<?php echo $form->textField($model,'descr',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'descr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zavn'); ?>
		<?php echo $form->textField($model,'zavn',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'zavn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passnom'); ?>
		<?php echo $form->textField($model,'passnom',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'passnom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wherenow'); ?>
		<?php //echo $form->textField($model,'wherenow',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->listBox($model,'wherenow',
                        array(  '0'=>'Списан',
                                '1'=>'На складе',
                                '2'=>'В поверке',
                                '3'=>'На руках',
                               )
                        ); ?>
		<?php echo $form->error($model,'wherenow'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passpath'); ?>
		<?php echo $form->textField($model,'passpath'); ?>
		<?php echo $form->error($model,'passpath'); ?>
                или выберите новый файл 
		<?php echo $form->fileField($model,'newpassport'); ?>
		<?php echo $form->error($model,'newpassport'); ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->