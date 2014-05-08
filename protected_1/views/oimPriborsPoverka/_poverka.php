<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oim-pribors-form-poverka',
	'enableAjaxValidation'=>false,
        'htmlOptions' =>array('enctype'=>'multipart/form-data' ) // говорим что форма может работать с файлами
)); ?>

	<p class="note">Поля, обозначенные <span class="required">*</span>, обязятельны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'svidnom'); ?>
            <?php echo $form->textField($model,'svidnom',array('size'=>60,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'svidnom'); ?>
	</div>
        
        <div class="row">
            <?php   echo $form->labelEx($model,'povererid');
                    echo $form->dropDownList($model,'povererid',
                        $model->PovererList
                        );
                    echo $form->error($model,'povererid');
                    echo '<b>'.CHtml::link(' Создать нового поверщика ', array('/OimPriborsPoverer/Create')).'</b>';
            ?>
        </div>

	<div class="row">
            <?php echo $form->labelEx($model,'newpoverdate'); ?>
            <?php echo $form->dateField($model,'newpoverdate'); ?>
            <?php echo $form->error($model,'newpoverdate'); ?>
	</div>
        
	<div class="row">
            <?php echo $form->labelEx($model,'svidpath'); ?>
            <?php echo $form->fileField($model,'svidpath'); ?>
            <?php echo $form->error($model,'svidpath'); ?>
	</div>

	<div class="row buttons">
            <?php
            //echo $form->hiddenField($model,'id');
            echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->