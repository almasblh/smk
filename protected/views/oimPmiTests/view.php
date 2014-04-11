<?php
$this->breadcrumbs=array(
	'Внутренние испытания '=>array('index'),
	'проект '.$model->SmkProjects->Name,
);

?>

<h1>Внутренние испытания проекта <?php echo $model->SmkProjects->Name; ?></h1>

<div class="Menu">
    <?php
        $this->MenuButton('OimPmiTests','create','Новое испытание','&id='.$model->projectid.'sw=new_intest');
        $this->MenuButton('OimPmiTests','otchets','Генерировать акт и протокол внутренних испытаний','id='.$model->projectid.'&sw=akt_prot_in_test');
        $this->MenuButton('OimPmiTests','list','Нормативная документация для испытаний','id='.$model->projectid.'&sw=norm_doc');
    ?>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            array('name'=>'projectid',
                'value'=>$model->SmkProjects->Npgvr
            ),
            array('name'=>'stepid',
                'value'=>$model->SmkProjectStepName->name
            ),
            'datestart',
            'datestop',

            'datestartfact',
            'datestopfact',
            'ncorrect',
            'current_persent',
            array('name'=>'curatorid',
                'value'=>$model->ServUsersStepCurator->FIO
            ),
	),
)); ?>
