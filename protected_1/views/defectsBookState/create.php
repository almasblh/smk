<?php
/* @var $this DefectsBookStateController */
/* @var $model DefectsBookState */

$this->breadcrumbs=array(
	'Defects Book States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DefectsBookState', 'url'=>array('index')),
	array('label'=>'Manage DefectsBookState', 'url'=>array('admin')),
);
?>

<h1>Create DefectsBookState</h1>

<?php echo $this->renderPartial('crup_form', array('model'=>$model)); ?>