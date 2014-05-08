<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                                        'id' => 'dlgselectprjstep',
                                                        'options' => array(
                                                        'title' => 'Выбор активного этапа проекта',
                                                        'autoOpen' => false,//true,
                                                        'modal' => true,
                                                        'resizable'=> false,
                                                    ),
                    ));
    $form=$this->beginWidget('CActiveForm', array(
                                                'id'=>'smk-projects-form',
                                                'enableAjaxValidation'=>false,
                                                'htmlOptions'=>array(
                                                'class'=>'form',
                                            )
                            ));
    echo 'Этап';
    $model= SmkProjectStep::model()
        ->with('SmkProjectStepName')
        ->findAll(array(
            'condition'=>'projectid='.Yii::app()->user->getState('activeproject')
            )
        );
    $data = CHtml::listData($model,'stepid',function($model){
        return CHtml::encode($model->SmkProjectStepName['name']);
    });
    echo CHtml::dropDownList('Step','1',$data,array('style'=>'width:100%'));
    //echo $form->error($model,'Name');
    echo CHtml::submitButton('Выбрать');

    $this->endWidget();    
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
    
    
    
    
    
    
    
