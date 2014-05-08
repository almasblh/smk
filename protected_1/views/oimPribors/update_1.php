<?php
/* @var $this OimPriborsController */
/* @var $model OimPribors */

$this->breadcrumbs=array(
	'Oim Pribors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OimPribors', 'url'=>array('index')),
	array('label'=>'Create OimPribors', 'url'=>array('create')),
	array('label'=>'View OimPribors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OimPribors', 'url'=>array('admin')),
);
?>

<h1>Редактирование прибора <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>