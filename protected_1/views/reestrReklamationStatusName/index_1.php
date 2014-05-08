<?php
/* @var $this ReestrReklamationStatusNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Reklamation Status Names',
);

$this->menu=array(
	array('label'=>'Create ReestrReklamationStatusName', 'url'=>array('create')),
	array('label'=>'Manage ReestrReklamationStatusName', 'url'=>array('admin')),
);
?>

<h1>Reestr Reklamation Status Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
