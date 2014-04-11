<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $model OimEtlTestSoprIzol */

$this->breadcrumbs=array(
	'Oim Etl Test Sopr Izols'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OimEtlTestSoprIzol', 'url'=>array('index')),
	array('label'=>'Create OimEtlTestSoprIzol', 'url'=>array('create')),
	array('label'=>'Update OimEtlTestSoprIzol', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OimEtlTestSoprIzol', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OimEtlTestSoprIzol', 'url'=>array('admin')),
);
?>

<h1>View OimEtlTestSoprIzol #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'testsid',
		'from_to',
		'Urab',
		'cableid',
		'cablemark',
		'l1_n',
		'l2_n',
		'l3_n',
		'l1_pe',
		'l2_pe',
		'l3_pe',
		'l1_l2',
		'l1_l3',
		'l2_l3',
		'dateizm',
		'signaturecreator',
	),
)); ?>
