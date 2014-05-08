<?php
/* @var $this SborkaUnitsController */
/* @var $model SborkaUnits */

$this->breadcrumbs=array(
	'Sborka Units'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SborkaUnits', 'url'=>array('index')),
	array('label'=>'Create SborkaUnits', 'url'=>array('create')),
	array('label'=>'View SborkaUnits', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SborkaUnits', 'url'=>array('admin')),
);
?>

<h1>Update SborkaUnits <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>