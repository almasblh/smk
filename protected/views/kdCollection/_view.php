<?php
/* @var $this KdCollectionController */
/* @var $data KdCollection */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectid')); ?>:</b>
	<?php echo CHtml::encode($data->projectid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('systemid')); ?>:</b>
	<?php echo CHtml::encode($data->systemid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitid')); ?>:</b>
	<?php echo CHtml::encode($data->unitid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refdes')); ?>:</b>
	<?php echo CHtml::encode($data->refdes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assemblegid')); ?>:</b>
	<?php echo CHtml::encode($data->assemblegid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ninassenblege')); ?>:</b>
	<?php echo CHtml::encode($data->ninassenblege); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elementid')); ?>:</b>
	<?php echo CHtml::encode($data->elementid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('part1id')); ?>:</b>
	<?php echo CHtml::encode($data->part1id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('part2id')); ?>:</b>
	<?php echo CHtml::encode($data->part2id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('part3id')); ?>:</b>
	<?php echo CHtml::encode($data->part3id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symbol')); ?>:</b>
	<?php echo CHtml::encode($data->symbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nominal')); ?>:</b>
	<?php echo CHtml::encode($data->nominal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chanelname')); ?>:</b>
	<?php echo CHtml::encode($data->chanelname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version')); ?>:</b>
	<?php echo CHtml::encode($data->version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actual')); ?>:</b>
	<?php echo CHtml::encode($data->actual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datecreate')); ?>:</b>
	<?php echo CHtml::encode($data->datecreate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturecreator')); ?>:</b>
	<?php echo CHtml::encode($data->signaturecreator); ?>
	<br />

	*/ ?>

</div>