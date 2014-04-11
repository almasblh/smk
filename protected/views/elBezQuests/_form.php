<?php
/* @var $this ElBezQuestsController */
/* @var $model ElBezQuests */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'el-bez-quests-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nticket'); ?>
		<?php echo $form->textField($model,'nticket',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'nticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nquest'); ?>
		<?php echo $form->textField($model,'nquest',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'nquest'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group'); ?>
		<?php echo $form->textField($model,'group',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->