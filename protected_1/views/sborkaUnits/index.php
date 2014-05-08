<?php
/* @var $this SborkaUnitsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sborka Units',
);

$this->menu=array(
	array('label'=>'Create SborkaUnits', 'url'=>array('create')),
	array('label'=>'Manage SborkaUnits', 'url'=>array('admin')),
);
?>

<h1>Sborka Units</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
