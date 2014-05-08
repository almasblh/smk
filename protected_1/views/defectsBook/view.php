<?php
    $this->breadcrumbs=array(
            'Defects Books'=>array('index'),
            $model->id,
    );
?>
<div class="Menu">
<?php
        $this->MenuButton('SmkProjects','view','Проект','id='.$model->projectid);
        $this->MenuButton('DefectsBook','index','Дефекты');
?>
</div>

<h3>Дефект №<?php echo $model->id.' '; ?>по проекту ПГВР №<?php echo $model->project['Npgvr'].' '.$model->project['Name']; ?></h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            array('name'=>'describe',
                'cssClass'=>'rozeBackground'
            ),
            array('name'=>'mnemoid',
                'value'=>$model->GetMnemoList($model->mnemoid),
            ),
            array('name'=>'unitid',
                'value'=>$model->GetUnitList($model->unitid),
            ),
            array('name'=>'priority',
                'value'=>$model->GetPriorityList($model->priority),
            ),
            array('name'=>'defectvedomostid',
            ),
            array('name'=>'autorid',
                'value'=>$model->GetUsersFIO2($model->autorid),
            ),
            array('name'=>'createdate',
            ),
            array('name'=>'laststate',
                'value'=>$model->GetDefectStatusList($model->laststate),
            ),
            array('name'=>'touserid',
                'value'=>($model->touserid<>0)?$model->GetUsersFIO2($model->touserid):'-',
            ),
	),
    ));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defects-book-grid',
	'dataProvider'=>$modelstatus->search($defectid),
	'filter'=>$modelstatus,
        'rowHtmlOptionsExpression'=>array($modelstatus,'getRowHtmlOptions'),    //метод модели
	'columns'=>array(
            array('name'=>'id',
                'htmlOptions'=>array(
                    'style'=>'width:30px',
                )
            ),
            array('name'=>'date',
                'htmlOptions'=>array(
                    'style'=>'width:150px;text-align:center',
                )
            ),
            array('name'=>'state',
                'value'=>'$data->GetDefectStatusList($data->state)',
                'filter'=>$model->GetDefectStatusList(),
                'htmlOptions'=>array(
                    'style'=>'width:120px;text-align:center',
                )
            ),
            array('name'=>'comment',
                'htmlOptions'=>array(
                    'style'=>'width:60%;text-align:center',
                )
            ),
            array('name'=>'signaturecreatorid',
                'value'=>'$data->GetUsersFIO2($data->signaturecreatorid)',
                'filter'=>$model->GetUsersList(),
                'htmlOptions'=>array(
                    'style'=>'width:120px;text-align:center',
                )
            ),
            array('name'=>'touserid',
                'value'=>'($data->touserid<>0)?$data->GetUsersFIO2($data->touserid):"-"',//'$data->GetUsersFIO2($data->touserid)',
                'filter'=>$model->GetUsersList(),
                'htmlOptions'=>array(
                    'style'=>'width:120px;text-align:center',
                )
            ),
    ),
));
?>
<div class="Menu">
<?php
    if($model->laststate<>0){
        if(Yii::app()->user->id==$model->touserid){    
            $this->MenuButton('DefectsBookState','create','Иправить','par=2&defectid='.$defectid,'ajax','.InputForm');
            $this->MenuButton('DefectsBookState','create','Отклонить','par=3&defectid='.$defectid,'ajax','.InputForm');
        }
        if(Yii::app()->user->id==$model->autorid){    
            $this->MenuButton('DefectsBookState','create','Переоткрыть','par=4&defectid='.$defectid,'ajax','.InputForm');
            $this->MenuButton('DefectsBookState','create','Закрыть','par=0&defectid='.$defectid,'ajax','.InputForm');
        }
    }
?>
</div>

