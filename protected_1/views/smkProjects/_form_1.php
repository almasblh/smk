<figure class="Form">
    <header id="Header">Редактирование (создание) проекта
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
                'id'=>'smk-projects-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            ));
            echo $form->errorSummary($model);
        ?>
        <div class="row">
                <?php
                echo $form->labelEx($model,'Name');
                echo $form->textField($model,'Name',array('size'=>'100%','maxlength'=>255));
                echo $form->error($model,'Name');
                ?>
        </div>
        <div class="row">
                <?php
                echo $form->labelEx($model,'Npgvr');
                echo $form->textField($model,'Npgvr',array('size'=>'100%','maxlength'=>255));
                echo $form->error($model,'Npgvr');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'dogovor');
                    echo $form->textArea($model,'dogovor',array('style'=>'width:100%'));
                    echo $form->error($model,'dogovor');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'project');
                    echo $form->textArea($model,'project',array('style'=>'width:100%'));
                    echo $form->error($model,'project');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'Works');
                    echo $form->textArea($model,'Works',array('style'=>'width:100%'));
                    echo $form->error($model,'Works');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'customer');
                    echo $form->textArea($model,'customer',array('style'=>'width:100%'));
                    echo $form->error($model,'customer');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'end_customer');
                    echo $form->textArea($model,'end_customer',array('style'=>'width:100%'));
                    echo $form->error($model,'end_customer');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'object');
                    echo $form->textArea($model,'object',array('style'=>'width:100%'));
                    echo $form->error($model,'object');
                ?>
        </div>
        <div class="row">
                <?php 
                    echo $form->labelEx($model,'path');
                    echo $form->textArea($model,'path',array('style'=>'width:100%','maxlength'=>255));
                    echo $form->error($model,'path');
                ?>
        </div>
        <div class="row">
            <?php
            $users_list=$model->GetUsersList();

                echo $form->labelEx($model,'kuratorid');
                echo $form->dropDownList(
                        $model,
                        'kuratorid',
                        $users_list
                        ,array('style'=>'width:45%'
                            ,'options'=>array(
                            Yii::app()->user->id
                            =>array('selected'=>true
                            )
                        ))
                    );
                echo $form->error($model,'kuratorid');
            ?>
        </div>
        <div class="row">
            <?php
                echo $form->labelEx($model,'managerid');
                echo $form->dropDownList(
                        $model,
                        'managerid',
                        $users_list
                        ,array('style'=>'width:45%'
                            ,'options'=>array(
                            Yii::app()->user->id
                            =>array('selected'=>true
                                )
                            )
                        )
                    );
                echo $form->error($model,'managerid');
            ?>
        </div>    
        <div class="row buttons">
                <?php echo CHtml::submitButton(
                        $model->isNewRecord ? 'Создать проект' : 'Сохранить проект',
                        array('style'=>'float:right')
                    );
                ?>
        </div>
        <div>.</div>
        <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>