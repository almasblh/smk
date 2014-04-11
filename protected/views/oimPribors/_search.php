<?php
/* @var $this OimPriborsController */
/* @var $model OimPribors */
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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descr'); ?>
		<?php echo $form->textField($model,'descr',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zavn'); ?>
		<?php echo $form->textField($model,'zavn',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passnom'); ?>
		<?php echo $form->textField($model,'passnom',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastpoverdate'); ?>
		<?php echo $form->textField($model,'lastpoverdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nextpoverdate'); ?>
		<?php echo $form->textField($model,'nextpoverdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wherenow'); ?>
		<?php echo $form->textField($model,'wherenow',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passpath'); ?>
		<?php echo $form->textField($model,'passpath'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->