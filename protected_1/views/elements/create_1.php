<?php
/* @var $this ElementsController */
/* @var $model Elements */

$this->breadcrumbs=array(
	'Elements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Elements', 'url'=>array('index')),
	array('label'=>'Manage Elements', 'url'=>array('admin')),
);
?>

<h1>Create Elements</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>