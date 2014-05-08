<?php
/* @var $this SmkProjectStepNameController */
/* @var $model SmkProjectStepName */

$this->breadcrumbs=array(
	'Smk Project Step Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SmkProjectStepName', 'url'=>array('index')),
	array('label'=>'Manage SmkProjectStepName', 'url'=>array('admin')),
);
?>

<h1>Create SmkProjectStepName</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>