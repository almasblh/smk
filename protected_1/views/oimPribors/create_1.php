<?php
/* @var $this OimPriborsController */
/* @var $model OimPribors */

$this->breadcrumbs=array(
	'Oim Pribors'=>array('index'),
	'Новый прибор',
);

$this->menu=array(
	array('label'=>'Список приборов', 'url'=>array('index')),
	array('label'=>'Управление приборами', 'url'=>array('admin')),
);
?>

<h1>Новый прибор</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>