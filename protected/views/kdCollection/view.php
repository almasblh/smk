<?php
/* @var $this KdCollectionController */
/* @var $model KdCollection */

$this->breadcrumbs=array(
	'Kd Collections'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List KdCollection', 'url'=>array('index')),
	array('label'=>'Create KdCollection', 'url'=>array('create')),
	array('label'=>'Update KdCollection', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete KdCollection', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KdCollection', 'url'=>array('admin')),
);
?>

<h1>View KdCollection #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'projectid',
		'systemid',
		'unitid',
		'refdes',
		'type',
		'assemblegid',
		'ninassenblege',
		'elementid',
		'part1id',
		'part2id',
		'part3id',
		'symbol',
		'note',
		'nominal',
		'chanelname',
		'version',
		'actual',
		'datecreate',
		'signaturecreator',
	),
)); ?>
