<figure class="Form"> 
    <header id="Header">Коментарий
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
	'id'=>'defects-book-state-form',
	'enableAjaxValidation'=>false,
    ));
?>
<?php echo $form->errorSummary($model); ?>
	<div class="row">
            <?php
                echo $form->labelEx($model,'comment');
                echo $form->textArea($model,'comment',
                        array('style'=>'width:100%',
                            'maxlength'=>255
                            )
                    );
                echo $form->error($model,'comment');
            ?>
	</div>
	<div class="row">
            <?php
                if($_GET['par']<>0){
                    echo $form->labelEx($model,'touserid');
                    echo CHtml::activedropDownList($model,
                        'touserid',
                        $model->GetUsersList(),
                        array(
                            'options'=>array( $autorid=> Array('selected' => 'selected')),
                        )
                    );
                    echo $form->error($model,'touserid');
                }
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