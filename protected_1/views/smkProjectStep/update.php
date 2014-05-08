<?php
/* @var $this SmkProjectStepController */
/* @var $model SmkProjectStep */

$this->breadcrumbs=array(
	'Smk Project Steps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update SmkProjectStep <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>