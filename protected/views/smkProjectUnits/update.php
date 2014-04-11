<?php
/* @var $this SmkProjectUnitsController */
/* @var $model SmkProjectUnits */

$this->breadcrumbs=array(
	'Smk Project Units'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SmkProjectUnits', 'url'=>array('index')),
	array('label'=>'Create SmkProjectUnits', 'url'=>array('create')),
	array('label'=>'View SmkProjectUnits', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SmkProjectUnits', 'url'=>array('admin')),
);
?>

<h1>Update SmkProjectUnits <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>