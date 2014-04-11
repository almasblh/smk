<?php
    $top=rand(300,400);                                                         //задаем случайные начальные координаты появления формы
    $left=rand(300,400);
?>
<figure class="Form" style="position:fixed;" top:<?php echo $top; ?>px; left:<?php echo $left; ?>px;">
    <header id="Header"><?php echo isset($header)?$header:'none';?>
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
        
<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smk-project-units-form',
    	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
        )
    )); 
    echo $form->errorSummary($model);
?>

    <div class="row">
        <?php
            echo $form->labelEx($model,'Проект');
            echo $form->dropDownList($model,
                'projectid',
                CHtml::listData(SmkProjects::model()->findAll(array('order'=>'Npgvr')), 'id', 'Npgvr')
                ,array('style'=>'width:200px'
                    ,'options'=>array(
                        Yii::app()->user->getState('activeproject')
                        =>array('selected'=>true
                    )
                ))
            );
            echo $form->error($model,'Name');
        ?>
    </div>

        <?php
            echo $form->labelEx($model,'Шкаф');
            echo $form->dropDownList($model,
                'unitid',
                CHtml::listData(ReestrUnitName::model()->findAll(array('order'=>'caption')), 'id', 'caption')
                ,array('style'=>'width:200px')
            );
            echo $form->error($model,'Name');
            if($this->EnableForCurrentUser('ReestrUnitName','create'))
                echo CHtml::link('Нет в списке? -> Добавить новый шкаф',
                            CHtml::normalizeUrl(array('ReestrUnitName/create'))
                        )
        ?>
    </div>
    <div class="row">
        <?php
            echo $form->labelEx($model,'vkpeN');
            echo $form->textField($model,'vkpeN',array('style'=>'width:200px'));
            echo $form->error($model,'vkpeN');
        ?>
    </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton(
                        $model->isNewRecord ? 'Создать' : 'Обновить',
                        array('style'=>'float:right')
                    );
            ?>
        </div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>