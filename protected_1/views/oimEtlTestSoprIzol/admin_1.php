<?php
/* @var $this OimEtlTestSoprIzolController */
/* @var $model OimEtlTestSoprIzol */


$this->breadcrumbs=array(
	'Измерения сопротивления изоляции'=>array('index'),
	'Измерения',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#oim-etl-test-sopr-izol-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Измерения сопротивления изоляции</h1>


<?php 
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$modeltest,
	'attributes'=>array(
		//'id',
		//'num',
            array('name'=>'testid',
                'value'=>$modeltest->ReestrOimEtlTests->name
            ),
            array('name'=>'projectid',
                'value'=>$modeltest->SmkProjects->Npgvr
            ),
		'datestart',
		'datestop',
		'ServUsersTester1.FIO',
		'ServUsersTester2.FIO',
		'ServUsersTester3.FIO',
		'resume',
		'comment',
	),
    ));
?>    

<?php
    echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button'));
?>
<div class="search-form" style="display:none">
<?php
    $this->renderPartial('_search',array(
	'model'=>$modelizm,
    ));
?>
</div><!-- search-form -->

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oim-etl-test-sopr-izol-grid',
	'dataProvider'=>$modelizm->search($modeltest->id),
	'filter'=>$modelizm,
	'columns'=>array(
            //'id',
            //'testsid',
            'from_to',
            'Urab',
            'cableid',
            'cablemark',
            'l1_n',
            'l2_n',
            'l3_n',
            'l1_pe',
            'l2_pe',
            'l3_pe',
            'l1_l2',
            'l1_l3',
            'l2_l3',
            'dateizm',
            'signaturecreator',
            array(
                'class'=>'CButtonColumn',
            ),
	),
    ));
?>
