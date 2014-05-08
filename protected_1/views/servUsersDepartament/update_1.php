<?php
/* @var $this ServUsersDepartamentController */
/* @var $model ServUsersDepartament */

$this->breadcrumbs=array(
	'Serv Users Departaments'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServUsersDepartament', 'url'=>array('index')),
	array('label'=>'Create ServUsersDepartament', 'url'=>array('create')),
	array('label'=>'View ServUsersDepartament', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServUsersDepartament', 'url'=>array('admin')),
);
?>

<h1>Update ServUsersDepartament <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>