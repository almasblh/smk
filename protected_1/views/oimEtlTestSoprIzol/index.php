<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Oim Etl Test Sopr Izols',
);

$this->menu=array(
	array('label'=>'Create OimEtlTestSoprIzol', 'url'=>array('create')),
	array('label'=>'Manage OimEtlTestSoprIzol', 'url'=>array('admin')),
);
?>

<h1>Oim Etl Test Sopr Izols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
