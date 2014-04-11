<?php
/* @var $this ReestrUnitNameController */
/* @var $model ReestrUnitName */

$this->breadcrumbs=array(
	'Reestr Unit Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrUnitName', 'url'=>array('index')),
	array('label'=>'Create ReestrUnitName', 'url'=>array('create')),
	array('label'=>'View ReestrUnitName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrUnitName', 'url'=>array('admin')),
);
?>

<h1>Update ReestrUnitName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>