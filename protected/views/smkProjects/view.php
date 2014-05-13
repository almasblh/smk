<style>
    .SmkProjectDescribeName{
        color: 0;
        background-color: yellow;
        font-size:1.2em;
        font-style: oblique;
    }
</style>
<?php

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/gantti/gantti.css');
Yii::app()->clientScript->registerScript('moreinfo', "
$('.more_button').click(function(){
    $('.More').toggle();
    return false;
});
");
Yii::app()->clientScript->registerScript('gantti', "
$('.Gantti_button').click(function(){
    $('.gantti').toggle();
    return false;
});
");
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
    $this->ExtMenuButton(array(
        'name'=>'btnProject',
        'controller'=>'SmkProjects',
        'action'=>'view',
        'title'=>'Проект',
        'par'=>'id='.$model->id
    ));
    $this->ExtMenuButton(array(
        'name'=>'btnEditProject',
        'controller'=>'SmkProjects',
        'action'=>'update',
        'title'=>'Редактировать план',
        'par'=>'id='.$model->id,
        'SubjectType'=>'ajax',
        'div'=>'.SmkProjectInputForm'
    ));
    $rid=Yii::app()->db->createCommand('SELECT userid AS `0` FROM smk_project_email_list WHERE userid='.Yii::app()->user->id.' AND projectid='.$model->id.';')->queryRow();
    $this->ExtMenuButton(array(
        'controller'=>'DefectsBook',
        'action'=>'index',
        'title'=>'Журнал дефектов',
        'par'=>'id='.$model->id,
        'bkcolor'=>$btnDefectColor
    ));
    $this->ExtMenuButton(array(
        'controller'=>'SmkProjectUnits',
        'action'=>'index',
        'title'=>'Список шкафов'
    ));
    $this->ExtMenuButton(array(
        'controller'=>'Konstrucktor',
        'action'=>'index',
        'title'=>'Констр'
    ));
    $this->ExtMenuButton(array(
        'controller'=>'OimPmiTests',
        'action'=>'index',
        'title'=>'ОИиМ'
    ));
    $this->ExtMenuButton(array(
        'controller'=>'SmkProjects',
        'action'=>'otchets',
        'title'=>'Вывести план в Excel',
        'par'=>'id='.Yii::app()->user->getState('activeproject').'&sw=pgvr&korrect=0'
    ));
    if(!isset($rid[0]))
        $this->ExtMenuButton(array(
            'controller'=>'SmkProjects',
            'action'=>'view',
            'title'=>'ВКЛЮЧИТЬ в рассылку',
            'par'=>'id='.$model->id.'&email=1'
        ));
    else
        $this->ExtMenuButton(array(
            'controller'=>'SmkProjects',
            'action'=>'view',
            'title'=>'УДАЛИТЬ из рассылки',
            'par'=>'id='.$model->id.'&email=0'
        ));
?>
</div>
<div class="SmkProjectInputForm ui-widget-content"></div>
<div class="ProjectInfo">  
<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            array('name'=>'Name',
                'cssClass'=>'SmkProjectDescribeName'
            ),
            'Npgvr',
            'dogovor',
            'project',
            'Works',
            'customer',
            'object',
            array('name'=>'path',
                'type'=>'html',
                'value'=>$model->path
            ),
            array('name'=>'kuratorid',
                'type'=>'html',
                'value'=>$model->getUserLink($model->kurator),
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

        ),
    ));
    echo Chtml::button('еще инфо \/',
            array('name'=>'more_button',
                  //  'style'=>'float:right'
                'class'=>'more_button'
                )
            );
    ?>
<div class="More" style="display:none">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
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
</div>

<h3>Этапы проекта:</h3>
<div class="StepMenu">
    <?php
        $this->ExtMenuButton(array(
            'name'=>'btnAddNewStepProject',
            'controller'=>'SmkProjectStep',
            'action'=>'create',
            'title'=>'Добавить еще этап',
            'par'=>'projectid='.$model->id,
            'SubjectType'=>'ajax',
            'div'=>'.SmkProjectStepInputForm'
        ));
    ?>
</div>
<div class="SmkProjectStepInputForm"></div>
<div class="ProjectTable">
<?php
    $this->renderPartial(
        '//smkProjectStep/index',array(
            'model'=>$model,
        )//,
        //false,
        //true
    );
?>
</div>
<?php
    echo Chtml::button('Диаграмма Ганта \/',
        array('name'=>'gantti_button',
                //'style'=>'float:right'
                'class'=>'gantti_button'
            )
        );
?>
<div class="Gantti" style="display:none">
<?php
    echo $gantti;
?>
</div>
</div>

