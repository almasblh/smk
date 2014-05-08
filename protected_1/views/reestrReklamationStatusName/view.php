<?php
/* @var $this ReestrReklamationStatusNameController */
/* @var $model ReestrReklamationStatusName */

$this->breadcrumbs=array(
	'Reestr Reklamation Status Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrReklamationStatusName', 'url'=>array('index')),
	array('label'=>'Create ReestrReklamationStatusName', 'url'=>array('create')),
	array('label'=>'Update ReestrReklamationStatusName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrReklamationStatusName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrReklamationStatusName', 'url'=>array('admin')),
);
?>

<h1>View ReestrReklamationStatusName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
