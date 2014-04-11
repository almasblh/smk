<?php
/* @var $this SmkProjectUnitsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Smk Project Units',
);

?>

<h1>Smk Project Units</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
