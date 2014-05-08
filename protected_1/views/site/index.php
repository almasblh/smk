<?php
    $this->pageTitle=Yii::app()->name;

   $this->breadcrumbs=array(
            'Главная',
    );
?>

<h2>Список всех ролей пользователя в системе:</h2>
<div class="ProjectTable">
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-role-grid',
	'dataProvider'=>$model->search(Yii::app()->user->id),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'projectid',
                'type'=>'html',
                'value'=>'CHtml::link($data->SmkProjects[\'Npgvr\'],
                    CHtml::normalizeURL(array(
                        ($data->projectid)
                        ? \'SmkProjects/view&select=1&id=\'.$data->projectid.\'&projectstep=\'.$data->projectstepid
                        : \'SmkProjects/index\'
                        ))
                    )'
                ),
            array('name'=>'projectstepid',
                'type'=>'text',
                'value'=>'($data->projectstepid>0) ? $data->SmkProjectStepName[\'name\'] :"-"'
                ),
            array('name'=>'category',
                'type'=>'text',
                'value'=>'$data->ServUsersCategory[\'name\']'                
                ),
            array('name'=>'SmkProjects.percentage_complet',
                'type'=>'text',
                'cssClassExpression'=>'
                    ($data->SmkProjects[\'percentage_complet\']<100)
                        ? (($data->SmkProjects[\'percentage_complet\']<50)
                            ? (($data->SmkProjects[\'percentage_complet\']<10)
                                ? "redBackground"
                                : "blueBackground"
                                )
                            : "yellowBackground"
                            )
                        : "greenBackground"
                    '
            ),
	),
    ));
?>
</div>


    
