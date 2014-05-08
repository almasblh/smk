<?php
/* @var $this SmkProjectStepcuratorJurnalController */
/* @var $model SmkProjectStepcuratorJurnal */

$this->breadcrumbs=array(
	'Smk Project Stepcurator Jurnals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SmkProjectStepcuratorJurnal', 'url'=>array('index')),
	array('label'=>'Create SmkProjectStepcuratorJurnal', 'url'=>array('create')),
	array('label'=>'Update SmkProjectStepcuratorJurnal', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SmkProjectStepcuratorJurnal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SmkProjectStepcuratorJurnal', 'url'=>array('admin')),
);
?>

<h1>View SmkProjectStepcuratorJurnal #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'projectstepid',
		'signaturestepcurator',
		'daterecord',
		'comment',
		'current_percent',
	),
)); ?>
