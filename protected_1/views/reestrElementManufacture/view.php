<?php
/* @var $this ReestrElementManufactureController */
/* @var $model ReestrElementManufacture */

$this->breadcrumbs=array(
	'Reestr Element Manufactures'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrElementManufacture', 'url'=>array('index')),
	array('label'=>'Create ReestrElementManufacture', 'url'=>array('create')),
	array('label'=>'Update ReestrElementManufacture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrElementManufacture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrElementManufacture', 'url'=>array('admin')),
);
?>

<h1>View ReestrElementManufacture #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'tel',
		'address',
		'caption',
	),
)); ?>
