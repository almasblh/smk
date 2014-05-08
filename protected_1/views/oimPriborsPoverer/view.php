<?php
/* @var $this OimPriborsPovererController */
/* @var $model OimPriborsPoverer */

$this->breadcrumbs=array(
	'Oim Pribors Poverers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List OimPriborsPoverer', 'url'=>array('index')),
	array('label'=>'Create OimPriborsPoverer', 'url'=>array('create')),
	array('label'=>'Update OimPriborsPoverer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OimPriborsPoverer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OimPriborsPoverer', 'url'=>array('admin')),
);
?>

<h1>View OimPriborsPoverer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
