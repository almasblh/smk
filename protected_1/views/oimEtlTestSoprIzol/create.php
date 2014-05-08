<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $model OimEtlTestSoprIzol */

$this->breadcrumbs=array(
	'Oim Etl Test Sopr Izols'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OimEtlTestSoprIzol', 'url'=>array('index')),
	array('label'=>'Manage OimEtlTestSoprIzol', 'url'=>array('admin')),
);
?>

<h1>Create OimEtlTestSoprIzol</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>