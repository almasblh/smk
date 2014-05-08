<?php

$this->breadcrumbs=array(
	'Reestr Unit Names'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reestr-unit-name-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Реестр имен шкафов</h1>

<?php
if($this->EnableForCurrentUser('ReestrUnitName','create'))
    echo CHtml::link('Добавить еще шкаф',
                CHtml::normalizeUrl(array('ReestrUnitName/create'))
            ).'</br>';

echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reestr-unit-name-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'caption',
                'ReestrSystemName.caption',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
