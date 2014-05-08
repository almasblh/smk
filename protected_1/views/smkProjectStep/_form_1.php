<figure class="Form">
    <header id="Header">Новый этап
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
	'id'=>'smk-project-step-form',
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
                echo $form->labelEx($model,'stepid');
                echo $form->dropDownList(
                        $model,
                        'stepid',
                        CHtml::listData(
                            SmkProjectStepName::model()->findAll(array('order'=>'name','condition'=>'t.visible=1')),
                            'id',
                            'name'
                        )
                    );
                echo $form->error($model,'stepid');
                /*if($this->EnableForCurrentUser('SmkProjectStepName','create'))
                    echo CHtml::link('Нет в списке? -> Добавить новый этап в список',
                                CHtml::normalizeUrl(array('SmkProjectStepName/create'))
                            )
                 * 
                 */
            ?>

            <?php
                echo $form->labelEx($model,'stepcomment');
                echo $form->textField($model,'stepcomment',array('size'=>'30%','maxlength'=>255));
                echo $form->error($model,'stepcomment');
            ?>
	</div>    
	<div class="row">
		<?php
                    echo $form->labelEx($model,'datestart');
                    echo $form->dateField($model,
                        'datestart',
                        array('value'=>Yii::app()->dateFormatter->format('yyyy-MM-dd', getdate()[0])
                        ));
                    echo $form->error($model,'datestart');
                ?>
	</div>

	<div class="row">
		<?php 
                    echo $form->labelEx($model,'datestop');
                    echo $form->dateField($model,
                            'datestop',
                            array('value'=>Yii::app()->dateFormatter->format('yyyy-MM-dd', getdate()[0])
                        ));
                    echo $form->error($model,'datestop');
                ?>
	</div>

    <div class="row">
        <?php
            echo $form->labelEx($model,'curatorid');
            echo $form->dropDownList(
                    $model,
                    'curatorid',
                    CHtml::listData(
                        ServUsers::model()->findAll(),
                        'id',
                        'FIO'
                    )
                );
            echo $form->error($model,'curatorid');
        ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton(
                $model->isNewRecord ? 'Создать' : 'Сохранить',
                array('style'=>'float:right')
            );
        ?>
    </div>
            <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>