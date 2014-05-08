<?php
Yii::app()->clientScript->registerScriptFile('js/SmkProjectUnits/Admin.js');// регистрируем javascript файл
$this->breadcrumbs=array(
	'Шкафы проекта'=>array('index'),
	'Manage',
);
?>
<h1>Шкафы проекта
    <?php
        echo Yii::app()->user->GetState('activeprojectname');
    ?>
</h1>

<div class="Menu">
    <?php
        $this->MenuButton('SmkProjectUnits','create','Добавить еще шкаф','id='.$model->id,'ajax','.InputForm');
    ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smk-project-units-grid'
	,'dataProvider'=>$model->search()
	,'filter'=>$model
	,'columns'=>array(
            array(
                'name'=>'ReestrUnitName.caption'
                ,'type'=>'html'
                ,'value'=>'
                    CHtml::link($data->ReestrUnitName[\'caption\'],
                    CHtml::normalizeURL(array(
                        (\'smkProjectUnits/view&id=\'.$data->id))))
                        '
            )
            ,array(
                'name'=>'ReestrUnitName.ReestrSystemName.caption'
            )
            ,array(
                'name'=>'vkpeN',
                'value'=>'explode(\'.\',$data->SmkProjects[\'Npgvr\'])[0].sprintf(\'%03d\',$data->vkpeN)',
            )
/*            ,array(
                'class'=>'CButtonColumn',
                'header'=>'Действия',
                'template'=>'{btnChanelsShow}',
                'buttons'=>array(
                    'btnChanelsShow' => array(
                        //'url'=>'$data->id',
                        'url'=>'CHtml::normalizeURL(array(\'kdCollection/admin&id=\'.$data->id))',
                        'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'data'=>array(
                                    'id'=>'$data->id'
                                    ,'chv'=>1
                                ),
                                'update'=>'#Chanels',
                                'error' => 'js:function(error)   {console.log(\'error:\'+error)}',
                                'success'=>'js:function(response){console.log(\'success:\'+response);}',
                             ),
                        ),

                        'label'=>'Посмотреть каналы',     //Text label of the button.
//                        'click'=>'function(){
//                            sendAjaxPostUpdate(this, "Chanels");
//                            return false;
//                        }',
                        //'visible'=>'...',   //A PHP expression for determining whether the button is visible.
                    ),
                ),
            )
 * 
 */
            ,array(
                'class'=>'CButtonColumn',
            )
        )
    )
);
?>
