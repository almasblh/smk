<?php
    $this->breadcrumbs=array(
            'Журнал испытаний ЭТ лаборатории',
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $('#oim-etl-tests-jurnal-grid').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });
    ");
?>

<h1>Журнал испытаний ЭТ лаборатории</h1>

<div class="Menu">
    <?php
        $this->MenuButton('OimEtlTests','create','Новое испытание');
    ?>
</div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oim-etl-tests-jurnal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'num',
                'htmlOptions'=> array('width'=>'3%'),
            ),
            array('name'=>'SmkProjects.Npgvr',
                'htmlOptions'=> array('width'=>'4%'),
            ),
            array('name'=>'SmkProjectUnits.ReestrUnitName.caption',
                'htmlOptions'=> array('width'=>'4%'),
            ),
            array('name'=>'ReestrOimEtlTests.name',
                'type'=>'html',
                'value'=>'
                    CHtml::link($data->ReestrOimEtlTests[\'name\'],
                    CHtml::normalizeURL(array(
                        (\'OimEtlTests/index&testid=\'.$data->testid.\'&id=\'.$data->id))))
                        ',
            ),
            'datestart',
            'datestop',
            array('name'=>'resume',
                'value'=>'
                    ($data->resume==2) ? \'соответствует\':
                    ($data->resume==1) ? \'неисправно\':\'не испытывалось\'
                    ',
                'htmlOptions'=> array('width'=>'5%'),
            ),
            //'comment',
            'ServUsersTester1.FIO',
            'ServUsersTester2.FIO',
            'ServUsersTester3.FIO',
            array(
                'class'=>'CButtonColumn',
                'header'=>'Действия',
                'buttons'=>array(
                    'btnProtokol'=>array(
                        'label'=>'Генерировать протокол',
                        'url'=>'Yii::app()->createUrl("/OimEtlTests/otchets",array("id"=>$data->id,"par"=>"prot_avtomat"))',
                    ),
                ),
                'template'=>'{btnProtokol}',
            ),
	),
    ));
?>
