<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
            <?php
                echo $form->label($model,'systemid'); 
                echo $form->dropDownList($model,
                    'systemid',
                    CHtml::listData(ReestrSystemName::model()->findAll(array('order'=>'id')), 'id', 'caption')
                    ,array('style'=>'width:200px')
                );
            ?>
	</div>

	<div class="row">
            <?php
                echo $form->label($model,'unitid');
                echo $form->dropDownList($model,
                    'unitid',
                    CHtml::listData(ReestrUnitName::model()->findAll(array('order'=>'caption')), 'id', 'caption')
                    ,array('style'=>'width:200px')
                );
            ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->