<?php
/* @var $this ServUsersTabelController */
/* @var $data ServUsersTabel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::encode($data->userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestart')); ?>:</b>
	<?php echo CHtml::encode($data->timestart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestop')); ?>:</b>
	<?php echo CHtml::encode($data->timestop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nexttimeremamber')); ?>:</b>
	<?php echo CHtml::encode($data->nexttimeremamber); ?>
	<br />


</div>