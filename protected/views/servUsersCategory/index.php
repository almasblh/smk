<?php
/* @var $this ServUsersCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Serv Users Categories',
);

$this->menu=array(
	array('label'=>'Create ServUsersCategory', 'url'=>array('create')),
	array('label'=>'Manage ServUsersCategory', 'url'=>array('admin')),
);
?>

<h1>Serv Users Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
