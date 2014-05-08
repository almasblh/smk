<?php
/* @var $this SmkProjectStepController */
/* @var $model SmkProjectStep */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectid'); ?>
		<?php echo $form->textField($model,'projectid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stepid'); ?>
		<?php echo $form->textField($model,'stepid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestart'); ?>
		<?php echo $form->textField($model,'datestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestop'); ?>
		<?php echo $form->textField($model,'datestop'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ncorrect'); ?>
		<?php echo $form->textField($model,'ncorrect',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestartfact'); ?>
		<?php echo $form->textField($model,'datestartfact'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestopfact'); ?>
		<?php echo $form->textField($model,'datestopfact'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_persent'); ?>
		<?php echo $form->textField($model,'current_persent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signaturemanager'); ?>
		<?php echo $form->textField($model,'signaturemanager',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->