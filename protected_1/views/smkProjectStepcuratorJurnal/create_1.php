  <script>
   function pos() {
        pos_value = document.getElementById("position").value;
        current_percent = document.getElementById("SmkProjectStepcuratorJurnal_current_percent");
        current_percent.value=pos_value;
   }
  </script>
<figure class="Form"> 
    <header id="Header">Создание новой записи в журнале куратора этапа проекта
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
                'id'=>'smk-reklamation-status-form',
                'enableAjaxValidation'=>false,
            ));
            echo $form->errorSummary($model);
        ?>
	<div class="row">
            <?php
                echo $form->labelEx($model,'comment');
                echo $form->textArea($model,'comment',array('style'=>'width:100%','maxlength'=>255));
                echo $form->error($model,'comment');
            ?>
	</div>
	<div class="row">
            <?php 
                echo $form->labelEx($model,'current_percent');
            ?>
            <input type="range" min=<?php echo $model->current_percent?> max="100" value=<?php echo $model->current_percent?> id="position" oninput="pos();">
            <?php 
                echo $form->textField($model,
                        'current_percent',
                        array(
                            'style'=>'width:50px'
                        )
                    );
                echo Chtml::label($model->current_percent.'---------------------100','SmkProjectStepcuratorJurnal_position');
                echo $form->error($model,'current_percent');
            ?>
        </div>

	<div class="row buttons">
		<?php
                    echo CHtml::submitButton(
                            $model->isNewRecord ? 'Создать' : 'Сохранить',
                            array('style'=>'float:right')
                    );
                ?>
	</div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>