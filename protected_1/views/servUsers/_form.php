<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'serv-users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php echo $form->textField($model,'fname',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sname'); ?>
		<?php echo $form->textField($model,'sname',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'sname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tname'); ?>
		<?php echo $form->textField($model,'tname',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'tname'); ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'departamentid');
                    echo CHtml::dropDownList('departamentid',
                        $model->departamentid,//'1',
                        CHtml::listData(ServUsersDepartament::model()->findAll(), 'id', 'name'),
                        array('style'=>'width:70%')
                    );
                    echo $form->error($model,'departamentid');
                ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'otdelid');
                    echo CHtml::dropDownList('otdelid',
                        $model->otdelid,
                        CHtml::listData(ServUsersOtdel::model()->findAll(), 'id', 'name'),
                        array('style'=>'width:70%')
                    );
                    echo $form->error($model,'otdelid');
                ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'dolgnostid');
                    echo CHtml::dropDownList('dolgnostid',
                        $model->dolgnostid,
                        CHtml::listData(ServUsersDolgnost::model()->findALL(), 'id', 'name'),
                        array('style'=>'width:70%')
                    );
                    echo $form->error($model,'dolgnostid');
                ?>
	</div>
        
	<div class="row">
		<?php
                    echo $form->labelEx($model,'category');
                    echo CHtml::dropDownList('category',
                        $model->category,
                        CHtml::listData(ServUsersCategory::model()->findALL(), 'id', 'name'),
                        array('style'=>'width:70%')
                    );
                    echo $form->error($model,'category');
                ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'width:50%')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel_in'); ?>
		<?php echo $form->textField($model,'tel_in',array('style'=>'width:30%')); ?>
		<?php echo $form->error($model,'tel_in'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'tel_mob'); ?>
		<?php echo $form->textField($model,'tel_mob',array('style'=>'width:30%')); ?>
		<?php echo $form->error($model,'tel_mob'); ?>
	</div>
        
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->