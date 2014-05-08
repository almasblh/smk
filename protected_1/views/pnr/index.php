<?php
/* @var $this PnrController */

$this->breadcrumbs=array(
	'Pnr',
);

//Выводим таблицу с приборами
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
	'filter'=>$model,
	'columns'=>array(
                //'id',
                'projectid',
                'shkafid',
                'skafn1',
                'skafn2',
                'skafn3',
                'klemma',
                'name',
                'typeid',
                'typename',
                'arm_visible_all',
                'connection_all',
                'kabel_all',
                'low_device_all',
                'ready',
		//array(
		//	'class'=>'CButtonColumn',
		//),
	),
));

?>
