<?php
/* @var $this ReestrAssemblageNameController */
/* @var $model ReestrAssemblageName */

$this->breadcrumbs=array(
	'Reestr Assemblage Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReestrAssemblageName', 'url'=>array('index')),
	array('label'=>'Create ReestrAssemblageName', 'url'=>array('create')),
	array('label'=>'Update ReestrAssemblageName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReestrAssemblageName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReestrAssemblageName', 'url'=>array('admin')),
);
?>

<h1>View ReestrAssemblageName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'caption',
	),
)); ?>
