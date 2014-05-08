<?php
/* @var $this DefectsBookStateController */
/* @var $model DefectsBookState */

$this->breadcrumbs=array(
	'Defects Book States'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DefectsBookState', 'url'=>array('index')),
	array('label'=>'Create DefectsBookState', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#defects-book-state-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Defects Book States</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defects-book-state-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'defectid',
		'state',
		'comment',
		'date',
		'signaturecreatorid',
		/*
		'touserid',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
