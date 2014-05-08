<?php
$this->breadcrumbs=array(
	'Smk Projects'=>array('index'),
	'Create',
);
?>

<h2>Создание нового проекта</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>