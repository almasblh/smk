<?php
/* @var $this ReestrElementManufactureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Element Manufactures',
);

$this->menu=array(
	array('label'=>'Create ReestrElementManufacture', 'url'=>array('create')),
	array('label'=>'Manage ReestrElementManufacture', 'url'=>array('admin')),
);
?>

<h1>Reestr Element Manufactures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
