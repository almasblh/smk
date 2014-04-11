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
    $manager=(isset(Yii::app()->user->getState('usermainrole')[0]['category']) && ((Yii::app()->user->getState('usermainrole')[0]['category']&&8192==true)));
    $grup_list=array('10'=>'1 до 1000В','20'=>'2 до 1000В','30'=>'3 до 1000В','31'=>'3 до и свыше 1000В','40'=>'4 до 1000В','41'=>'4 до и свыше 1000В','50'=>'5 до 1000В','51'=>'5 до и свыше 1000В');

    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'elbez-user-card-form',
	'enableAjaxValidation'=>false,
    ));
?>

	<?php   echo $form->errorSummary($model);
                echo '<h3>'.($userFIO=$model->GetUsersFIO($userid)).'</h3>';
                echo '<div class="row">';
                echo $form->labelEx($model,'Изменить статус');
                echo $form->dropDownList($model,
                    'status',
                    array('0'=>'ok','1'=>'здать','2'=>'распечатать протокол','3'=>'сохранить скан')
                );
                echo $form->error($model,'status');
                echo '</div>';
        ?>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'typeinspection');
                    echo $form->dropDownList($model,
                        'typeinspection',
                        array('0'=>'Первичная','1'=>'Очередная','2'=>'Внеочередная')
                    );
                    echo $form->error($model,'typeinspection');
                    echo '_'.$form->labelEx($model,'exttypeinspection').'_';
                    echo $form->textField($model,'exttypeinspection',array('size'=>60,'maxlength'=>255));
                    echo $form->error($model,'exttypeinspection'); ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'grup');
                    echo $form->dropDownList($model,
                        'grup',
                        $grup_list
                    );
                    echo $form->error($model,'grup');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'typepersonal');
                    echo $form->dropDownList($model,
                        'typepersonal',
                        array('0'=>'адм. тех.','1'=>'оперативн.','2'=>'ремонтн.','3'=>'оперативн.-ремонтн.')
                    );
                    echo $form->error($model,'typepersonal');
                ?>
	</div>
	<div class="row">
            <?php
                echo '<h6>Город: '.($town=$model->GetReestrOfficeLocate($locate_commision_PDK['locate'])).'</h6>';
                echo $form->labelEx($model,'signatureusertest1');
                echo CHtml::activeDropDownList($model,
                    'signatureusertest1',
                    $model->GetUsersList(),
                    array(
                        'options'=>array(isset($locate_commision_PDK['commision']['head'])?$locate_commision_PDK['commision']['head']:0 => Array('selected' => 'selected')),
                    )
                );
                if($locate_commision_PDK['commision']['head']==false)    echo ' будет утвержден как председатель комиссии ПДК для города '.$town;
                echo $form->error($model,'signatureusertest1');
            ?>
	</div>

	<div class="row">
		<?php
                    echo $form->labelEx($model,'signatureusertest2');
                    echo CHtml::activedropDownList($model,
                        'signatureusertest2',
                        $model->GetUsersList(),
                        array(
                            'options'=>array(isset($locate_commision_PDK['commision']['mb1'])?$locate_commision_PDK['commision']['mb1']:0 => Array('selected' => 'selected')),
                        )
                    );
                    if($locate_commision_PDK['commision']['mb1']==false)    echo ' будет утвержден как член комиссии ПДК для города '.$town;
                    echo $form->error($model,'signatureusertest2');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'signatureusertest3');
                    echo CHtml::activedropDownList($model,
                        'signatureusertest3',
                        $model->GetUsersList(),
                        array(
                            'options'=>array(isset($locate_commision_PDK['commision']['mb2'])?$locate_commision_PDK['commision']['mb2']:0 => Array('selected' => 'selected')),
                        )
                    );
                    if($locate_commision_PDK['commision']['mb2']==false)    echo ' будет утвержден как член комиссии ПДК для города '.$town;
                    echo $form->error($model,'signatureusertest3');
                ?>
	</div>
        <?php
                echo '<div class="row">'.$form->labelEx($model,'signatureusertest4');
                echo CHtml::activeDropDownList($model,
                    'signatureusertest4',
                    $model->GetUsersList(),
                    array(
                        'options'=>array($locate_commision_PDK['commision']['mb3'] => Array('selected' => 'selected')),
                    )
                );
                if($locate_commision_PDK['commision']['mb3']==false){
                    echo Chtml::checkBox('memb3',isset($model->signatureusertest4)?1:0);
                    echo 'если нужен, то будет утвержден как 3-й член комиссии ПДК для пользователя '.$userFIO;
                }
                echo $form->error($model,'signatureusertest4').'</div>';
                echo '<div class="row">'.$form->labelEx($model,'signatureusertest5');
                echo CHtml::activeDropDownList($model,
                    'signatureusertest5',
                    $model->GetUsersList(),
                    array(
                        'options'=>array($locate_commision_PDK['commision']['mb4'] => Array('selected' => 'selected')),
                    )
                );
                if($locate_commision_PDK['commision']['mb4']==false){
                    echo Chtml::checkBox('memb4',isset($model->signatureusertest5)?1:0);
                    echo 'если нужен, то будет утвержден как 4-й член комиссии ПДК для пользователя '.$userFIO;
                }
                echo $form->error($model,'signatureusertest5').'</div>';
        ?>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'ndocument');
                    echo $form->textField($model,
                        'ndocument',
                        ($model->status<>2)?array('disabled'=>'disabled'):array()
                    );
                    echo $form->error($model,'ndocument');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'nprotokol');
                    echo $form->textField($model,'nprotokol',
                        ($model->status<>2)?array('disabled'=>'disabled'):array()
                    );
                    echo $form->error($model,'nprotokol');
                ?>
	</div>
	<div class="row">
		<?php
                    //$model->dateinspection=date("Y-m-d H:i:s", time());;
                    echo $form->labelEx($model,'dateinspection');
                    echo $form->DateField($model,'dateinspection',
                        $manager?array():array('disabled'=>'disabled')
                        );
                    echo $form->error($model,'dateinspection');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'rating');
                    echo $form->textField($model,'rating',
                            $manager?array():array('disabled'=>'disabled')
                        );
                    echo $form->error($model,'rating');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'lastgrup');
//                    echo $form->textField($model,'lastgrup',
//                        $manager?array():array('disabled'=>'disabled')
//                        );
                    echo $form->dropDownList(
                            $model,
                            'lastgrup',
                            $grup_list,
                        $manager?array():array('disabled'=>'disabled')
                        );

                    echo $form->error($model,'lastgrup');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'lastdateinspection');
                    echo $form->dateField($model,'lastdateinspection',
                        $manager?array():array('disabled'=>'disabled')
                        );
                    echo $form->error($model,'lastdateinspection');
                ?>
	</div>
	<div class="row">
		<?php
                    echo $form->labelEx($model,'lastrating');
                    echo $form->textField($model,'lastrating',
                        $manager?array():array('disabled'=>'disabled')
                        );
                    echo $form->error($model,'lastrating');
                ?>
	</div>
	<div class="row">
		<?php 
                    echo $form->labelEx($model,'nextdateinspection');
                    echo $form->dateField($model,'nextdateinspection',
                        $manager?array():array('disabled'=>'disabled')
                        );
                    echo $form->error($model,'nextdateinspection');
                ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',array('style'=>'float:right')); ?>
	</div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>