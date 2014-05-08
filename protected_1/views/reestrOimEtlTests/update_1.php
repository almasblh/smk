<?php
/* @var $this ReestrOimEtlTestsController */
/* @var $model ReestrOimEtlTests */

$this->breadcrumbs=array(
	'Reestr Oim Etl Tests'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrOimEtlTests', 'url'=>array('index')),
	array('label'=>'Create ReestrOimEtlTests', 'url'=>array('create')),
	array('label'=>'View ReestrOimEtlTests', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrOimEtlTests', 'url'=>array('admin')),
);
?>

<h1>Update ReestrOimEtlTests <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>