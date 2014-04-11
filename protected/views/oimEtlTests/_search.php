<?php
/* @var $this OimEtlTestsJurnalController */
/* @var $model OimEtlTestsJurnal */
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
		<?php echo $form->label($model,'num'); ?>
		<?php echo $form->textField($model,'num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'testid'); ?>
		<?php echo $form->textField($model,'testid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectid'); ?>
		<?php echo $form->textField($model,'projectid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datecreaterecord'); ?>
		<?php echo $form->textField($model,'datecreaterecord'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tester1id'); ?>
		<?php echo $form->textField($model,'tester1id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tester2id'); ?>
		<?php echo $form->textField($model,'tester2id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tester3id'); ?>
		<?php echo $form->textField($model,'tester3id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resume'); ?>
		<?php echo $form->textField($model,'resume'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->