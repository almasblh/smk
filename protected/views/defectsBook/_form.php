<?php
/* @var $this DefectsBookController */
/* @var $model DefectsBook */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'defects-book-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'projectid'); ?>
		<?php echo $form->textField($model,'projectid',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'projectid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'describe'); ?>
		<?php echo $form->textArea($model,'describe',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'describe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nmnemo'); ?>
		<?php echo $form->textField($model,'nmnemo',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'nmnemo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority'); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categoryispolnitelid'); ?>
		<?php echo $form->textField($model,'categoryispolnitelid'); ?>
		<?php echo $form->error($model,'categoryispolnitelid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'params'); ?>
		<?php echo $form->textField($model,'params',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'params'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->