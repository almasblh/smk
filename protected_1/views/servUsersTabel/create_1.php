<?php
/* @var $this ServUsersTabelController */
/* @var $model ServUsersTabel */

$this->breadcrumbs=array(
	'Serv Users Tabels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServUsersTabel', 'url'=>array('index')),
	array('label'=>'Manage ServUsersTabel', 'url'=>array('admin')),
);
?>

<h1>Create ServUsersTabel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>