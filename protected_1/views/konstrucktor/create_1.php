<?php
Yii::app()->clientScript->registerScriptFile('js/konstrucktor/Create.js');// регистрируем javascript файл

$this->breadcrumbs=array(
    'Конструкторский отдел'=>array('/konstrucktor'),
    'create',
);
?>
<h1>Сборка проекта из КД</h1>

<div class="form">
<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kd-collection-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
        'htmlOptions' =>array('enctype'=>'multipart/form-data' ) // говорим что форма может работать с файлами
    ));
    echo $form->errorSummary($model);
?>
    
<?php
        echo CHtml::label('ПГВР','idProject');
        echo CHtml::textField('ПГВР'
            ,Yii::app()->user->getState('activeprojectpgvr')
            ,array(
                'class'=>'Project'
                ,'id'=>'idProject'
                ,'style'=>'text-align:center'
            )
        );

        $a= ReestrUnitName::model()->findByPk($unitid);
        echo CHtml::label('Шкаф','idprUnit');
        echo CHtml::textField('Шкаф'
            ,$a->caption.'/'.$a->name
            ,array(
                'class'=>'prUnit'
                ,'id'=>'idprUnit'
                ,'style'=>'text-align:center'
            )
        );
?>    

    <div class="row FileField">
        <?php
            echo $form->labelEx($model,'Выберите BOM-файл');
            echo CHtml::activeFileField($model,
                    'BOMfile'
                );
            echo $form->error($model,'Name');
        ?>
    </div>
    
    <input  class="UnitSys" type="hidden"
        <?php
            $a='';
            foreach(ReestrUnitName::model()->findAll() as $row=>$value){
                $a.= $value->id.';'
                    .$value->name.';'
                    .$value->systemid.'_';
            }
            echo "value=".substr($a,0,-1);
        ?>
    />
    <div class="row System">
        <?php
        echo $form->labelEx($model,'Система');
        echo $form->dropDownList($model,
            'SMKsystemid',
            CHtml::listData(ReestrSystemName::model()->findAll(array('order'=>'id')), 'id', 'caption')
            ,array('style'=>'width:200px')
        );
        echo $form->error($model,'Name');
        ?>
    </div>
    
    <div class="row version">
        <?php
            echo $form->labelEx($model,'Последняя версия КД:');
            echo $form->textField($model,'lastKD'
                    ,array('size'=>5
                        ,'enable'=>false
                    )
                );
            echo $form->error($model,'Name');
        ?>
    </div>
   
    <div class="row buttons">
            <?php 
                $newver=$model->lastKD+1;
                echo CHtml::submitButton('Сгенерировать проект (ver.'.$newver.')'
                    ,array('style'=>'visibility: hidden'
                            ,'id'=>'assa'
                        )
                    );
            ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<?php
    if(isset($model->pars_str_error))
        $this->renderpartial('_parse_error', array('str'=>$model->pars_str_error));
?>
