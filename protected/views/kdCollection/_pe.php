<?php
    $this->breadcrumbs=array(
            'Kd Collections'=>array('index'),
            'Список элементов',
    );
?>

<h1>

<?php
    echo 'Список элементов - '.
        $modelSmkProjectUnit->ReestrUnitName->name.
        ' сер № - '.
        $modelSmkProjectUnit->vkpeN.
        ' проекта - '.
        $modelSmkProjectUnit->SmkProjects->Npgvr

?>
</h1>
<div class="Menu">
    <?php
        $this->MenuButton('KdCollection','admin','Вывод списка в Excel','id='.$unitid.'&sw=excel');
    ?>
</div>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,

	'columns'=>array(
            'id',
            array('name'=>'pos_str'
                ,'type'=>'text'
                ,'value'=>'$data->pos_str'
                ,'htmlOptions'=>array(
                    'style'=>'text-align:left',
                )
            ),
            array('name'=>'element_str'
                ,'type'=>'text'
                ,'htmlOptions'=>array(
                    'style'=>'text-align:left',
                )
            ),
            array('name'=>'manufacture_str'
                ,'type'=>'text'

            ),
            array('name'=>'count_int'
                ,'type'=>'text'
            ),
	),
    ));
?>
