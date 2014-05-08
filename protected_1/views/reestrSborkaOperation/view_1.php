<?php
/* @var $this ReestrSborkaOperationController */
/* @var $model ReestrSborkaOperation */

$this->breadcrumbs=array(
	'Reestr Sborka Operations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrSborkaOperation', 'url'=>array('index')),
	array('label'=>'Create ReestrSborkaOperation', 'url'=>array('create')),
	array('label'=>'Update ReestrSborkaOperation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrSborkaOperation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrSborkaOperation', 'url'=>array('admin')),
);
?>

<h1>View ReestrSborkaOperation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'caption',
	),
)); ?>
