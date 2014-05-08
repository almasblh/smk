<figure class="Form">
    <header id="Header">Выбор активного проекта
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
        ));
//        echo $form->errorSummary($model);
    ?>
    <div class="row">
        <?php
            //echo $form->labelEx($model,'projectid');
            echo CHtml::dropDownList('Project'
                ,'1'
                ,CHtml::listData(
                    SmkProjects::model()->findAll(array('order'=>'Name'))
                    , 'id'
                    , 'Name'
                )
                ,array('style'=>'width:100%')
                );
            //echo $form->error($model,'projectid');
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Выбрать проект',
                array('style'=>'float:right')
                );
        ?>
    </div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>