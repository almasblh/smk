<?php
/* @var $this ReestrCableNameController */
/* @var $model ReestrCableName */

$this->breadcrumbs=array(
	'Reestr Cable Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrCableName', 'url'=>array('index')),
	array('label'=>'Create ReestrCableName', 'url'=>array('create')),
	array('label'=>'View ReestrCableName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrCableName', 'url'=>array('admin')),
);
?>

<h1>Update ReestrCableName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>