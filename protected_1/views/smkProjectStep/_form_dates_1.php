<figure class="Form" style="position:absolute;">
    <header id="Header">Редактирование этапа
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
	'id'=>'smk-project-step-form-dates',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
    ));
?>
    <?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'datestart');
                    echo $form->dateField($model,
                        'datestart'
                        );
                    echo $form->error($model,'datestart');
                ?>
	</div>

	<div class="row">
		<?php 
                    echo $form->labelEx($model,'datestop');
                    echo $form->dateField($model,
                            'datestop'
                        );
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
                    'Сохранить',
                    array('style'=>'float:right')
                );
            ?>
        </div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>