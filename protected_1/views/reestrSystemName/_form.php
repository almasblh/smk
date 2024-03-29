<div class="form">

<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reestr-system-name-form',
	'enableAjaxValidation'=>false,
    ));
    echo $form->errorSummary($model);
?>
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'caption'); ?>
        <?php echo $form->textField($model,'caption',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'caption'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->