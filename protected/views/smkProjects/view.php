<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/gantti/gantti.css');

$this->breadcrumbs=array(
	'Список проектов'=>array('index'),
	$model->Name,
);

    Yii::app()->clientScript->registerScript('search',
    "
        $('.search-form form').submit(function(){
                $('#steps-project-grid').yiiGridView('update', {
                        data: $(this).serialize()
                });
                return false;
        });
    ");
    Yii::app()->clientScript->registerScript('upadate',
    "
        $('.search-form form').submit(function(){
                $('#steps-project-grid').yiiGridView('update', {
                        data: $(this).serialize()
                });
                return false;
        });
    ");
//------------JS-----------------------------------
// функция отображения Записей журнала на странице
    $js_jurnal_view ='function() {
        var url = $(this).attr(\'href\');
        $.get(url, function(response) {
            $("#jurnal").html(response);
        });
        return false;
    }';
// функция создания новой записи в журнале
    $js_jurnal_create_record ='function() {
        var url = $(this).attr(\'href\');
        $.get(url, function(response) {
            $("#jurnal").html(response);
        });
        return false;
    }';
// функция редактирования 
    $js_project_step_update ='function() {
        var url = $(this).attr(\'href\');
        $.get(url, function(response) {
            $("#jurnal").html(response);
        });
        return false;
    }';
//------------JS-----------------------------------
?>

<h2>Проект №<?php echo Yii::app()->user->getState('activeprojectname').', '.'ПГВР № '.Yii::app()->user->getState('activeprojectpgvr')?></h2>
<?php
    if($model->approved==0){                                                    // если план не утвержден
        echo '<h2 style="background-color:#ff0000; color:#ffffff; text-align:center;" >Есть коректировки плана, но план не утвержден</h2>';
    }
    else{
        echo '<h2 style="background-color:#00ff00; color:#004f00; text-align:center;" >План утвержден</h2>';
    }
?>
<div class="Menu">
<?php
    $this->MenuButton('SmkProjects','index','Проекты');
    $this->MenuButton('SmkProjects','otchets','Вывести план в Excel','id='.Yii::app()->user->getState('activeproject').'&sw=pgvr&korrect=0');
    $this->MenuButton('SmkProjects','update','Редактировать план','id='.$model->id,'ajax','.InputForm');
    $rid=Yii::app()->db->createCommand('SELECT userid AS `0` FROM smk_project_email_list WHERE userid='.Yii::app()->user->id.' AND projectid='.$model->id.';')->queryRow();
    if(!isset($rid[0]))
        $this->MenuButton('SmkProjects','view','ВКЛЮЧИТЬ в рассылку','id='.$model->id.'&email=1');
    else
        $this->MenuButton('SmkProjects','view','УДАЛИТЬ из рассылки','id='.$model->id.'&email=0');
?>
</div>
<div class="ProjectInfo">  
<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'Name',
            'Npgvr',
            'dogovor',
            'project',
            'Works',
            'customer',
            'object',
            array('name'=>'path',
                'type'=>'html',
                'value'=>//CHtml::link($model->path,
                            $model->path
            ),
            array('name'=>'kuratorid',
                'type'=>'html',
                'value'=>CHtml::link(CHtml::encode($model->kurator["FIO2"]),
                            array("ServUsers/view","id"=>$model->kuratorid)
                        )
            ),
            array('name'=>'managerid',
                'type'=>'html',
                'value'=>$model->getManagerLine(),                              //метод модели
            ),
            array('name'=>'signatureshefOUPid',
                'type'=>'html',
                'value'=>$model->getshefOUPLine(),                              //метод модели
            ),
            array('name'=>'date_make',
                'value'=>$model->date_make
            ),            
            array('name'=>'percentage_complet',
                'type'=>'raw',
                'value'=> sprintf('%.2f',$model->percentage_complet),
                'cssClass'=>($model->percentage_complet<0) ? 'redBackground' : '',
            ),
            array('name'=>'subdivision',
            ),            
            array('name'=>'datestart',
            ),            
            array('name'=>'datestop',
            ),            
            array('name'=>'dateagreement',
            ),            
            array('name'=>'datepayment1',
            ),            
            array('name'=>'datepayment2',
            ),            
            array('name'=>'datepayment3',
            ),            
            array('name'=>'dateTTN',
            ),            
            array('name'=>'nTTN',
            ),            
            array('name'=>'datesignatureTTN',
            ),            
            array('name'=>'datetorg12',
            ),            
            array('name'=>'dateendpnr',
            ),            
            array('name'=>'datefinanseact',
            ),            
            array('name'=>'prim',
            ), 
        ),
    ));
?>

<h3>Этапы проекта:</h3>
<div class="StepMenu">
    <?php
        $this->MenuButton('SmkProjectStep','create','Добавить еще этап','projectid='.$model->id,'ajax','.InputForm');
    ?>
</div>
<div class="ProjectTable">
<?php
        $this->renderPartial('//smkProjectStep/index',array(
            'model'=>$model,
        ));
?>
</div>
<?php
    echo $gantti;
?>
</div>
