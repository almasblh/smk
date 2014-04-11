<?php
$this->breadcrumbs=array(
	'Smk Projects'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search',
    "$('.search-button').click(function(){
	$('.search-form').toggle('slow');
	return false;
    });
    $('.search-form form').submit(function(){
            $('#smk-projects-grid').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });"
);
?>

<h1>Управление проектами</h1>

<?php echo CHtml::link(
                'Расширенный поиск',
                '#',
                array('class'=>'search-button')
            );
?>
<div class="search-form" style="display:none">
<?php
    $this->renderPartial(
        '_search',array(
            'model'=>$model,
        )
    );
?>
</div><!-- search-form -->

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smk-projects-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Name',
		'Npgvr',
		'dogovor',
		'Works',
		'customer',
		'object',
		array(
			'class'=>'CButtonColumn',
		),
	),
    ));
?>
