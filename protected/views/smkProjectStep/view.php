<?php
$this->breadcrumbs=array(
	'Smk Project Steps'=>array('index'),
	$model->id,
);
?>
<h2>Этап "<?php echo $model->SmkProjectStepName['name']; ?>" по проекту ПГВР №<?php echo $model->SmkProjects['Npgvr']; ?></h2>
<div class="Menu">
<?php
        $contr=$model->SmkProjectStepName['ServControllers']['name'];
        $this->ExtMenuButton(array(
            'name'=>'btnProject',
            'controller'=>'SmkProjects',
            'action'=>'view',
            'title'=>'Проект',
            'par'=>'id='.$model->projectid
        ));
        $this->ExtMenuButton(array(
            'controller'=>$contr,
            'action'=>'view',
            'title'=>$model->SmkProjectStepName['name'],
            'par'=>'id='.$model->projectid
        ));
        $this->ExtMenuButton(array(
            'controller'=>'DefectsBook',
            'action'=>'index',
            'title'=>'Журнал дефектов',
            'par'=>'id='.$model->projectid
        ));
?>
</div>
<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'attributes'=>array(
            'datestart',
            'datestop',
            'datestartfact',
            'datestopfact',
            'ncorrect',
            array('name'=>'curatorid',
                'value'=>$model->ServUsersStepCurator['FIO']
            ),
            array('name'=>'current_persent',
                'cssClass'=>($model->current_persent<=0) ? 'redBackground' : '',
            )
	),
    ));
?>
<h2>Журнал этапа</h2>
<div class="Menu">
<?php
    if(Yii::app()->user->id==$model->curatorid || Yii::app()->user->id==217){
        $this->ExtMenuButton(array(
            'name'=>'btnAddNewRecInStepcuratorJurnal',
            'controller'=>'SmkProjectStepcuratorJurnal',
            'action'=>'create',
            'title'=>'Добавить запись',
            'par'=>'id='.$model->id,
            'SubjectType'=>'ajax',
            'div'=>'.SmkProjectStepcuratorJurnalInputForm'
        ));
    }
?>
</div>
<div class="SmkProjectStepcuratorJurnalInputForm"></div>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'jurnal-steps-grid',
        'dataProvider'=>$modelJurnal,
        'columns'=>array(
            array('name'=>'daterecord',
                'header'=>'Дата записи',
                'value'=>'Yii::app()->dateFormatter->format(\'d MMM yyyyг. hh:mm \',$data->daterecord)',
                'htmlOptions'=>array(
                    'style'=>'text-align:center; width:140px',
                )
            ),
            array('name'=>'comment',
                'header'=>'Коментарии ответсвенного исполнителя',
                'value'=>'$data->comment',
                'htmlOptions'=>array(
                    'style'=>'text-align:left',
                )            ),
            array('name'=>'current_percent',
                'header'=>'Выполнено %',
                'value'=>'$data->current_percent',
                'htmlOptions'=>array(
                    'style'=>'text-align:center; width:100px',
                )
            ),
        ),
    ));
?>

