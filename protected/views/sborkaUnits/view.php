<?php
/* @var $this SborkaUnitsController */
/* @var $model SborkaUnits */

$this->breadcrumbs=array(
	'Sborka Units'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SborkaUnits', 'url'=>array('index')),
	array('label'=>'Create SborkaUnits', 'url'=>array('create')),
	array('label'=>'Update SborkaUnits', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SborkaUnits', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SborkaUnits', 'url'=>array('admin')),
);
?>

<h1>View SborkaUnits #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kdcolectionid',
		'refdesid',
		'partnom',
		'sernum',
		'operationid',
		'datecreate',
		'signaturecreator',
	),
)); ?>
