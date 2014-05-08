<?php
    $this->beginWidget(
        'zii.widgets.jui.CJuiDialog',
        array(
            'id' => 'defect_list',
            'options' => array(
            'title' => 'Дефект',
            'autoOpen' => true,
            'modal' => true,
            'resizable'=> false,
            ),
        )
    );
echo 'assa';
    /*$as=$data->search($defectid);
    $this->widget(
        'zii.widgets.grid.CGridView',
        array(
            'id'=>'defects-status-grid',
            'dataProvider'=>$as,
            'columns'=>array(
                'id',
                array('name'=>'comment',
                    'value'=>'$data->comment',
                    //'headerHtmlOptions'=>array('style'=>'width: 2%; text-align:center;'),
                    'htmlOptions'=>array('style'=>'text-align:center;'),
                    //'filter'=>$prior,
                    //'filter' => CHtml::listData(ServUsersDolgnost::model()->findAll(), 'id', 'name'),
                ),

            )
	)
    );
    $this->endWidget();
 * 
 */
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>