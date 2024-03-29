<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'chanel-view-grid',
	'dataProvider'=>$model->srchProbiv(),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'bascet'
                ,'type'=>'text'
                ,'value'=>'$data->bascet'
                ,'htmlOptions'=>array(
                    'style'=>'width:3%',
                )
            ),
            array('name'=>'ninbascet'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'width:3%',
                )
            ),
            array('name'=>'nio'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'width:3%',
                )
            ),
            array('name'=>'Elements.p_n'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'width:9%',
                )
            ),
            array('name'=>'type'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'width:9%',
                )
            ),
            array('name'=>'chanelname'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'text-align:left',
                )
            ),
	),
));

?>

