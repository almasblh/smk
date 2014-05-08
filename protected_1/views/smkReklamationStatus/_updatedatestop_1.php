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
)); ?>

	<?php echo $form->errorSummary($modelstatus); ?>
	<div class="row">
		<?php echo $form->labelEx($modelstatus,'datestop'); ?>
		<?php echo $form->dateField($modelstatus,'datestop'); ?>
		<?php echo $form->error($modelstatus,'datestop'); ?>
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