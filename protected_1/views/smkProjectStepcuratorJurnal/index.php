<?php
    $top=rand(300,400);
    $left=rand(300,400);
?>
<div  style="position:fixed; top:<?php echo $top; ?>px; left:<?php echo $left; ?>px;">  
    <table class="StepJurnal" style="position:fixed;">
        <tr>
            <td id="leftup" style="width:10px"></td>
            <td id="rightup">
                Записи журнала
                <span style="float:right; margin:0;">
                <?php
                    echo CHtml::imageButton(
                        Yii::app()->request->baseUrl.'/images/Xmin.png',
                        array('id'=>'esc',
                            'onclick'=>'$(\'.StepJurnal\').remove()'
                        )
                    );
                ?>
                </span>
            </td>
        </tr>
        <tr>
            <td id="leftdown"></td>
            <td id="rightdown">
<?php       $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'jurnal-steps-grid',
                'dataProvider'=>$model,
                'columns'=>array(
                    array('name'=>'daterecord',
                        'header'=>'Дата записи',
                        'value'=>'Yii::app()->dateFormatter->format(\'d MMM yyyyг. hh:mm \',$data->daterecord)',
                        'htmlOptions'=>array(
                            'style'=>'text-align:center',
                        )
                    ),
                    array('name'=>'comment',
                        'header'=>'Коментарии',
                        'value'=>'$data->comment',
                        'htmlOptions'=>array(
                            'style'=>'width:70%',
                        )
                    ),
                    array('name'=>'current_percent',
                        'header'=>'Выполнено %',
                        'value'=>'$data->current_percent',
                        'htmlOptions'=>array(
                            'style'=>'text-align:center',
                        )
                    ),
                ),
            ));
            //if((Yii::app()->user->id==217) || ($model->kuratorid == Yii::app()->user->id))
                $this->MenuButton('SmkProjectStepcuratorJurnal','create','Добавить запись','projectstepid='.$model->id,'ajax','#AddRecord');
?>
                <div id="AddRecord"></div>
            </td>
        </tr>
    </table>
</div>
