<?php
/* @var $this ReestrElementManufactureController */
/* @var $model ReestrElementManufacture */

$this->breadcrumbs=array(
	'Reestr Element Manufactures'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrElementManufacture', 'url'=>array('index')),
	array('label'=>'Create ReestrElementManufacture', 'url'=>array('create')),
	array('label'=>'View ReestrElementManufacture', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrElementManufacture', 'url'=>array('admin')),
);
?>

<h1>Update ReestrElementManufacture <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>