<?php
/* @var $this ServUsersDepartamentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Serv Users Departaments',
);

$this->menu=array(
	array('label'=>'Create ServUsersDepartament', 'url'=>array('create')),
	array('label'=>'Manage ServUsersDepartament', 'url'=>array('admin')),
);
?>

<h1>Serv Users Departaments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
