<?php
    $this->breadcrumbs=array(
            'Defects Books',
    );
?>

<h2>Журнал дефектов по проектуПГВР №<?php echo $project->Npgvr.' '.$project->Name; ?></h2>
<div class="Menu">
<?php
        $this->ExtMenuButton(array(
            'name'=>'btnProject',
            'controller'=>'SmkProjects',
            'action'=>'view',
            'title'=>'Проект',
            'par'=>'id='.$project->id
        ));
        $this->ExtMenuButton(array(
            'name'=>'btnAddNewDefect',
            'controller'=>'DefectsBook',
            'action'=>'create',
            'title'=>'Добавить новый дефект',
            'par'=>'projectid='.$project->id,
            'SubjectType'=>'ajax',
            'div'=>'.DefectsBookInputForm'
        ));
?>
</div>
<div class="DefectsBookInputForm"></div>
<?php
    echo CHtml::link('Все',
            array('index','par'=>'all')
    ).' ';
    echo CHtml::link('Открытые',
            array('index','par'=>'open')
    ).' ';
    echo CHtml::link('Закрытые',
            array('index','par'=>'close')
    ).' ';
        
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defects-book-grid',
	'dataProvider'=>$model->search($project->id,isset($_GET['par'])?$_GET['par']:0),
	'filter'=>$model,
        'rowHtmlOptionsExpression'=>array($model,'getRowHtmlOptions'),          //метод модели
	'columns'=>array(
            array('name'=>'id',
                'type'=>'html',
                'value'=>'CHtml::link($data->id,array("/DefectsBook/view","defectid"=>$data->id))',
                'htmlOptions'=>array(
                    'style'=>'width:2%',
                )
            ),
            array('name'=>'priority',
                'value'=>'$data->GetPriorityList($data->priority)',
                'filter'=>$model->GetPriorityList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'createdate',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'where',
                'htmlOptions'=>array(
                    'style'=>'width:10%;text-align:center',
                )
            ),
            array('name'=>'mnemoid',
                'value'=>'$data->GetMnemoList($data->mnemoid)',
                'filter'=>$model->GetMnemoList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'unitid',
                'value'=>'$data->GetUnitList($data->unitid)',
                'filter'=>$model->GetUnitList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'describe',
                'htmlOptions'=>array(
                    'style'=>'width:50%;text-align:center',
                )
            ),
            array('name'=>'linkrd',
                'htmlOptions'=>array(
                    'style'=>'width:50%;text-align:center',
                )
            ),
            array('name'=>'defectvedomostid',
                'value'=>'$data->defectvedomostid ? $data->defectvedomostid : "-"',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'laststate',
                'value'=>'$data->GetDefectStatusList($data->laststate)',
                'filter'=>$model->GetDefectStatusList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'autorid',
                'type'=>'raw',
                'value'=>'($data->autorid<>0)?$data->getUserLink($data->autorid):"-"',
                'filter'=>$model->GetUsersList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'touserid',
                'type'=>'raw',
                'value'=>'($data->touserid<>0)?$data->getUserLink($data->touserid):"-"',
                'filter'=>$model->GetUsersList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
	),
    ));
?>
