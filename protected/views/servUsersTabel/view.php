<?php
/* @var $this ServUsersTabelController */
/* @var $model ServUsersTabel */

$this->breadcrumbs=array(
	'Serv Users Tabels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServUsersTabel', 'url'=>array('index')),
	array('label'=>'Create ServUsersTabel', 'url'=>array('create')),
	array('label'=>'Update ServUsersTabel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServUsersTabel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServUsersTabel', 'url'=>array('admin')),
);
?>

<h1>View ServUsersTabel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userid',
		'date',
		'timestart',
		'timestop',
		'nexttimeremamber',
	),
)); ?>
