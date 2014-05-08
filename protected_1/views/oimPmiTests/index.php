<?php
    $this->breadcrumbs=array(
            'Журнал испытаний ОИиМ',
    );

?>

<h1>Журнал испытаний ОИиМ</h1>

<div class="Menu">
    <?php
        //$this->MenuButton('OimEtlTests','create','Новое испытание');
    ?>
</div>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oim-etl-tests-jurnal-grid',
	'dataProvider'=>$model->srchView(),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'projectid',
                'type'=>'html',
                //'value'=>'$data->SmkProjects[\'Npgvr\']',
                'value'=>'CHtml::link(CHtml::encode($data->SmkProjects[\'Npgvr\']),array("OimPmiTests/view","id"=>$data->projectid))'
            ),
            'datestart',
            'datestop',
            'datestartfact',
            'datestopfact',
            array('name'=>'curatorid',
                'type'=>'html',
                //'value'=>'$data->ServUsersStepCurator[\'FIO\']'
                'value'=>'CHtml::link(CHtml::encode($data->ServUsersStepCurator["FIO"]),array("ServUsers/view","id"=>$data->curatorid))'
            ),
/*
            array(
                'class'=>'CButtonColumn',
                'header'=>'Действия',
                'buttons'=>array(
                    'btnAktGenerate'=>array(
                        'label'=>'Акт и протокол внутренних испытаний',
                        'url'=>'Yii::app()->createUrl("/OimPmiTests/otchets",array("id"=>$data->projectid,"sw"=>"akt_prot_in_test"))',
                        //'click'=>$js_jurnal_view,
                        //'imageUrl'=>'/smk/images/SmJur.jpg',
                    ),
                ),
                'template'=>'{btnAktGenerate}',
            ),
 * 
 */
	),
    ));
?>
