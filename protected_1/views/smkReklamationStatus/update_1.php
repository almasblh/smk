<?php
/* @var $this SmkReklamationStatusController */
/* @var $model SmkReklamationStatus */

$this->breadcrumbs=array(
	'Smk Reklamation Status'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update SmkReklamationStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>