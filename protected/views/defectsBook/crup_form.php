<figure class="Form"> 
    <header id="Header">Новый дефект
        <span style="float:right; margin:0;">
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
                'enableClientValidation'=>true,
                'htmlOptions' =>array('enctype'=>'multipart/form-data'),         // говорим что форма может работать с файлами
            ));
            echo $form->errorSummary($model);
        ?>
        <div id="success"></div>
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
                
                echo $form->labelEx($model,'unitid');
                echo $form->error($model,'unitid');
                echo CHtml::activeDropDownList($model,
                    'unitid',
                    $model->GetUnitList(),
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
                        array('style'=>'width:95%',
                            'maxlength'=>255
                            )
                    );
            ?>
        </div>
        <div class="row">
            <?php 
                echo $form->labelEx($model,'linkrd');
                echo $form->error($model,'linkrd');
                echo $form->textArea($model,'linkrd',
                        array('style'=>'width:95%',
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
                echo $form->labelEx($model,'touserid');
                echo $form->error($model,'touserid').'</br>';
                echo CHtml::activedropDownList($model,
                    'touserid',
                    $userlist,
                    array(
                    )
                );
            ?>
        </div>
        <div class="row">
            <?php
                echo Chtml::checkBox('chkbox_users_email_copy1');
                echo Chtml::label('Копия','users_email_copy1');
                echo Chtml::dropDownList(
                    'users_email_copy1',0,
                    $userlist
                ).'</br>';

                echo Chtml::checkBox('chkbox_users_email_copy2');
                echo Chtml::label('Копия','users_email_copy2');
                echo Chtml::dropDownList(
                    'users_email_copy2',0,
                    $userlist
                ).'</br>';

                echo Chtml::checkBox('chkbox_users_email_copy3');
                echo Chtml::label('Копия','users_email_copy3');
                echo Chtml::dropDownList(
                    'users_email_copy3',0,
                    $userlist
                ).'</br>';

                echo Chtml::checkBox('chkbox_users_email_copy4');
                echo Chtml::label('Копия','users_email_copy4');
                echo Chtml::dropDownList(
                    'users_email_copy4',0,
                    $userlist
                ).'</br>';

                echo Chtml::checkBox('chkbox_users_email_copy5');
                echo Chtml::label('Копия','users_email_copy5');
                echo Chtml::dropDownList(
                    'users_email_copy5',0,
                    $userlist
                ).'</br>';
            ?>
        </div>
        <div class="row buttons">
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