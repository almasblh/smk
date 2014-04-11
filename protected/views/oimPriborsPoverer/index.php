<?php
/* @var $this OimPriborsPovererController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Oim Pribors Poverers',
);

$this->menu=array(
	array('label'=>'Create OimPriborsPoverer', 'url'=>array('create')),
	array('label'=>'Manage OimPriborsPoverer', 'url'=>array('admin')),
);
?>

<h1>Oim Pribors Poverers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
