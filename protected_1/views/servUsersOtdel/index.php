<?php
/* @var $this ServUsersOtdelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Serv Users Otdels',
);

$this->menu=array(
	array('label'=>'Create ServUsersOtdel', 'url'=>array('create')),
	array('label'=>'Manage ServUsersOtdel', 'url'=>array('admin')),
);
?>

<h1>Serv Users Otdels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
