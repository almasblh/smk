<?php
/* @var $this ServUsersTabelController */
/* @var $model ServUsersTabel */

$this->breadcrumbs=array(
	'Serv Users Tabels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServUsersTabel', 'url'=>array('index')),
	array('label'=>'Create ServUsersTabel', 'url'=>array('create')),
	array('label'=>'View ServUsersTabel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServUsersTabel', 'url'=>array('admin')),
);
?>

<h1>Update ServUsersTabel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>