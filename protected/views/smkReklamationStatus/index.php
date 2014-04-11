<?php
/* @var $this SmkReklamationStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Smk Reklamation Statuses',
);

$this->menu=array(
	array('label'=>'Create SmkReklamationStatus', 'url'=>array('create')),
	array('label'=>'Manage SmkReklamationStatus', 'url'=>array('admin')),
);
?>

<h1>Smk Reklamation Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
