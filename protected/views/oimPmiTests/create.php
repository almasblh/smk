<?php
$this->breadcrumbs=array(
	'ОИиМ ЭТЛ'=>array('index'),
	'Создать новое испытание',
);
?>

<h1>Создать новое испытание ЭТЛ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>