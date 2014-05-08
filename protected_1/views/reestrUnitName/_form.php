<div class="form">

<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reestr-unit-name-form',
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
        <?php echo $form->textField($model,'caption',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'caption'); ?>
    </div>
    <div class="row">
        <?php
            echo $form->labelEx($model,'systemid');
            echo $form->dropDownList($model,
                'systemid',
                CHtml::listData(ReestrSystemName::model()->findAll(array('order'=>'id')), 'id', 'caption')
                ,array('style'=>'width:200px')
            );
//echo $form->textField($model,'systemid',array('size'=>50,'maxlength'=>50));
            echo $form->error($model,'systemid');
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->