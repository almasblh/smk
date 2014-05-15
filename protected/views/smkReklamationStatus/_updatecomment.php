<?php //Форма ввода коментариев исполнителя этапа по рекламации?>
  <script>
   function pos() {
        pos_value = document.getElementById("position").value;
        current_percent = document.getElementById("SmkReklamationStatus_steppersent");
        current_percent.value=pos_value;
   }
  </script>
<figure class="Form">
    <header id="Header">Коментарий (Резюме) по текущему статусу
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
                'id'=>'smk-reklamation-status-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' =>array('enctype'=>'multipart/form-data' ) // говорим что форма может работать с файлами
            ));
        ?>
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
                <?php
                    //echo $form->label($model,'comment');
                    echo 'Коментарии исполнителя___(история)<br />';
                    echo $model->comment;
                    echo '---';
                ?>
        </div>    
        <div class="row">
                <?php
                    //echo $form->labelEx($model,'NewComent');
                    echo 'Добавьте сюда свой коментарий___(пока этап не завершен - сюда можно добавлять сколько угодно коментариев)<br />';
                    echo $form->textArea($model,'NewComent',
                            array('style'=>'width:70%'//,
                                //'maxlength'=>255
                                )
                    );
                    echo $form->error($model,'NewComent');
                ?>
        </div>
        <div class="row">
            <?php
                echo 'Если есть необходимость - можно приложить скан документа)';
                echo $form->fileField($model,'aktpath');
                echo $form->error($model,'aktpath');
            ?>
        </div>
        <div class="row">
            <?php 
                echo 'Завершено %___(поставьте сюда процент исполнения этапа по вашему мнению. 100% означает, что этап завершен.)';
            ?>
            <input type="range" min=<?php echo $model->steppersent?> max="100" value=<?php echo $model->steppersent?> id="position" oninput="pos();">
            <?php 
                echo $form->textField($model,
                        'steppersent',
                        array(
                            'style'=>'width:50px'
                        )
                    );
                echo Chtml::label($model->steppersent.'---------------------100','SmkReklamationStatus_position');
                echo $form->error($model,'steppersent');
            ?>
        </div>
        <div class="row buttons">
                <?php
                    echo CHtml::submitButton('Сохранить',array(
                        'style'=>'float: right'
                    ));
                ?>
        </div>
        <div>.</div>
        <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>

