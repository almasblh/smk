<?php
/* @var $this ServUsersDepartamentController */
/* @var $model ServUsersDepartament */

$this->breadcrumbs=array(
	'Serv Users Departaments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServUsersDepartament', 'url'=>array('index')),
	array('label'=>'Manage ServUsersDepartament', 'url'=>array('admin')),
);
?>

<h1>Create ServUsersDepartament</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>