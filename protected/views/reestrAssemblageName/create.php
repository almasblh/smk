<?php
/* @var $this ReestrAssemblageNameController */
/* @var $model ReestrAssemblageName */

$this->breadcrumbs=array(
	'Reestr Assemblage Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReestrAssemblageName', 'url'=>array('index')),
	array('label'=>'Manage ReestrAssemblageName', 'url'=>array('admin')),
);
?>

<h1>Create ReestrAssemblageName</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>