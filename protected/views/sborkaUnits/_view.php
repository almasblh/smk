<?php
/* @var $this SborkaUnitsController */
/* @var $data SborkaUnits */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kdcolectionid')); ?>:</b>
	<?php echo CHtml::encode($data->kdcolectionid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refdesid')); ?>:</b>
	<?php echo CHtml::encode($data->refdesid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnom')); ?>:</b>
	<?php echo CHtml::encode($data->partnom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sernum')); ?>:</b>
	<?php echo CHtml::encode($data->sernum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('operationid')); ?>:</b>
	<?php echo CHtml::encode($data->operationid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datecreate')); ?>:</b>
	<?php echo CHtml::encode($data->datecreate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturecreator')); ?>:</b>
	<?php echo CHtml::encode($data->signaturecreator); ?>
	<br />

	*/ ?>

</div>