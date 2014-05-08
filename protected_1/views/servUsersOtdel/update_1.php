<?php
/* @var $this ServUsersOtdelController */
/* @var $model ServUsersOtdel */

$this->breadcrumbs=array(
	'Serv Users Otdels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServUsersOtdel', 'url'=>array('index')),
	array('label'=>'Create ServUsersOtdel', 'url'=>array('create')),
	array('label'=>'View ServUsersOtdel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServUsersOtdel', 'url'=>array('admin')),
);
?>

<h1>Update ServUsersOtdel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>