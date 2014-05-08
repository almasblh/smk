<?php
/* @var $this KdCollectionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kd Collections',
);

$this->menu=array(
	array('label'=>'Create KdCollection', 'url'=>array('create')),
	array('label'=>'Manage KdCollection', 'url'=>array('admin')),
);
?>

<h1>Kd Collections</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
