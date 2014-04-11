<?php
$this->breadcrumbs=array(
	'Reestr Unit Names'=>array('index'),
	'Create',
);
?>
<h1>Создание нового шкафа</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>