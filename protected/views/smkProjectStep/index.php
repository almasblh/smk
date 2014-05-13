<div class="SmkProjectStepIndexInputForm"></div>
<?php
    $render ='function() {
        var url = $(this).attr(\'href\');
        $.get(url, function(response) {
            $(".ProjectTable").html(response);
        });
        return false;
    }';
    
    $curator=((Yii::app()->user->id==217) || ($model->kuratorid == Yii::app()->user->id));
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'steps-project-grid',
            'dataProvider'=>SmkProjectStep::model()->srchProject($model->id,$model->kuratorid),
            'rowHtmlOptionsExpression'=>array($model,'getStepsRowHtmlOptions'), //метод модели
            'columns'=>array(
                array('name'=>'ordern',
                    'type'=>'raw',
                    'value'=>array(SmkProjectStep::model(),'getOrdern'),        //метод модели
                ),                
                array('name'=>'stepid',
                    'type'=>'html',
                    'value'=>'CHtml::link(CHtml::encode(($data->SmkProjectStepName["name"]." ".$data->stepcomment)),array("SmkProjectStep/view","id"=>$data->id))',
                    'filter'=>false
                ),
                array('name'=>'datestart',
                    'type'=>'raw',
                    'value'=>array(SmkProjectStep::model(),'getDateStart'),                      //метод модели
                    'htmlOptions'=>array(
                        'style'=>'width:125px'
                    ),
                    'filter'=>false,
                ),
                array('name'=>'datestartfact',
                    'value'=>'($data->datestartfact>0)?$data->datestartfact:\'-\'',
                    'filter'=>false,
                    'htmlOptions'=>array(
                        'style'=>'width:125px'
                    )
                ),
                array('name'=>'datestop',
                    'type'=>'raw',
                    'value'=>array(SmkProjectStep::model(),'getDateStop'),                       //метод модели
                    'htmlOptions'=>array(
                        'style'=>'width:125px'
                    ),
                    'filter'=>false,
                ),
                array('name'=>'datestopfact',
                    'value'=>'($data->datestopfact>0)?$data->datestopfact:\'-\'',
                    'filter'=>false,
                    'htmlOptions'=>array(
                        'style'=>'width:125px'
                    )
                ),
                array('name'=>'current_persent',
                    'type'=>'text',
                    'value'=>'$data->current_persent',
                    'filter'=>false,
                    'htmlOptions'=>array(
                        'style'=>'width:100px'
                    )
                ),
                array('name'=>'curatorid',
                    'type'=>'raw',
                    'value'=>array(SmkProjectStep::model(),'getCurator'),                        //метод модели
                    //'value'=>'CHtml::link(CHtml::encode($data->ServUsersStepCurator["FIO2"]),array("ServUsers/view","id"=>$data->curatorid))',
                    'cssClassExpression'=>'($data->signaturecurator>0) ? "greenBackground" : "redBackground"',
                    'filter'=>false
                ),
                array('name'=>'signaturecurator',
                    'type'=>'raw',
                    'value'=>array(SmkProjectStep::model(),'getSignatureCuratorValue'),    //метод модели
                    //'value'=>'($data->signaturecurator>0) ? "ДА" : "-"',
                    'cssClassExpression'=>'($data->signaturecurator>0) ? "greenBackground" : "redBackground"',
                    'filter'=>false,
                    'htmlOptions'=>array(
                        'style'=>'width:100px'
                    )
                ),
                array(
                    'class'=>'CButtonColumn',
                    'buttons'=>array(
                        'btnDelete'=>array(
                            'label'=>'Удалить',
                            'url'=>'Yii::app()->createUrl("SmkProjectStep/delete",array("id"=>$data->id,"projectid"=>'.$model->id.'))',
                            'click'=>$render,
                        )
                    ),
                    'template'=>'{btnDelete}',
                    'deleteConfirmation'=>"js:'Этап - '+$(this).parent().parent().children(':first-child').text()+' будет удален! Нажмите Ок для подтверждения'",
                    'visible' => $curator,
                    'htmlOptions'=> array('width'=>'20px'),
		),
            ),
        ));
        

?>
