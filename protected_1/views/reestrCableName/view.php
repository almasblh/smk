<?php
/* @var $this ReestrCableNameController */
/* @var $model ReestrCableName */

$this->breadcrumbs=array(
	'Reestr Cable Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrCableName', 'url'=>array('index')),
	array('label'=>'Create ReestrCableName', 'url'=>array('create')),
	array('label'=>'Update ReestrCableName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrCableName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrCableName', 'url'=>array('admin')),
);
?>

<h1>View ReestrCableName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'conductors',
	),
)); ?>
