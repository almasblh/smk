<div class="form">

<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oim-etl-tests-jurnal-form',
	'enableAjaxValidation'=>false,
    ));
    echo $form->errorSummary($model);
?>
	<div class="row">
            <?php
                echo $form->labelEx($model,'projectid');
                echo CHtml::textField('projectid'
                        ,SmkProjects::model()->findByPk(YII::app()->user->getState('activeproject'))->Npgvr
                        ,array('style'=>'text-align:center'
                    ));
                echo $form->error($model,'projectid');
            ?>
	</div>
    
        <div class="row">
            <?php
                $model->num=OimEtlTests::model()->find(array('select'=>'max(num) num',))->num+1;
                echo $form->labelEx($model,'num');
                echo $form->textField($model,'num',array('style'=>'text-align:center'));
                echo $form->error($model,'num');
            ?>
	</div>
    
	<div class="row">
		<?php
                echo $form->labelEx($model,'prunitid');
                    echo $form->dropDownList($model,
                        'prunitid',
                        CHtml::listData(SmkProjectUnits::model()
                            ->with('ReestrUnitName')
                            ->findAll(array(
                                    'order'=>'t.id'
                                    ,'condition'=>'projectid='.YII::app()->user->getState('activeproject')
                                )
                            )
                            ,'id'
                            ,'ReestrUnitName.caption'
                        )
                        ,array('style'=>'width:400px')
                    );
                    echo $form->error($model,'testid');
                ?>
	</div>
    
	<div class="row">
		<?php
                    echo $form->labelEx($model,'testid');
                    echo $form->dropDownList($model,
                        'testid',
                        CHtml::listData(ReestrOimEtlTests::model()->findAll(array('order'=>'id')), 'id', 'name')
                        ,array('style'=>'width:400px')
                    );
                    echo $form->error($model,'testid');
                ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'tester1id');
                    echo $form->dropDownList($model,
                        'tester1id',
                        CHtml::listData(ServUsers::model()
                            ->findAll(array(
                                    //'condition'=>'otdelid=15',//Отдел испытаний и метрологии
                                    'order'=>'id'
                                )
                                ), 'id', 'FIO'
                            )
                        ,array('style'=>'width:400px')
                    );
                    echo $form->error($model,'tester1id');
                ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'tester2id');
                    echo $form->dropDownList($model,
                        'tester2id',
                        CHtml::listData(ServUsers::model()->findAll(array('order'=>'id')), 'id', 'FIO')
                        ,array('style'=>'width:400px')
                    );
                    echo $form->error($model,'tester2id');
                ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'tester3id');
                    echo $form->dropDownList($model,
                        'tester3id',
                        CHtml::listData(ServUsers::model()->findAll(array('order'=>'id')), 'id', 'FIO')
                        ,array('style'=>'width:400px')
                    );
                    echo $form->error($model,'tester3id');
                ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать испытание' : 'Сохранить испытание'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->