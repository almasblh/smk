<?php
/* @var $this OimPriborsController */
/* @var $model OimPribors */

$this->breadcrumbs=array(
	'Oim Pribors'=>array('index'),
	'Управление',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#oim-pribors-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление приборами</h1>
<div class="container" id="greedwiev">
<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oim-pribors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'descr',
		'zavn',
		'passnom',
		'lastpoverdate',
		'nextpoverdate',
		'wherenow',
		/*
                 * 'passport',
		'ext',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>