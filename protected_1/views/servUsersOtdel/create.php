<?php
/* @var $this ServUsersOtdelController */
/* @var $model ServUsersOtdel */

$this->breadcrumbs=array(
	'Serv Users Otdels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServUsersOtdel', 'url'=>array('index')),
	array('label'=>'Manage ServUsersOtdel', 'url'=>array('admin')),
);
?>

<h1>Create ServUsersOtdel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>