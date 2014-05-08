<?php
/* @var $this ServUsersCategoryController */
/* @var $model ServUsersCategory */

$this->breadcrumbs=array(
	'Serv Users Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServUsersCategory', 'url'=>array('index')),
	array('label'=>'Create ServUsersCategory', 'url'=>array('create')),
	array('label'=>'View ServUsersCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServUsersCategory', 'url'=>array('admin')),
);
?>

<h1>Update ServUsersCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>