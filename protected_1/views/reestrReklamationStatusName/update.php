<?php
/* @var $this ReestrReklamationStatusNameController */
/* @var $model ReestrReklamationStatusName */

$this->breadcrumbs=array(
	'Reestr Reklamation Status Names'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrReklamationStatusName', 'url'=>array('index')),
	array('label'=>'Create ReestrReklamationStatusName', 'url'=>array('create')),
	array('label'=>'View ReestrReklamationStatusName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrReklamationStatusName', 'url'=>array('admin')),
);
?>

<h1>Update ReestrReklamationStatusName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>