<?php
/* @var $this SmkReklamationStatusController */
/* @var $model SmkReklamationStatus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smk-reklamation-status-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'reklamationid'); ?>
		<?php echo $form->textField($model,'reklamationid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'reklamationid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'statusid'); ?>
		<?php echo $form->textField($model,'statusid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'statusid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'signaturecreator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datecreationrecord'); ?>
		<?php echo $form->textField($model,'datecreationrecord'); ?>
		<?php echo $form->error($model,'datecreationrecord'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datestart'); ?>
		<?php echo $form->textField($model,'datestart'); ?>
		<?php echo $form->error($model,'datestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datestop'); ?>
		<?php echo $form->textField($model,'datestop'); ?>
		<?php echo $form->error($model,'datestop'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'responsibleuserid1'); ?>
		<?php echo $form->textField($model,'responsibleuserid1'); ?>
		<?php echo $form->error($model,'responsibleuserid1'); ?>
	</div>
        
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->