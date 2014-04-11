<?php
/* @var $this OimPriborsController */
/* @var $model OimPribors */

$this->breadcrumbs=array(
	'Oim Pribors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List OimPribors', 'url'=>array('index')),
	array('label'=>'Create OimPribors', 'url'=>array('create')),
	array('label'=>'Update OimPribors', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OimPribors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OimPribors', 'url'=>array('admin')),
);
?>

<h1>View OimPribors #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'descr',
		'zavn',
		'passnom',
		'lastpoverdate',
		'nextpoverdate',
		'wherenow',
		'passpath',
	),
)); ?>
