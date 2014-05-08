<?php
/* @var $this DefectsBookStateController */
/* @var $model DefectsBookState */

$this->breadcrumbs=array(
	'Defects Book States'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DefectsBookState', 'url'=>array('index')),
	array('label'=>'Create DefectsBookState', 'url'=>array('create')),
	array('label'=>'Update DefectsBookState', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DefectsBookState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DefectsBookState', 'url'=>array('admin')),
);
?>

<h1>View DefectsBookState #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'defectid',
		'state',
		'comment',
		'date',
		'signaturecreatorid',
		'touserid',
	),
)); ?>
