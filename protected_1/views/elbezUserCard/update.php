<?php
/* @var $this ElbezUserCardController */
/* @var $model ElbezUserCard */

$this->breadcrumbs=array(
	'Elbez User Cards'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ElbezUserCard', 'url'=>array('index')),
	array('label'=>'Create ElbezUserCard', 'url'=>array('create')),
	array('label'=>'View ElbezUserCard', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ElbezUserCard', 'url'=>array('admin')),
);
?>

<h1>Update ElbezUserCard <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>