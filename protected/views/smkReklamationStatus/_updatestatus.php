<figure class="Form">
    <header id="Header">Формирование нового статуса
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
	'id'=>'smk-reklamation-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' =>array('enctype'=>'multipart/form-data' ) // говорим что форма может работать с файлами
)); ?>

	<?php echo $form->errorSummary($modelstatus); ?>
        
	<div class="row">
            <?php   echo $form->labelEx($modelstatus,'Новый статус');
                    echo $form->dropDownList($modelstatus,
                        'statusid',
                        CHtml::listData(
                            ReestrReklamationStatusName::model()->findAll(),
                            'id',
                            'name'
                        )
                    );
                    echo $form->error($modelstatus,'statusid');
            ?>
	</div>
    	<div class="row">
		<?php echo $form->labelEx($modelstatus,'managercoment');
                    echo $form->textArea($modelstatus,'managercoment',
                            array('style'=>'width:90%',
                                )
                    );
                    echo $form->error($modelstatus,'managercoment');
                ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelstatus,'datestart'); ?>
		<?php echo $form->dateField($modelstatus,'datestart'); ?>
		<?php echo $form->error($modelstatus,'datestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelstatus,'datestop'); ?>
		<?php echo $form->dateField($modelstatus,'datestop'); ?>
		<?php echo $form->error($modelstatus,'datestop'); ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($modelstatus,'responsibleuserid1');
                    echo $form->dropDownList($modelstatus,
                        'responsibleuserid1',
                        CHtml::listData(
                            ServUsers::model()->findAll(),
                           'id',
                            'FIO'
                        )
                    );
                    echo $form->error($modelstatus,'responsibleuserid1');
                ?>
	</div>
        <div class="row buttons">
                <?php
                    echo CHtml::submitButton('Сохранить',array(
                        'style'=>'float: right'
                    ));
                ?>
        </div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>