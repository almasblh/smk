<?php
/* @var $this SborkaUnitsController */
/* @var $model SborkaUnits */
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
		<?php echo $form->label($model,'kdcolectionid'); ?>
		<?php echo $form->textField($model,'kdcolectionid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refdesid'); ?>
		<?php echo $form->textField($model,'refdesid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'partnom'); ?>
		<?php echo $form->textField($model,'partnom',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sernum'); ?>
		<?php echo $form->textField($model,'sernum',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operationid'); ?>
		<?php echo $form->textField($model,'operationid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datecreate'); ?>
		<?php echo $form->textField($model,'datecreate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->