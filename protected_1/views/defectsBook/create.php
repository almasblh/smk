<?php
/* @var $this DefectsBookController */
/* @var $model DefectsBook */

$this->breadcrumbs=array(
	'Defects Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DefectsBook', 'url'=>array('index')),
	array('label'=>'Manage DefectsBook', 'url'=>array('admin')),
);
?>

<h1>Create DefectsBook</h1>

<?php echo $this->renderPartial('crup_form', array('model'=>$model)); ?>