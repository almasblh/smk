<?php
/* @var $this ServUsersCategoryController */
/* @var $model ServUsersCategory */

$this->breadcrumbs=array(
	'Serv Users Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ServUsersCategory', 'url'=>array('index')),
	array('label'=>'Create ServUsersCategory', 'url'=>array('create')),
	array('label'=>'Update ServUsersCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServUsersCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServUsersCategory', 'url'=>array('admin')),
);
?>

<h1>View ServUsersCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
