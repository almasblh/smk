<?php
    $this->breadcrumbs=array(
        'Список шкафов проекта',
    );
?>

<h1>Список шкафов проекта</h1>

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smk-project-units-grid'
	,'dataProvider'=>$model->search($projectid)
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
        )
    ));
?>
