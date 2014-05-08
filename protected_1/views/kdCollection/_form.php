<?php
/* @var $this KdCollectionController */
/* @var $model KdCollection */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kd-collection-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'projectid'); ?>
		<?php echo $form->textField($model,'projectid'); ?>
		<?php echo $form->error($model,'projectid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'systemid'); ?>
		<?php echo $form->textField($model,'systemid'); ?>
		<?php echo $form->error($model,'systemid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unitid'); ?>
		<?php echo $form->textField($model,'unitid'); ?>
		<?php echo $form->error($model,'unitid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refdes'); ?>
		<?php echo $form->textField($model,'refdes',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'refdes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assemblegid'); ?>
		<?php echo $form->textField($model,'assemblegid'); ?>
		<?php echo $form->error($model,'assemblegid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ninassenblege'); ?>
		<?php echo $form->textField($model,'ninassenblege'); ?>
		<?php echo $form->error($model,'ninassenblege'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elementid'); ?>
		<?php echo $form->textField($model,'elementid'); ?>
		<?php echo $form->error($model,'elementid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'part1id'); ?>
		<?php echo $form->textField($model,'part1id'); ?>
		<?php echo $form->error($model,'part1id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'part2id'); ?>
		<?php echo $form->textField($model,'part2id'); ?>
		<?php echo $form->error($model,'part2id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'part3id'); ?>
		<?php echo $form->textField($model,'part3id'); ?>
		<?php echo $form->error($model,'part3id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'symbol'); ?>
		<?php echo $form->textField($model,'symbol',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'symbol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nominal'); ?>
		<?php echo $form->textField($model,'nominal',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'nominal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chanelname'); ?>
		<?php echo $form->textField($model,'chanelname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'chanelname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version'); ?>
		<?php echo $form->textField($model,'version'); ?>
		<?php echo $form->error($model,'version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actual'); ?>
		<?php echo $form->textField($model,'actual'); ?>
		<?php echo $form->error($model,'actual'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datecreate'); ?>
		<?php echo $form->textField($model,'datecreate'); ?>
		<?php echo $form->error($model,'datecreate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signaturecreator'); ?>
		<?php echo $form->textField($model,'signaturecreator'); ?>
		<?php echo $form->error($model,'signaturecreator'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->