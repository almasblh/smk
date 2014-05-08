<?php
/* @var $this SmkReklamationController */
/* @var $model SmkReklamation */
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
		<?php echo $form->label($model,'problemname'); ?>
		<?php echo $form->textField($model,'problemname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datecreaterecord'); ?>
		<?php echo $form->textField($model,'datecreaterecord'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elementid'); ?>
		<?php echo $form->textField($model,'elementid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prunitid'); ?>
		<?php echo $form->textField($model,'prunitid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectid'); ?>
		<?php echo $form->textField($model,'projectid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->