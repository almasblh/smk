<?php
    $this->breadcrumbs=array(
            'Реестр ПГВР',
    );
?>
<h2>Реестр ПГВР</h2>
<div class="Menu">
    <?php
        $this->MenuButton('SmkProjects','create','Создать новый проект','','ajax','.InputForm');
    ?>
</div>
<div class="ProjectTable">    

<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smk-projects-grid',
	'dataProvider'=>$model->search(),
        'rowHtmlOptionsExpression'=>array($model,'getRowHtmlOptions'),          //метод модели
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'Npgvr',
                'type'=>'html',
                'value'=>'
                    CHtml::link($data->Npgvr,
                    CHtml::normalizeURL(array(
                        (\'SmkProjects/view&id=\'.$data->id))))
                        ',
                'htmlOptions'=> array('width'=>'70px')
            ),
            array('name'=>'Name',
                'type'=>'html',
                'value'=>array($model,'getName'),                               //метод модели
                //'htmlOptions'=> array('width'=>'150px'),
            ),
            array('name'=>'dogovor',
                'type'=>'html',
                'value'=>array($model,'getDogovor'),                            //метод модели
                //'htmlOptions'=> array('width'=>'150px'),
            ),
            array('name'=>'Works',
                'type'=>'html',
                'value'=>array($model,'getWorks'),                              //метод модели
                //'htmlOptions'=> array('width'=>'150px'),
            ),
            array('name'=>'customer',
                'type'=>'html',
                'value'=>array($model,'getCustomer'),                           //метод модели
                //'htmlOptions'=> array('width'=>'150px'),
            ),
            array('name'=>'end_customer',
                'type'=>'html',
                'value'=>array($model,'getEnd_customer'),                       //метод модели
                //'htmlOptions'=> array('width'=>'150px'),
            ),
            array('name'=>'object',
                'type'=>'html',
                'value'=>array($model,'getObject'),                             //метод модели
                //'htmlOptions'=> array('width'=>'150px'),
            ),
            array('name'=>'percentage_complet',
                'value'=>'sprintf("%0.2f",$data->percentage_complet)',
                'htmlOptions'=> array('width'=>'70px')
            )
	),
    ));
?>
</div>