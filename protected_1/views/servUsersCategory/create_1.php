<?php
/* @var $this ServUsersCategoryController */
/* @var $model ServUsersCategory */

$this->breadcrumbs=array(
	'Serv Users Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServUsersCategory', 'url'=>array('index')),
	array('label'=>'Manage ServUsersCategory', 'url'=>array('admin')),
);
?>

<h1>Create ServUsersCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>