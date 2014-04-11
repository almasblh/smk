<?php
/* @var $this ReestrSborkaOperationController */
/* @var $model ReestrSborkaOperation */

$this->breadcrumbs=array(
	'Reestr Sborka Operations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReestrSborkaOperation', 'url'=>array('index')),
	array('label'=>'Create ReestrSborkaOperation', 'url'=>array('create')),
	array('label'=>'View ReestrSborkaOperation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReestrSborkaOperation', 'url'=>array('admin')),
);
?>

<h1>Update ReestrSborkaOperation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>