<?php
/* @var $this SmkProjectStepcuratorJurnalController */
/* @var $model SmkProjectStepcuratorJurnal */

$this->breadcrumbs=array(
	'Smk Project Stepcurator Jurnals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SmkProjectStepcuratorJurnal', 'url'=>array('index')),
	array('label'=>'Create SmkProjectStepcuratorJurnal', 'url'=>array('create')),
	array('label'=>'View SmkProjectStepcuratorJurnal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SmkProjectStepcuratorJurnal', 'url'=>array('admin')),
);
?>

<h1>Update SmkProjectStepcuratorJurnal <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>