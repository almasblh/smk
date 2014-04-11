<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog'                             //модальное окно выбора активного проекта
        ,array(
            'id' => 'dlgselectprj',
            'options' => array(
                'title' => 'Выбор активного проекта и этапа',
                'autoOpen' => false,
                'modal' => true,
                'resizable'=> false,
            ),
        )
    );
        $form=$this->beginWidget('CActiveForm'
            ,array( 'id'=>'smk-projects-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'action' => array('site/select'),
    //            'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    'class'=>'form',
            )
        ));
            //echo $form->errorSummary($model);
            echo 'Проект';
            echo CHtml::dropDownList('Project'
                    ,'1'
                    ,CHtml::listData(
                        SmkProjects::model()->findAll(array('order'=>'Name'))
                        , 'id'
                        , 'Name'
                    )
                    ,array('style'=>'width:100%')
                    );
            //echo $form->error($model,'Name');
            echo CHtml::submitButton('Выбрать проект');

        $this->endWidget();    
    $this->endWidget('zii.widgets.jui.CJuiDialog');                             //конец модального окна выбора активного проекта

?>
