<?php
/* @var $this ReestrSborkaOperationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Sborka Operations',
);

$this->menu=array(
	array('label'=>'Create ReestrSborkaOperation', 'url'=>array('create')),
	array('label'=>'Manage ReestrSborkaOperation', 'url'=>array('admin')),
);
?>

<h1>Reestr Sborka Operations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
