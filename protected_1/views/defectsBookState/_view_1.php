<?php
/* @var $this DefectsBookStateController */
/* @var $data DefectsBookState */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defectid')); ?>:</b>
	<?php echo CHtml::encode($data->defectid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturecreatorid')); ?>:</b>
	<?php echo CHtml::encode($data->signaturecreatorid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('touserid')); ?>:</b>
	<?php echo CHtml::encode($data->touserid); ?>
	<br />


</div>