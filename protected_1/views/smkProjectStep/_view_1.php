<?php
/* @var $this SmkProjectStepController */
/* @var $data SmkProjectStep */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectid')); ?>:</b>
	<?php echo CHtml::encode($data->projectid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stepid')); ?>:</b>
	<?php echo CHtml::encode($data->stepid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datestart')); ?>:</b>
	<?php echo CHtml::encode($data->datestart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datestop')); ?>:</b>
	<?php echo CHtml::encode($data->datestop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ncorrect')); ?>:</b>
	<?php echo CHtml::encode($data->ncorrect); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datestartfact')); ?>:</b>
	<?php echo CHtml::encode($data->datestartfact); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('datestopfact')); ?>:</b>
	<?php echo CHtml::encode($data->datestopfact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_persent')); ?>:</b>
	<?php echo CHtml::encode($data->current_persent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturemanager')); ?>:</b>
	<?php echo CHtml::encode($data->signaturemanager); ?>
	<br />

	*/ ?>

</div>