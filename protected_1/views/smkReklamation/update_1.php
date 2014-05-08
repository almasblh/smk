<?php
/* @var $this SmkReklamationController */
/* @var $model SmkReklamation */

$this->breadcrumbs=array(
	'Smk Reklamations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Изменить статус рекламации №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_update', array('model'=>$model)); ?>