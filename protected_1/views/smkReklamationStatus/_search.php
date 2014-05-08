<?php
/* @var $this SmkReklamationStatusController */
/* @var $model SmkReklamationStatus */
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
		<?php echo $form->label($model,'reklamationid'); ?>
		<?php echo $form->textField($model,'reklamationid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusid'); ?>
		<?php echo $form->textField($model,'statusid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datecreationrecord'); ?>
		<?php echo $form->textField($model,'datecreationrecord'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestart'); ?>
		<?php echo $form->textField($model,'datestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestop'); ?>
		<?php echo $form->textField($model,'datestop'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->