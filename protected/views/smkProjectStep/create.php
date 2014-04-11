<?php
$this->breadcrumbs=array(
	'Smk Project Steps'=>array('index'),
	'Create',
);
?>

<h1>Создание этапа проекта</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>