<?php
/* @var $this ElementsController */
/* @var $model Elements */

$this->breadcrumbs=array(
	'Elements'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Elements', 'url'=>array('index')),
	array('label'=>'Create Elements', 'url'=>array('create')),
	array('label'=>'View Elements', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Elements', 'url'=>array('admin')),
);
?>

<h1>Update Elements <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>