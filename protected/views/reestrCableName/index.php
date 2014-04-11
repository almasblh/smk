<?php
/* @var $this ReestrCableNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Cable Names',
);

$this->menu=array(
	array('label'=>'Create ReestrCableName', 'url'=>array('create')),
	array('label'=>'Manage ReestrCableName', 'url'=>array('admin')),
);
?>

<h1>Reestr Cable Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
