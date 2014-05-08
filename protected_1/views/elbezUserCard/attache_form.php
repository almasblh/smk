<figure class="Form">
    <header id="Header">Карточка пользователя по электробезопасности
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
	'id'=>'elbez-attache-scan',
        'htmlOptions' =>array('enctype'=>'multipart/form-data' ),               // говорим что форма может работать с файлами
	'enableAjaxValidation'=>false,
    ));
?>
        <div class="row">
            <?php
                echo 'Добавтьте подписанный всеми скан протокола';
                echo $form->fileField($model,'aktpath');
                echo $form->error($model,'aktpath');
            ?>
        </div>


	<div class="row buttons">
		<?php
                    echo CHtml::submitButton('Сохранить',
                        array('style'=>'float:right')
                    );
                ?>
	</div>
<?php $this->endWidget(); ?>
        <div>.</div>
    </div><!-- form body-->
</figure>