<?php
/* @var $this DefectsBookController */
/* @var $model DefectsBook */

$this->breadcrumbs=array(
	'Defects Books'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DefectsBook', 'url'=>array('index')),
	array('label'=>'Create DefectsBook', 'url'=>array('create')),
	array('label'=>'Update DefectsBook', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DefectsBook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DefectsBook', 'url'=>array('admin')),
);
?>

<h1>View DefectsBook #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'projectid',
		'describe',
		'nmnemo',
		'priority',
		'categoryispolnitelid',
		'params',
	),
)); ?>
