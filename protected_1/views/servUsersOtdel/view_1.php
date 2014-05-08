<?php
/* @var $this ServUsersOtdelController */
/* @var $model ServUsersOtdel */

$this->breadcrumbs=array(
	'Serv Users Otdels'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ServUsersOtdel', 'url'=>array('index')),
	array('label'=>'Create ServUsersOtdel', 'url'=>array('create')),
	array('label'=>'Update ServUsersOtdel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServUsersOtdel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServUsersOtdel', 'url'=>array('admin')),
);
?>

<h1>View ServUsersOtdel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
