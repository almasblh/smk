<?php
/* @var $this ServUsersTabelController */
/* @var $model ServUsersTabel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userid'); ?>
		<?php echo $form->textField($model,'userid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestart'); ?>
		<?php echo $form->textField($model,'timestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestop'); ?>
		<?php echo $form->textField($model,'timestop'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nexttimeremamber'); ?>
		<?php echo $form->textField($model,'nexttimeremamber'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->