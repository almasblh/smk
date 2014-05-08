<?php
/* @var $this ElBezQuestsController */
/* @var $model ElBezQuests */

$this->breadcrumbs=array(
	'El Bez Quests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ElBezQuests', 'url'=>array('index')),
	array('label'=>'Manage ElBezQuests', 'url'=>array('admin')),
);
?>

<h1>Create ElBezQuests</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>