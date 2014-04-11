<?php
/* @var $this ElbezUserCardController */
/* @var $model ElbezUserCard */

$this->breadcrumbs=array(
	'Elbez User Cards'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#elbez-user-card-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Карточки пользователей по Электробезопасности</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'elbez-user-card-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'userid',
                'value'=>'Yii::app()->user->getState(\'users_list\')[$data->userid]'
                ),
            array('name'=>'lastgrup',
                'value'=>array($model,'getLastGgrup'),
                ),
            array('name'=>'lastdateinspection',
                ),
            array('name'=>'lastrating',
                ),
            array('name'=>'dateinspection',
                ),
            array('name'=>'grup',
                'value'=>array($model,'getGgrup'),
                ),
            array('name'=>'rating',
                ),
            array('name'=>'ndocument',
                ),
            array('name'=>'nprotokol',
                ),
            array('name'=>'typeinspection',
                'value'=>'$data->typeinspection.\', \'.$data->exttypeinspection'
                ),
            array('name'=>'nextdateinspection',
                ),
		/*
		'typeinspection',
		'exttypeinspection',
		'nprotokol',
		'lastgrup',
		'lastdateinspection',
		'lastrating',
		'nextdateinspection',
		'signatureusertest1',
		'signatureusertest2',
		'signatureusertest3',
		'signatureusertest4',
		'signatureusertest5',
		'typepersonal',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
