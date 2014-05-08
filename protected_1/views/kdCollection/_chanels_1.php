<?php
    $this->breadcrumbs=array(
            'Kd Collections'=>array('index'),
            'Каналы',
    );
?>

<h1>

<?php
    echo 'Список каналов шкафа - '.
        $modelSmkProjectUnit->ReestrUnitName->name.
        ' сер № - '.
        $modelSmkProjectUnit->vkpeN.
        ' проекта - '.
        $modelSmkProjectUnit->SmkProjects->Npgvr
?>
</h1>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kd-collection-grid',
	'dataProvider'=>$model->search($unitid),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'bascet'
                ,'type'=>'text'
                ,'value'=>'$data->bascet'
                //,'filter' => CHtml::listData(ServUsersDolgnost::model()->findAll(), 'id', 'name')
                ,'htmlOptions'=>array(
                    'style'=>'width:3%',
                )
            ),
            array('name'=>'ninbascet'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'width:3%',
                )
                //,'filter' => array('1'=>'1','2'=> '2','3'=>'3','4'=>'4')
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
