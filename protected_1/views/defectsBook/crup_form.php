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
                    'enableAjaxValidation'=>false,
            ));
            echo $form->errorSummary($model);
        ?>
        <div class="row">
            <?php echo $form->labelEx($model,'mnemoid');
                echo CHtml::activeDropDownList($model,
                    'mnemoid',
                    $model->GetMnemoList(),
                    array(
            //            'options'=>array(isset($locate_commision_PDK['commision']['head'])?$locate_commision_PDK['commision']['head']:0 => Array('selected' => 'selected')),
                    )
                );
                 echo $form->error($model,'mnemoid');
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'unitid');
                echo CHtml::activeDropDownList($model,
                    'unitid',
                    $model->GetUnitList(),
                    array(
            //            'options'=>array(isset($locate_commision_PDK['commision']['head'])?$locate_commision_PDK['commision']['head']:0 => Array('selected' => 'selected')),
                    )
                );
                 echo $form->error($model,'unitid');
            ?>
        </div>
        <div class="row">
            <?php 
                echo $form->labelEx($model,'describe');
                echo $form->textArea($model,'describe',
                        array('style'=>'width:100%',
                            'maxlength'=>255
                            )
                    );
                echo $form->error($model,'describe');
            ?>
        </div>
        <div class="row">
            <?php
                echo $form->labelEx($model,'priority');
                echo $form->dropDownList($model,
                    'priority',
                    $model->GetPriorityList()
                );
                echo $form->error($model,'priority');
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
                echo CHtml::activeDropDownList($model,
                    'defectvedomostid',
                    $list,
                    $model->GetMnemoList(),
                    array(
            //            'options'=>array(isset($locate_commision_PDK['commision']['head'])?$locate_commision_PDK['commision']['head']:0 => Array('selected' => 'selected')),
                    )
                );
                echo $form->error($model,'defectvedomostid');
            ?>
        </div>
        <div class="row">
            <?php
                echo $form->labelEx($model,'touserid');
                echo CHtml::activedropDownList($model,
                    'touserid',
                    $model->GetUsersList(),
                    array(
                    )
                );
                echo $form->error($model,'touserid');
            ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton(
                        $model->isNewRecord ? 'Создать' : 'Обновить',
                        array('style'=>'float:right')
                    );
            ?>
        </div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>