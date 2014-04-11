<?php
/* @var $this ReestrCableNameController */
/* @var $model ReestrCableName */

$this->breadcrumbs=array(
	'Reestr Cable Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReestrCableName', 'url'=>array('index')),
	array('label'=>'Manage ReestrCableName', 'url'=>array('admin')),
);
?>

<h1>Create ReestrCableName</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>