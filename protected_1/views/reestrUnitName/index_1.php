<?php
/* @var $this ReestrUnitNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Unit Names',
);

$this->menu=array(
	array('label'=>'Create ReestrUnitName', 'url'=>array('create')),
	array('label'=>'Manage ReestrUnitName', 'url'=>array('admin')),
);
?>

<h1>Reestr Unit Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
