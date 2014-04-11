<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $model OimEtlTestSoprIzol */
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
		<?php echo $form->label($model,'testsid'); ?>
		<?php echo $form->textField($model,'testsid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'from_to'); ?>
		<?php echo $form->textField($model,'from_to',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Urab'); ?>
		<?php echo $form->textField($model,'Urab',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cableid'); ?>
		<?php echo $form->textField($model,'cableid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cablemark'); ?>
		<?php echo $form->textField($model,'cablemark',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l1_n'); ?>
		<?php echo $form->textField($model,'l1_n',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l2_n'); ?>
		<?php echo $form->textField($model,'l2_n',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l3_n'); ?>
		<?php echo $form->textField($model,'l3_n',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l1_pe'); ?>
		<?php echo $form->textField($model,'l1_pe',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l2_pe'); ?>
		<?php echo $form->textField($model,'l2_pe',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l3_pe'); ?>
		<?php echo $form->textField($model,'l3_pe',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l1_l2'); ?>
		<?php echo $form->textField($model,'l1_l2',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l1_l3'); ?>
		<?php echo $form->textField($model,'l1_l3',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'l2_l3'); ?>
		<?php echo $form->textField($model,'l2_l3',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateizm'); ?>
		<?php echo $form->textField($model,'dateizm'); ?>
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