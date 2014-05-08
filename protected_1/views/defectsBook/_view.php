<?php
/* @var $this DefectsBookController */
/* @var $data DefectsBook */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectid')); ?>:</b>
	<?php echo CHtml::encode($data->projectid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('describe')); ?>:</b>
	<?php echo CHtml::encode($data->describe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mnemoid')); ?>:</b>
	<?php echo CHtml::encode($data->mnemoid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitid')); ?>:</b>
	<?php echo CHtml::encode($data->unitid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
	<?php echo CHtml::encode($data->priority); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defectvedomostid')); ?>:</b>
	<?php echo CHtml::encode($data->defectvedomostid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('autorid')); ?>:</b>
	<?php echo CHtml::encode($data->autorid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('laststate')); ?>:</b>
	<?php echo CHtml::encode($data->laststate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdate')); ?>:</b>
	<?php echo CHtml::encode($data->createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('touserid')); ?>:</b>
	<?php echo CHtml::encode($data->touserid); ?>
	<br />

	*/ ?>

</div>