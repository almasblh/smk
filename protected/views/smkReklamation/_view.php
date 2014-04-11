<?php
/* @var $this SmkReklamationController */
/* @var $data SmkReklamation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('problemname')); ?>:</b>
	<?php echo CHtml::encode($data->problemname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturecreator')); ?>:</b>
	<?php echo CHtml::encode($data->signaturecreator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datecreaterecord')); ?>:</b>
	<?php echo CHtml::encode($data->datecreaterecord); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elementid')); ?>:</b>
	<?php echo CHtml::encode($data->elementid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectid')); ?>:</b>
	<?php echo CHtml::encode($data->projectid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prunitid')); ?>:</b>
	<?php echo CHtml::encode($data->prunitid); ?>
	<br />


</div>