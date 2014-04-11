<?php
/* @var $this SmkReklamationController */
/* @var $model SmkReklamation */

$this->breadcrumbs=array(
	'Smk Reklamations'=>array('index'),
	'Create',
);

?>

<h1>Добавление новой рекламации</h1>

<?php echo $this->renderPartial('create_form', array('model'=>$model)); ?>