<figure class="Form">
    <header id="Header">Новая рекламация
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
        echo 'Шаблоны - ';
        echo CHtml::link('<Акт о браке>',
            array('/Viewfiles',
              'path' => 'templates/reklamations/Акт о браке.doc'
            ),
            array('target'=>'_blank')
            ).' ';
        echo CHtml::link('<Акт приемопередачи>',
            array('/Viewfiles',
              'path' => 'templates/reklamations/Акт приемопередачи.doc'
            ),
            array('target'=>'_blank')
            );

        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'smk-reklamation-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' =>array('enctype'=>'multipart/form-data' )            // говорим что форма может работать с файлами
        ));
        echo $form->errorSummary($model);
    ?>
	<div class="row">
            <?php
                echo $form->labelEx($model,'projectid');
                echo $form->dropDownList($model,
                    'projectid'
                    ,$model->GetPGVRList()
                    ,array('style'=>'width:100px')
                );
                echo '<span style="font-size: 0.8em;"> ( Заполните, если знаете.)</span><br />';
                echo $form->error($model,'projectid');

            ?>
	</div>

    	<div class="row">
		<?php
                    echo $form->labelEx($model,'object').'<span style="font-size: 0.8em;"> ( Заполните, если знаете.)</span>';
                    echo $form->textArea($model,'object',
                            array('style'=>'width:100%',
                                'maxlength'=>255
                                )
                    );
                    echo $form->error($model,'object');
                ?>
	</div>
    	<div class="row">
		<?php
                    echo $form->labelEx($model,'dogovor').'<span style="font-size: 0.8em;"> ( Заполните, если знаете.)</span>';

                    echo $form->textArea($model,'dogovor',
                            array('style'=>'width:100%',
                                'maxlength'=>255
                                )
                    );
                    echo $form->error($model,'dogovor');
                ?>
	</div>    
    	<div class="row">
		<?php
                    echo $form->labelEx($model,'problemname').'<span style="font-size: 0.8em;"> ( Для возможности дальнейшего поиска, введите сюда какое-либо ключевое слово. Например, наименование прибора из акта о браке.)</span>';
                    echo $form->textArea($model,'problemname',
                            array('style'=>'width:100%',
                                'maxlength'=>255
                                )
                    );
                    echo $form->error($model,'problemname');
                ?>
	</div>
        <div class="row">
		<?php
                    echo $form->labelEx($model,'Контактное лицо - представитьель заказчика');
                    echo $form->textField($model,'contactFIO',
                            array('size'=>50,'maxlength'=>50)
                    );
                    echo $form->error($model,'contactFIO');
                ?>
	</div>
    	<div class="row">
		<?php
                    echo $form->labelEx($model,'Контактный телефон представителя заказчика');
                    echo $form->textField($model,'contactTel',
                            array('size'=>50,'maxlength'=>50)
                    );
                    echo $form->error($model,'contactTel');
                ?>
	</div>
	<div class="row">
            <?php
                echo $form->labelEx($model,'aktpath');
                echo $form->fileField($model,'aktpath');
                echo $form->error($model,'aktpath');
            ?>
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton(
                        'Добавить новую рекламацию в базу',
                        array('style'=>'float:right')
                        );
                ?>
	</div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>