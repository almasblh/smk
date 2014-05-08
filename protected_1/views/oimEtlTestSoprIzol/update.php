<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $model OimEtlTestSoprIzol */

$this->breadcrumbs=array(
	'Oim Etl Test Sopr Izols'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OimEtlTestSoprIzol', 'url'=>array('index')),
	array('label'=>'Create OimEtlTestSoprIzol', 'url'=>array('create')),
	array('label'=>'View OimEtlTestSoprIzol', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OimEtlTestSoprIzol', 'url'=>array('admin')),
);
?>

<h1>Update OimEtlTestSoprIzol <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>