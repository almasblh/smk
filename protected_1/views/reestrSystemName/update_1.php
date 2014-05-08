<?php
/* @var $this ReestrSystemNameController */
/* @var $model ReestrSystemName */

$this->breadcrumbs=array(
	'Reestr System Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrSystemName', 'url'=>array('index')),
	array('label'=>'Create ReestrSystemName', 'url'=>array('create')),
	array('label'=>'View ReestrSystemName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrSystemName', 'url'=>array('admin')),
);
?>

<h1>Update ReestrSystemName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>