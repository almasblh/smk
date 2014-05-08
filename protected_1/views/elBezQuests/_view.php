<?php
/* @var $this ElBezQuestsController */
/* @var $data ElBezQuests */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nticket')); ?>:</b>
	<?php echo CHtml::encode($data->nticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nquest')); ?>:</b>
	<?php echo CHtml::encode($data->nquest); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group')); ?>:</b>
	<?php echo CHtml::encode($data->group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>