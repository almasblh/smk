<?php
$this->breadcrumbs=array(
	'Smk Projects'=>array('index'),
	$model->Name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Изменение данных по проекту <?php echo $model->Name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>