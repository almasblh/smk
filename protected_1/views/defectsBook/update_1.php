<?php
/* @var $this DefectsBookController */
/* @var $model DefectsBook */

$this->breadcrumbs=array(
	'Defects Books'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DefectsBook', 'url'=>array('index')),
	array('label'=>'Create DefectsBook', 'url'=>array('create')),
	array('label'=>'View DefectsBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DefectsBook', 'url'=>array('admin')),
);
?>

<h1>Update DefectsBook <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>