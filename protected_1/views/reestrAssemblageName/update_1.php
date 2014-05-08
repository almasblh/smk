<?php
/* @var $this ReestrAssemblageNameController */
/* @var $model ReestrAssemblageName */

$this->breadcrumbs=array(
	'Reestr Assemblage Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrAssemblageName', 'url'=>array('index')),
	array('label'=>'Create ReestrAssemblageName', 'url'=>array('create')),
	array('label'=>'View ReestrAssemblageName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrAssemblageName', 'url'=>array('admin')),
);
?>

<h1>Update ReestrAssemblageName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>