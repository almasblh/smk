<style>
   .SmkProjectsFigure {
    background: #E5ECF9; /* Цвет фона */
    padding: 2px; /* Поля вокруг */
    margin: 0 2px 2px 0; /* Отступы */
    border: 1px solid blue;
    height: 100%;
   }
   .SmkProjectsFigcaption {
    color: #0; /* Цвет текста */
   }
   .SmkProjectsAside{
    float: left;
    width: 20%; /* Ширина */
    border: 1px solid blue;
    border-color: 0;
    height: 97%;
    overflow: auto; 
   }
   .SmkProjectsSection{
    float: left;
    width: 79%; /* Ширина */
    height: 97%;
    overflow: auto; 
    border: 1px solid blue;
   }
</style>
<?php
    $this->breadcrumbs=array(
            'Реестр ПГВР',
    );
?>
<div class="Menu">
    <?php
        $this->MenuButton('SmkProjects','create','Создать новый проект','','ajax','.InputForm');
    ?>
</div>
<div class="ProjectTable">    
<figure class="SmkProjectsFigure">
    <figcaption class="SmkProjectsFigcaption"><h3>Реестр ПГВР</h3></figcaption>
    <aside class="SmkProjectsAside">
    <?php
        echo CHtml::link('Все',
                array('index','par'=>'all')
        ).' ';
        echo CHtml::link('Открытые',
                array('index','par'=>'open')
        ).' ';
        echo CHtml::link('Выполненные',
                array('index','par'=>'close')
        ).' ';
        echo CHtml::link('Негарантийные',
                array('index','par'=>'nogaranty')
        );
        $dataProvider=$model->srch(isset($_GET['par'])?$_GET['par']:0);
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'smk-projects-grid',
            'dataProvider'=>$dataProvider,//$model->srch(isset($_GET['par'])?$_GET['par']:0),
            'rowHtmlOptionsExpression'=>array($model,'getRowHtmlOptions'),      //метод модели
            'filter'=>$model,
            'ajaxUrl' => array($dataProvider->pagination->route),
            'columns'=>array(
                array('name'=>'Npgvr',
                    'type'=>'raw',
                    'value'=>array($model,'getNpgvrValue'),
                    'htmlOptions'=> array('width'=>'20%')
                ),
                array('name'=>'Name',
                    'type'=>'html',
                    'value'=>array($model,'getName'),                           //метод модели
                ),
                array('name'=>'percentage_complet',
                    'value'=>'sprintf("%0.2f",$data->percentage_complet)',
                    'htmlOptions'=> array('width'=>'15%')
                )
            ),
        ));
?>
    </aside>
    <section class="SmkProjectsSection">
    <?php
        if(($value=Yii::app()->cache->get('SmkProjectSectionValue'))!==false)       // выведем в окно содержимое кеша, если есть
                echo $value;
    ?>
    </section>
</figure>
</div>

<?php
    /*             array('name'=>'dogovor',
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
     * 
     */
?>