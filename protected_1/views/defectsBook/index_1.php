<?php
    $this->breadcrumbs=array(
            'Defects Books',
    );
?>

<h2>Журнал дефектов по проектуПГВР №<?php echo $project->Npgvr.' '.$project->Name; ?></h2>
<div class="Menu">
<?php
        $this->MenuButton('SmkProjects','view','Проект','id='.$project->id);
        $this->MenuButton('DefectsBook','create','Добавить новый дефект','projectid='.$project->id,'ajax','.InputForm');
?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defects-book-grid',
	'dataProvider'=>$model->search($project->id),
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
            array('name'=>'describe',
                'htmlOptions'=>array(
                    'style'=>'width:50%;text-align:center',
                )
            ),
            array('name'=>'createdate',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'autorid',
                'value'=>'($data->autorid<>0)?$data->GetUsersFIO2($data->autorid):"-"',
                'filter'=>$model->GetUsersList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'priority',
                'value'=>'$data->GetPriorityList($data->priority)',
                'filter'=>$model->GetPriorityList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
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
            array('name'=>'touserid',
                
                'value'=>'($data->touserid<>0)?$data->GetUsersFIO2($data->touserid):"-"',//'$data->GetUsersFIO2($data->touserid)',
                'filter'=>$model->GetUsersList(),
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
	),
)); ?>
