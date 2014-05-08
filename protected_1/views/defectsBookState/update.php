<?php
/* @var $this DefectsBookStateController */
/* @var $model DefectsBookState */

$this->breadcrumbs=array(
	'Defects Book States'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DefectsBookState', 'url'=>array('index')),
	array('label'=>'Create DefectsBookState', 'url'=>array('create')),
	array('label'=>'View DefectsBookState', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DefectsBookState', 'url'=>array('admin')),
);
?>

<h1>Update DefectsBookState <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>