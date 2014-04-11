<?php
/* @var $this OimPriborsPovererController */
/* @var $model OimPriborsPoverer */

$this->breadcrumbs=array(
	'Oim Pribors Poverers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OimPriborsPoverer', 'url'=>array('index')),
	array('label'=>'Create OimPriborsPoverer', 'url'=>array('create')),
	array('label'=>'View OimPriborsPoverer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OimPriborsPoverer', 'url'=>array('admin')),
);
?>

<h1>Update OimPriborsPoverer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>