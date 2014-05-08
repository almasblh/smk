<?php
/* @var $this SborkaUnitsController */
/* @var $model SborkaUnits */

$this->breadcrumbs=array(
	'Sborka Units'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SborkaUnits', 'url'=>array('index')),
	array('label'=>'Manage SborkaUnits', 'url'=>array('admin')),
);
?>

<h1>Create SborkaUnits</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>