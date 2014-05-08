<?php
/* @var $this ElementsController */
/* @var $data Elements */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caption')); ?>:</b>
	<?php echo CHtml::encode($data->caption); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_n')); ?>:</b>
	<?php echo CHtml::encode($data->p_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manufactureid')); ?>:</b>
	<?php echo CHtml::encode($data->manufactureid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referens')); ?>:</b>
	<?php echo CHtml::encode($data->referens); ?>
	<br />


</div>