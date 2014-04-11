<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $model OimEtlTestSoprIzol */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oim-etl-test-sopr-izol-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'testsid'); ?>
		<?php echo $form->textField($model,'testsid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'testsid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_to'); ?>
		<?php echo $form->textField($model,'from_to',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'from_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Urab'); ?>
		<?php echo $form->textField($model,'Urab',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Urab'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cableid'); ?>
		<?php echo $form->textField($model,'cableid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cableid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cablemark'); ?>
		<?php echo $form->textField($model,'cablemark',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cablemark'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l1_n'); ?>
		<?php echo $form->textField($model,'l1_n',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l1_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l2_n'); ?>
		<?php echo $form->textField($model,'l2_n',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l2_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l3_n'); ?>
		<?php echo $form->textField($model,'l3_n',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l3_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l1_pe'); ?>
		<?php echo $form->textField($model,'l1_pe',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l1_pe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l2_pe'); ?>
		<?php echo $form->textField($model,'l2_pe',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l2_pe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l3_pe'); ?>
		<?php echo $form->textField($model,'l3_pe',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l3_pe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l1_l2'); ?>
		<?php echo $form->textField($model,'l1_l2',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l1_l2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l1_l3'); ?>
		<?php echo $form->textField($model,'l1_l3',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l1_l3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'l2_l3'); ?>
		<?php echo $form->textField($model,'l2_l3',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'l2_l3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateizm'); ?>
		<?php echo $form->textField($model,'dateizm'); ?>
		<?php echo $form->error($model,'dateizm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'signaturecreator'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->