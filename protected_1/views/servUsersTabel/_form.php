<?php
/* @var $this ServUsersTabelController */
/* @var $model ServUsersTabel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'serv-users-tabel-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php echo $form->textField($model,'userid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestart'); ?>
		<?php echo $form->textField($model,'timestart'); ?>
		<?php echo $form->error($model,'timestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestop'); ?>
		<?php echo $form->textField($model,'timestop'); ?>
		<?php echo $form->error($model,'timestop'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nexttimeremamber'); ?>
		<?php echo $form->textField($model,'nexttimeremamber'); ?>
		<?php echo $form->error($model,'nexttimeremamber'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->