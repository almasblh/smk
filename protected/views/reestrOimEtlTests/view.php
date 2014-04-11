<?php
/* @var $this ReestrOimEtlTestsController */
/* @var $model ReestrOimEtlTests */

$this->breadcrumbs=array(
	'Reestr Oim Etl Tests'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrOimEtlTests', 'url'=>array('index')),
	array('label'=>'Create ReestrOimEtlTests', 'url'=>array('create')),
	array('label'=>'Update ReestrOimEtlTests', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrOimEtlTests', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrOimEtlTests', 'url'=>array('admin')),
);
?>

<h1>View ReestrOimEtlTests #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'shablonid',
	),
)); ?>
