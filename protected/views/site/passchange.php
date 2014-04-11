<div class="form">
<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passchange-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
    ));
?>
    <div class="row">
        <?php echo $form->labelEx($model,'Старый пароль'); ?>
        <?php echo $form->passwordField($model,'oldpass'); ?>
        <?php echo $form->error($model,'oldpass'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'Новый пароль'); ?>
        <?php echo $form->passwordField($model,'newpass1'); ?>
        <?php echo $form->error($model,'newpass1'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'Новый пароль еще раз'); ?>
        <?php echo $form->passwordField($model,'newpass2'); ?>
        <?php echo $form->error($model,'newpass2'); ?>
    </div>
    <?php if(CCaptcha::checkRequirements()): ?>
    <div class="row">
            <?php echo $form->labelEx($model,'verifyCode'); ?>
            <div>
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model,'verifyCode'); ?>
            </div>
            <div class="hint">Please enter the letters as they are shown in the image above.
            <br/>Letters are not case-sensitive.</div>
            <?php echo $form->error($model,'verifyCode'); ?>
    </div>
    <?php endif; ?>
    <div class="row buttons">
            <?php echo CHtml::submitButton('Сменить пароль'); ?>
    </div>
</div>
<?php
    $this->endWidget();
?>
