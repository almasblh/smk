<?php
$this->breadcrumbs=array(
	'Reestr System Names'=>array('index'),
	'Create',
);
?>
<h1>Создание новой системы</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>