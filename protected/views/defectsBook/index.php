<?php
   
    Yii::app()->clientScript->registerScript('search',
    "$('.newdefect-button').click(function(){
	$('.search-form').toggle('slow');
	return false;
    });
    $('.search-form form').submit(function(){
            $('#smk-projects-grid').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });"
);

    $this->breadcrumbs=array(
            'Defects Books'=>array('index'),
            'Журнал дефектов',
    );
    echo '<h2>Журнал дефектов</h2><b />';
    
    echo CHtml::link('Создать новый дефект',
                '#',
                array('class'=>'newdefect-button')
    );
?>
<div class="search-form" style="display:none">
<?php
    $this->renderPartial(
        '_newdefect',
        array(
            'model'=>new NewDefectForm,
        )
    );
?>
</div>
<?php

    $stat=$model->status;
    $prior=$model->prior;
    $this->widget('zii.widgets.grid.CGridView',
        array(
            'id'=>'defects-book-grid',
            'dataProvider'=>$model->search(),

           'filter'=>$model,
           'columns'=>array(
                 array('name'=>'priority',
                    'value'=>'$data->prior[$data->priority]',
                    'headerHtmlOptions'=>array('style'=>'width: 2%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center'),
                    'filter'=>$prior,
                    //'filter' => CHtml::listData(ServUsersDolgnost::model()->findAll(), 'id', 'name'),
                ),
                 array('name'=>'curstate',
                    'type'=>'text',
                    'value'=>'$data->status[$data->curstate]',
                    'headerHtmlOptions'=>array('style'=>'width: 4%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    'filter' =>$stat,
                ),

                array('name'=>'mnemoid',
                    //'type'=>'text',
                    'value'=>'$data->PrMnemoschemaName->name',
                    'headerHtmlOptions'=>array('style'=>'width: 6%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array('name'=>'nodeid',
                    //'type'=>'text',
                    'value'=>'$data->PrNodesName->name',
                    'headerHtmlOptions'=>array('style'=>'width: 6%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
               array('name'=>'describe',
                    'type'=>'html',
                    'value'=>'$data->describe',
    /*                'htmlOptions'=>array(
                       'onclick'=>
                            CHtml::ajax(
                                array(
                                    'type' => 'POST',
                                    'update' => '#defectstatus',
                                    'url'=>CHtml::normalizeUrl(
                                        array(
                                            'Index',
                                        )
                                    ),
                                )
                            ),
                    ),
     * 
     */
            
                ),
                array('name'=>'autorid',
                    //'type'=>'text',
                    'value'=>'$data->ServUsers->fname',
                    'headerHtmlOptions'=>array('style'=>'width: 7%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
               array('name'=>'tocategoryid',
                    'value'=>'$data->ToCategory->name',
                    'filter' => CHtml::listData(ServUsersCategory::model()->findAll(), 'id', 'name'),
                    'headerHtmlOptions'=>array('style'=>'width: 7%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
                array('name'=>'touserid',
                    'value'=>'$data->ToUser->fname',
                    'headerHtmlOptions'=>array('style'=>'width: 7%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),            
                array('name'=>'createdate',
                    //'type'=>'text',
                    'value'=>'$data->createdate',
                    'headerHtmlOptions'=>array('style'=>'width: 7%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                ),
            ),
        )
    );
?>
