<?php
/* @var $this ReestrOimEtlTestsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reestr Oim Etl Tests',
);

$this->menu=array(
	array('label'=>'Create ReestrOimEtlTests', 'url'=>array('create')),
	array('label'=>'Manage ReestrOimEtlTests', 'url'=>array('admin')),
);
?>

<h1>Reestr Oim Etl Tests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
