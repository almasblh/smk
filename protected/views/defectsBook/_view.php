
<div id="defectstatus">
<?php
$value='';
    echo CHtml::textField('defectid', $value);
//    if(isset($_GET['defectid'])){
    if($value<>''){
        $this->widget(
            'zii.widgets.grid.CGridView',
            array(
                'id'=>'defects-status-grid',
                'dataProvider'=>$model->search($value),
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
    }
?>
</div>    



