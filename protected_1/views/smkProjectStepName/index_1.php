<?php
/* @var $this SmkProjectStepNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Smk Project Step Names',
);

$this->menu=array(
	array('label'=>'Create SmkProjectStepName', 'url'=>array('create')),
	array('label'=>'Manage SmkProjectStepName', 'url'=>array('admin')),
);
?>

<h1>Smk Project Step Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
