<?php
/* @var $this ReestrSystemNameController */
/* @var $model ReestrSystemName */

$this->breadcrumbs=array(
	'Reestr System Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrSystemName', 'url'=>array('index')),
	array('label'=>'Create ReestrSystemName', 'url'=>array('create')),
	array('label'=>'Update ReestrSystemName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrSystemName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrSystemName', 'url'=>array('admin')),
);
?>

<h1>View ReestrSystemName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'caption',
	),
)); ?>
