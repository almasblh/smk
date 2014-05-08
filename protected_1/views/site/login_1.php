<?php
    $this->beginWidget(
        'zii.widgets.jui.CJuiDialog',
        array(
            'id' => 'popup_window',
            'options' => array(
                'title' => 'Вход в систему',
                'autoOpen' => true,
                'modal' => true,
                'resizable'=> false,
            ),
        )
    );
?>
<div class="form1">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
	),
)); ?>
	<div class="row">
		<?php
                echo $form->labelEx($model,'username');
                echo $form->dropDownList($model,
                        'username',
                        //Yii::app()->cache->get('UsersList'),
                        $model->GetUsersList(),
                        array('style'=>'width:100%')
                    ).'<br />';
                    echo $form->error($model,'username');
                ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Вход'); ?>
	</div>
</div><!-- form -->
<?php $this->endWidget(); ?>
<?php
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>