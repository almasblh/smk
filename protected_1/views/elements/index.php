<?php
/* @var $this ElementsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Elements',
);

$this->menu=array(
	array('label'=>'Create Elements', 'url'=>array('create')),
	array('label'=>'Manage Elements', 'url'=>array('admin')),
);
?>

<h1>Elements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
