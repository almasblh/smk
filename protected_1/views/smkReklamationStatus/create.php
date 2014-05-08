<?php
/* @var $this SmkReklamationStatusController */
/* @var $model SmkReklamationStatus */

$this->breadcrumbs=array(
	'Smk Reklamation Statuses'=>array('index'),
	'Create',
);

?>

<h1>Добавление новой рекламации</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>