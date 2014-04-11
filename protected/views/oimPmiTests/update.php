<?php
/* @var $this OimEtlTestsJurnalController */
/* @var $model OimEtlTestsJurnal */

$this->breadcrumbs=array(
	'Oim Etl Tests Jurnals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OimEtlTestsJurnal', 'url'=>array('index')),
	array('label'=>'Create OimEtlTestsJurnal', 'url'=>array('create')),
	array('label'=>'View OimEtlTestsJurnal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OimEtlTestsJurnal', 'url'=>array('admin')),
);
?>

<h1>Update OimEtlTestsJurnal <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>