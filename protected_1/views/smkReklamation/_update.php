<figure class="Form"> 
    <header id="Header">Редактирование рекламации
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
    <?php
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'smk-reklamation-status-form',
            'enableAjaxValidation'=>false,
        ));
        echo $form->errorSummary($model);
    ?>
        <div class="row">
                <?php
                    echo '<h4>'.$model->problemname.'</h4>';
                ?>
        </div>
        <div class="row">
                <?php
                    echo $form->labelEx($model,'projectid');
                    echo $form->dropDownList($model,
                        'projectid'
                        ,$model->GetPGVRList()
                        ,array('style'=>'width:100px')
                    );
                    echo $form->error($model,'projectid');
                ?>
        </div>
        <div class="row">
                <?php
                    echo $form->labelEx($model,'object');
                    echo $form->textArea($model,'object',
                            array('style'=>'width:90%',
                                'maxlength'=>255
                                )
                    );
                    echo $form->error($model,'object');
                ?>
        </div>
        <div class="row">
                <?php
                    echo $form->labelEx($model,'dogovor');
                    echo $form->textArea($model,'dogovor',
                            array('style'=>'width:90%',
                                'maxlength'=>255
                                )
                    );
                    echo $form->error($model,'dogovor');
                ?>
        </div>    
        <div class="row">
                <?php
                    echo $form->labelEx($model,'Контактное лицо - представитьель заказчика');
                    echo $form->textField($model,'contactFIO',
                            array('size'=>50,'maxlength'=>50)
                    );
                    echo $form->error($model,'contactFIO');
                ?>
        </div>
        <div class="row">
                <?php
                    echo $form->labelEx($model,'Контактный телефон представителя заказчика');
                    echo $form->textField($model,'contactTel',
                            array('size'=>30,'maxlength'=>50)
                    );
                    echo $form->error($model,'contactTel');
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