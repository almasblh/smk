<?php
/* @var $this ReestrReklamationStatusNameController */
/* @var $model ReestrReklamationStatusName */

$this->breadcrumbs=array(
	'Reestr Reklamation Status Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReestrReklamationStatusName', 'url'=>array('index')),
	array('label'=>'Manage ReestrReklamationStatusName', 'url'=>array('admin')),
);
?>

<h1>Create ReestrReklamationStatusName</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>