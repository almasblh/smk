<?php
/* @var $this KdCollectionController */
/* @var $model KdCollection */

$this->breadcrumbs=array(
	'Kd Collections'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KdCollection', 'url'=>array('index')),
	array('label'=>'Manage KdCollection', 'url'=>array('admin')),
);
?>

<h1>Create KdCollection</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>