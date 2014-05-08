<?php
/* @var $this ReestrAssemblageNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Assemblage Names',
);

$this->menu=array(
	array('label'=>'Create ReestrAssemblageName', 'url'=>array('create')),
	array('label'=>'Manage ReestrAssemblageName', 'url'=>array('admin')),
);
?>

<h1>Reestr Assemblage Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
