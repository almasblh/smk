<?php
/* @var $this ReestrOimEtlTestsController */
/* @var $model ReestrOimEtlTests */

$this->breadcrumbs=array(
	'Reestr Oim Etl Tests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReestrOimEtlTests', 'url'=>array('index')),
	array('label'=>'Manage ReestrOimEtlTests', 'url'=>array('admin')),
);
?>

<h1>Create ReestrOimEtlTests</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>