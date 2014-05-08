<?php
/* @var $this SmkProjectStepcuratorJurnalController */
/* @var $data SmkProjectStepcuratorJurnal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectstepid')); ?>:</b>
	<?php echo CHtml::encode($data->projectstepid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signaturestepcurator')); ?>:</b>
	<?php echo CHtml::encode($data->signaturestepcurator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('daterecord')); ?>:</b>
	<?php echo CHtml::encode($data->daterecord); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_percent')); ?>:</b>
	<?php echo CHtml::encode($data->current_percent); ?>
	<br />


</div>