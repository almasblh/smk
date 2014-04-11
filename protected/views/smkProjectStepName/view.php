<?php
/* @var $this SmkProjectStepNameController */
/* @var $model SmkProjectStepName */

$this->breadcrumbs=array(
	'Smk Project Step Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SmkProjectStepName', 'url'=>array('index')),
	array('label'=>'Create SmkProjectStepName', 'url'=>array('create')),
	array('label'=>'Update SmkProjectStepName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SmkProjectStepName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SmkProjectStepName', 'url'=>array('admin')),
);
?>

<h1>View SmkProjectStepName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
