<?php
/* @var $this ReestrElementManufactureController */
/* @var $model ReestrElementManufacture */

$this->breadcrumbs=array(
	'Reestr Element Manufactures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReestrElementManufacture', 'url'=>array('index')),
	array('label'=>'Manage ReestrElementManufacture', 'url'=>array('admin')),
);
?>

<h1>Create ReestrElementManufacture</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>