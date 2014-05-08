<?php
/* @var $this ReestrSystemNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr System Names',
);

$this->menu=array(
	array('label'=>'Create ReestrSystemName', 'url'=>array('create')),
	array('label'=>'Manage ReestrSystemName', 'url'=>array('admin')),
);
?>

<h1>Reestr System Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
