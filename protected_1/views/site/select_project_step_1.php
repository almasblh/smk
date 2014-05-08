<figure class="Form">
    <header id="Header">Выбор активного этапа
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
        echo CHtml::dropDownList('Step','1',
                CHtml::listData(
                    $model,'stepid',function($model){
                        return CHtml::encode($model->SmkProjectStepName['name']);
                    }
                ),
                array('style'=>'width:100%'));
        //echo $form->error($model,'Name');
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Выбрать',
                array('style'=>'float:right')
                );
        ?>
    </div>
        <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    <?php
        $form=$this->beginWidget('CActiveForm'
            ,array( 'id'=>'smk-projects-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'action' => array('site/select'),
            //      'enableAjaxValidation'=>false,
            'htmlOptions'=>array(
                'class'=>'form1',
            )
        ));
        echo 'Этап';
        $model= SmkProjectStep::model()
            ->with('SmkProjectStepName')
            ->findAll(array(
                'condition'=>'projectid='.Yii::app()->user->getState('activeproject')
                )
            );
        $data = CHtml::listData(
            $model,'stepid',function($model){
                return CHtml::encode($model->SmkProjectStepName['name']);
            }
        );
        echo CHtml::dropDownList('Step','1',$data,array('style'=>'width:100%'));
        //echo $form->error($model,'Name');
        echo CHtml::submitButton('Выбрать');
        $this->endWidget();    
    ?>
    </div><!-- form body-->
</figure>