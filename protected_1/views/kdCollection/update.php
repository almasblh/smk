<?php
/* @var $this KdCollectionController */
/* @var $model KdCollection */

$this->breadcrumbs=array(
	'Kd Collections'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KdCollection', 'url'=>array('index')),
	array('label'=>'Create KdCollection', 'url'=>array('create')),
	array('label'=>'View KdCollection', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage KdCollection', 'url'=>array('admin')),
);
?>

<h1>Update KdCollection <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>