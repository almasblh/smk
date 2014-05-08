<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'newdefect-form',
        //'action'=>CHtml::normalizeUrl(array('DefectsBook/Addnewdefect')),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
    ));
?>
<div class="form" style="text-align: left">
<?php

    echo $form->errorSummary($model);
    
//    echo $form->hiddenField($model,
//                '1'
 //           );

    echo $form->labelEx($model,'mnemoid');
    echo $form->dropDownList($model,
                            'mnemoid',
                            CHtml::listData(
                                    PrMnemoschemaName::model()->findAll(),
                                    'id',
                                    'name'
                            ),
                            array(
                            //           'style'=>'width:100%'
                                )
            );
    echo $form->error($model,'nodeid');

    echo $form->labelEx($model,'nodeid');
    echo $form->dropDownList($model,
                            'nodeid',
                            CHtml::listData(
                                    PrNodesName::model()->findAll(),
                                    'id',
                                    'name'
                            ),
                            array(
//                                      'style'=>'width:100%'
                                )
            );
    echo $form->error($model,'nodeid');

    echo $form->labelEx($model,'priority');
    echo $form->dropDownList($model,
                            'priority',
                            $model->priority,
                            array(
//                                        'style'=>'width:100%'
                            )
        );
    echo $form->error($model,'priority');

    echo $form->labelEx($model,'describe');
    echo $form->textArea($model,
                        'describe',
                        array(
                            'style'=>'width:100%'
                        )
        );
    echo $form->error($model,'describe');

    echo $form->labelEx($model,'comment');
    echo $form->textArea($model,
                        'comment',
                        array(
                            'style'=>'width:100%'
                        )
        );
    echo $form->error($model,'comment');

    echo $form->labelEx($model,'defectvedomost');
    echo $form->checkBox($model,'defectvedomost');
    echo $form->error($model,'defectvedomost');

    echo $form->labelEx($model,'tocategoryid');
    echo $form->dropDownList($model,
                            'tocategoryid',
                            CHtml::listData(
                                    ServUsersCategory::model()->findAll(),
                                    'id',
                                    'name'
                            ),
                            array(
//                              'style'=>'width:100%'
                            )
        );
    echo $form->error($model,'tocategoryid');

    echo $form->labelEx($model,'touserid');
    echo $form->dropDownList($model,
                            'touserid',
                            CHtml::listData(
                                    ServUsers::model()->findAll(),
                                    'id',
                                    'FIO'
                            ),
                            array(
//                                'style'=>'width:100%'
                            )
        );
    echo $form->error($model,'tocategoryid');
    echo $form->error($model,'touserid');
?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Создать'); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
