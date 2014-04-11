<?php
/* @var $this ReestrUnitNameController */
/* @var $model ReestrUnitName */

$this->breadcrumbs=array(
	'Reestr Unit Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrUnitName', 'url'=>array('index')),
	array('label'=>'Create ReestrUnitName', 'url'=>array('create')),
	array('label'=>'Update ReestrUnitName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrUnitName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrUnitName', 'url'=>array('admin')),
);
?>

<h1>View ReestrUnitName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'caption',
	),
)); ?>
