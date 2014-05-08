<?php
/* @var $this ElBezQuestsController */
/* @var $model ElBezQuests */

$this->breadcrumbs=array(
	'El Bez Quests'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ElBezQuests', 'url'=>array('index')),
	array('label'=>'Create ElBezQuests', 'url'=>array('create')),
	array('label'=>'View ElBezQuests', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ElBezQuests', 'url'=>array('admin')),
);
?>

<h1>Update ElBezQuests <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>