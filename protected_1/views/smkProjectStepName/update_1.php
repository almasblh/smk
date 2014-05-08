<?php
/* @var $this SmkProjectStepNameController */
/* @var $model SmkProjectStepName */

$this->breadcrumbs=array(
	'Smk Project Step Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SmkProjectStepName', 'url'=>array('index')),
	array('label'=>'Create SmkProjectStepName', 'url'=>array('create')),
	array('label'=>'View SmkProjectStepName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SmkProjectStepName', 'url'=>array('admin')),
);
?>

<h1>Update SmkProjectStepName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>