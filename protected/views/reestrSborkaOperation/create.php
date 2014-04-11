<?php
/* @var $this ReestrSborkaOperationController */
/* @var $model ReestrSborkaOperation */

$this->breadcrumbs=array(
	'Reestr Sborka Operations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReestrSborkaOperation', 'url'=>array('index')),
	array('label'=>'Manage ReestrSborkaOperation', 'url'=>array('admin')),
);
?>

<h1>Create ReestrSborkaOperation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>