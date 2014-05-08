<?php
/* @var $this ServUsersDepartamentController */
/* @var $model ServUsersDepartament */

$this->breadcrumbs=array(
	'Serv Users Departaments'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ServUsersDepartament', 'url'=>array('index')),
	array('label'=>'Create ServUsersDepartament', 'url'=>array('create')),
	array('label'=>'Update ServUsersDepartament', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServUsersDepartament', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServUsersDepartament', 'url'=>array('admin')),
);
?>

<h1>View ServUsersDepartament #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
