<style>
    figure {
        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
           -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
           -moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        background-color: #e9f9f9;
        border-color: #0;
        border-style: solid;
        border-width: 1px;

    }
    figure header{
        color: white;
        font-weight:bold;
        margin: 0;
        background: -moz-linear-gradient(to top, #63869a, #a4ddff);
        background: -webkit-linear-gradient(to top, #63869a, #a4ddff);
        background: -o-linear-gradient(to top, #63869a, #a4ddff);
        background: -ms-linear-gradient(top, #63869a, #a4ddff);
        background: linear-gradient(to top, #63869a, #a4ddff);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#63869a', endColorstr='#a4ddff');
    }    
    figure #Body{
        padding: 5 10 20 10;
        overflow-y: auto;
    }
</style>

<figure class="DefectInfo"> 
    <header id="Header">Этапы дефекта № <?php echo $model->id ?>
        <span style="float:right; margin:2px;">
        <?php
            echo CHtml::imageButton(
                Yii::app()->request->baseUrl.'/images/Xmin.png',
                array('id'=>'esc',
                    'onclick'=>'$(\'.DefectInfo\').remove()'
                )
            );
        ?>
        </span>
    </header>
    <div id="Body">
    <div class="DefectsBookInfoInputForm"></div>
    <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'defects-book-grid',
            'dataProvider'=>$modelstatus->search($defectid),
            //'filter'=>$modelstatus,
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
                array('name'=>'signaturecreatorid',
                    'type'=>'raw',
                    'value'=>'$data->getUserLink($data->signaturecreatorid)',
                    'filter'=>$model->GetUsersList(),
                    'htmlOptions'=>array(
                        'style'=>'width:120px;text-align:center',
                    )
                ),
                array('name'=>'comment',
                    'htmlOptions'=>array(
                        'style'=>'width:60%;text-align:center',
                    )
                ),
                array('name'=>'attachepathstate',
                    'type'=>'raw',
                    'value'=>'(isset($data->attachepathstate)&& $data->attachepathstate<>"")?
                        CHtml::link(CHtml::image("./images/document3232.png","file"),
                            array("/Viewfiles",
                              "path" => "defects/files/".$data->attachepathstate
                            ),
                            array("target"=>"_blank")
                            )
                        :"-"',
                    'htmlOptions'=>array(
                        'style'=>'width:2%;text-align:center',
                    )
                ),
                array('name'=>'touserid',
                    'type'=>'raw',
                    'value'=>'($data->touserid<>0)?$data->getUserLink($data->touserid):"-"',//'$data->GetUsersFIO2($data->touserid)',
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
                    $this->ExtMenuButton(array(
                        'name'=>'btnFix',
                        'controller'=>'DefectsBookState',
                        'action'=>'create',
                        'title'=>'Иправить',
                        'par'=>'par=2&defectid='.$defectid,
                        'SubjectType'=>'ajax',
                        'div'=>'.DefectsBookInfoInputForm'
                    ));
                    $this->ExtMenuButton(array(
                        'name'=>'btnRedirect',
                        'controller'=>'DefectsBookState',
                        'action'=>'create',
                        'title'=>'Перенаправить',
                        'par'=>'par=5&defectid='.$defectid,
                        'SubjectType'=>'ajax',
                        'div'=>'.DefectsBookInfoInputForm'
                    ));
                    $this->ExtMenuButton(array(
                        'name'=>'btnReject',
                        'controller'=>'DefectsBookState',
                        'action'=>'create',
                        'title'=>'Отклонить',
                        'par'=>'par=3&defectid='.$defectid,
                        'SubjectType'=>'ajax',
                        'div'=>'.DefectsBookInfoInputForm'
                    ));
                }
                if(Yii::app()->user->id==$model->autorid){    
                    $this->ExtMenuButton(array(
                        'name'=>'btnReopen',
                        'controller'=>'DefectsBookState',
                        'action'=>'create',
                        'title'=>'Переоткрыть',
                        'par'=>'par=4&defectid='.$defectid,
                        'SubjectType'=>'ajax',
                        'div'=>'.DefectsBookInfoInputForm'
                    ));
                    $this->ExtMenuButton(array(
                        'name'=>'btnClose',
                        'controller'=>'DefectsBookState',
                        'action'=>'create',
                        'title'=>'Закрыть',
                        'par'=>'par=0&defectid='.$defectid,
                        'SubjectType'=>'ajax',
                        'div'=>'.DefectsBookInfoInputForm'
                    ));
                }
            }
        ?>
    </div>
    </div><!-- form body-->
</figure>
