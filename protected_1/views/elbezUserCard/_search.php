<?php
/* @var $this ElbezUserCardController */
/* @var $model ElbezUserCard */
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
		<?php echo $form->label($model,'userid'); ?>
		<?php echo $form->textField($model,'userid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'grup'); ?>
		<?php echo $form->textField($model,'grup',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateinspection'); ?>
		<?php echo $form->textField($model,'dateinspection'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ndocument'); ?>
		<?php echo $form->textField($model,'ndocument',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rating'); ?>
		<?php echo $form->textField($model,'rating',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'typeinspection'); ?>
		<?php echo $form->textField($model,'typeinspection',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exttypeinspection'); ?>
		<?php echo $form->textField($model,'exttypeinspection',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nprotokol'); ?>
		<?php echo $form->textField($model,'nprotokol',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastgrup'); ?>
		<?php echo $form->textField($model,'lastgrup',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastdateinspection'); ?>
		<?php echo $form->textField($model,'lastdateinspection'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastrating'); ?>
		<?php echo $form->textField($model,'lastrating',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nextdateinspection'); ?>
		<?php echo $form->textField($model,'nextdateinspection'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signatureusertest1'); ?>
		<?php echo $form->textField($model,'signatureusertest1',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signatureusertest2'); ?>
		<?php echo $form->textField($model,'signatureusertest2',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signatureusertest3'); ?>
		<?php echo $form->textField($model,'signatureusertest3',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signatureusertest4'); ?>
		<?php echo $form->textField($model,'signatureusertest4',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signatureusertest5'); ?>
		<?php echo $form->textField($model,'signatureusertest5',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'typepersonal'); ?>
		<?php echo $form->textField($model,'typepersonal',array('size'=>35,'maxlength'=>35)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->