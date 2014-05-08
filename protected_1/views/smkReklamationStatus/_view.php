<?php
/* @var $this SmkReklamationStatusController */
/* @var $data SmkReklamationStatus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reklamationid')); ?>:</b>
	<?php echo CHtml::encode($data->reklamationid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusid')); ?>:</b>
	<?php echo CHtml::encode($data->statusid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturecreator')); ?>:</b>
	<?php echo CHtml::encode($data->signaturecreator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datecreationrecord')); ?>:</b>
	<?php echo CHtml::encode($data->datecreationrecord); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datestart')); ?>:</b>
	<?php echo CHtml::encode($data->datestart); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('datestop')); ?>:</b>
	<?php echo CHtml::encode($data->datestop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsibleuserid')); ?>:</b>
	<?php echo CHtml::encode($data->responsibleuserid); ?>
	<br />

	*/ ?>

</div>