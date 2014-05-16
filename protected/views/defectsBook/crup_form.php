<?php
Yii::app()->clientScript->registerScript('copy1', "
$('#chkbox_users_email_copy1').click(function(){
    $('.copy1').toggle();
    return false;
});
$('#chkbox_users_email_copy2').click(function(){
    $('.copy2').toggle();
    return false;
});
$('#chkbox_users_email_copy3').click(function(){
    $('.copy3').toggle();
    return false;
});
$('#chkbox_users_email_copy4').click(function(){
    $('.copy4').toggle();
    return false;
});
$('#chkbox_users_email_copy5').click(function(){
    $('.copy5').toggle();
    return false;
});
");
?>
<style>
    .row{
    border: 2px solid #C9E0ED;
    padding: 2px;
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
       -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    }
    .copy1 {
        display: none;
    }
    .copy2 {
        display: none;
    }
    .copy3 {
        display: none;
    }
    .copy4 {
        display: none;
    }
    .copy5 {
        display: none;
    }
</style>

<figure class="Form"> 
    <header id="Header">Новый дефект
        <span style="float:right; margin:2px;">
        <?php
            echo CHtml::imageButton(
                Yii::app()->request->baseUrl.'/images/Xmin.png',
                array('id'=>'esc',
                    'onclick'=>'$(\'.Form\').remove()'
                )
            );
        ?>
        </span>
    </header>
    <div id="Body">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'defects-book-form',
                'enableAjaxValidation'=>true,
                //'enableClientValidation'=>true,
                'htmlOptions' =>array('enctype'=>'multipart/form-data'),         // говорим что форма может работать с файлами
            ));
            echo $form->errorSummary($model);
        ?>
        <div class="row">
            <?php
                echo $form->labelEx($model,'where');
                echo $form->error($model,'where');
                echo $form->textField($model,'where',
                        array('style'=>'width:40%',
                            'maxlength'=>255
                            )
                    );

                echo $form->labelEx($model,'mnemoid');
                echo $form->error($model,'mnemoid');
                echo CHtml::activeDropDownList($model,
                    'mnemoid',
                    $model->GetMnemoList(),
                    array('style'=>'width:20%',
                    )
                ).' ';
                foreach(SmkProjectUnits::model()->with('ReestrUnitName')->findAll('projectid='.$projectid) as $row=>$val){//сформируем список шкафов проекта
                    $list[$val['unitid']]=$val['ReestrUnitName']['caption'];
                }
                if(!isset($list)) $list[60]='-';//если шкафов в проекте не найдено - сформируем 60-й номер шкафа (в таблице базы 60 - никакой шкаф)
                echo $form->labelEx($model,'unitid');
                echo $form->error($model,'unitid');
                echo CHtml::activeDropDownList($model,
                    'unitid',
                    $list,
                    array('style'=>'width:20%',
                    )
                );
            ?>
        </div>
        <div class="row">
            <?php
                echo $form->labelEx($model,'priority');
                echo $form->error($model,'priority');
                echo $form->dropDownList($model,
                    'priority',
                    $model->GetPriorityList()
                );
            ?>
        </div>
        <div class="row">
            <?php 
                echo $form->labelEx($model,'describe');
                echo $form->error($model,'describe');
                echo $form->textArea($model,'describe',
                        array('style'=>'width:100%',
                            'maxlength'=>255
                            )
                    );
            ?>
            <?php 
                echo $form->labelEx($model,'linkrd');
                echo $form->error($model,'linkrd');
                echo $form->textArea($model,'linkrd',
                        array('style'=>'width:100%',
                            'maxlength'=>255
                            )
                    );
            ?>
        </div>
        <div class="row">
            <?php
                echo 'Если есть необходимость - можно приложить скан документа';
                echo $form->fileField($model,'attachepath');
                echo $form->error($model,'attachepath');
            ?>
        </div>
        <div class="row">
            <?php
                $list1[0]='-';
                $list2=CHtml::listData(SmkReklamation::model()->findAll(
                                array(
                                    'select'=>'id',
                                    'condition'=>'state=1'
                                )), 'id', 'id');
                $list=array_merge($list1,$list2);
                echo $form->labelEx($model,'defectvedomostid');
                echo $form->error($model,'defectvedomostid');
                echo CHtml::activeDropDownList($model,
                    'defectvedomostid',
                    $list,
                    $model->GetMnemoList()
                );
            ?>
        </div>
        <div class="row">
            <?php
                $userlist=$model->GetUsersList();
                $userlist[0]='-';
                echo $form->labelEx($model,'touserid');
                echo $form->error($model,'touserid').'</br>';
                echo CHtml::activedropDownList($model,
                    'touserid',
                    $userlist,
                    array(
                    )
                );
                echo Chtml::link('копия e-mail',
                        '#',
                        array('style'=>'float:right',
                            'id'=>'chkbox_users_email_copy1'
                        )
                    );
            ?>
        </div>
        <div class="row">
            <div class="copy1">
            <?php
                echo Chtml::label('Копия','users_email_copy1');
                echo Chtml::dropDownList(
                    'users_email_copy1',0,
                    $userlist
                );
                echo Chtml::link('еще копия',
                        '#',
                        array('style'=>'float:right',
                            'id'=>'chkbox_users_email_copy2'
                        )
                    );
            ?>
            </div>
            <div class="copy2">
            <?php
                echo Chtml::label('Копия','users_email_copy2');
                echo Chtml::dropDownList(
                    'users_email_copy2',0,
                    $userlist
                );
                echo Chtml::link('еще копия',
                        '#',
                        array('style'=>'float:right',
                            'id'=>'chkbox_users_email_copy3'
                        )
                    );
            ?>
            </div>
            <div class="copy3">
            <?php
                echo Chtml::label('Копия','users_email_copy3');
                echo Chtml::dropDownList(
                    'users_email_copy3',0,
                    $userlist
                );
                echo Chtml::link('еще копия',
                        '#',
                        array('style'=>'float:right',
                            'id'=>'chkbox_users_email_copy4'
                        )
                    );
            ?>
            </div>
            <div class="copy4">
            <?php
                echo Chtml::label('Копия','users_email_copy4');
                echo Chtml::dropDownList(
                    'users_email_copy4',0,
                    $userlist
                );
                echo Chtml::link('еще копия',
                        '#',
                        array('style'=>'float:right',
                            'id'=>'chkbox_users_email_copy5'
                        )
                    );
            ?>
            </div>
            <div class="copy5">
            <?php
                echo Chtml::label('Копия','users_email_copy5');
                echo Chtml::dropDownList(
                    'users_email_copy5',0,
                    $userlist
                );
            ?>
            </div>
        </div>
        <div class="buttons">
            <?php
                echo CHtml::submitButton(
                        $model->isNewRecord ? 'Создать' : 'Обновить',
                        array('style'=>'float:right')
                    );
            ?>
        </div>
        <div>.</div>
        <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>