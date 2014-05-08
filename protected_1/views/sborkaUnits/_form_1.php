<?php
/* @var $this SborkaUnitsController */
/* @var $model SborkaUnits */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sborka-units-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kdcolectionid'); ?>
		<?php echo $form->textField($model,'kdcolectionid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kdcolectionid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refdesid'); ?>
		<?php echo $form->textField($model,'refdesid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'refdesid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'partnom'); ?>
		<?php echo $form->textField($model,'partnom',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'partnom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sernum'); ?>
		<?php echo $form->textField($model,'sernum',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sernum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'operationid'); ?>
		<?php echo $form->textField($model,'operationid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'operationid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datecreate'); ?>
		<?php echo $form->textField($model,'datecreate'); ?>
		<?php echo $form->error($model,'datecreate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'signaturecreator'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->