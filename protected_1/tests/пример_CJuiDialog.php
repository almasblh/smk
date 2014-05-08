<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dialog.css" />-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'popup',
    'themeUrl'=>'.css',
    'cssFile'=>'jquery-ui-1.8.18.custom.css',
    'theme'=>'my',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Регистрация/Авторизация',
        'autoOpen'=>true,
        'width'=>270,
        'height'=>225,
        'resizable'=>false,
        'modal'=>true,
        'position'=>'center',
        'dialogClass'=>'class',
    ),
));?>

<?php echo Yii::app()->request->getParam('category'); ?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'my_popup',
        'action'=>$this->createUrl('/catalog/main/server/', array('id'=>$_GET['id'])),
        'method'=>'POST',
        'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnChange'=>false,
            'validateOnType' => false,
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:function(form, data, hasError)
            {
                if(data.answer == "newRegistration")
                {
                    $("#mainWinInside").text("Вы успешно авторизованы! Вам отправлено письмо!");
                    $("#popup").dialog("close");
                    $("#mainPopUp").slideDown("slow").fadeOut(4000,function(){location.reload()});
                    
                    
                }
                if(data.answer == "success")
                {
                    $("#mainWinInside").text("Добро пожаловать!");
                    $("#popup").dialog("close");
                    $("#mainPopUp").slideDown("slow").fadeOut(2000,function(){location.reload()});
                }
                if(data.PopupPassword_passwd[0]== "Необходимо заполнить поле введите Ваш пароль.")
                {            
                    //$(".password").css({"display" : "block"});
                    $(".password").slideDown(600);
                    
                }
                    
            }',
        )
    )); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    
    <div class="password" style="display: none;" class="row">
        <?php echo $form->labelEx($modelTwo,'passwd'); ?>
        <?php echo $form->textField($modelTwo,'passwd'); ?>
        <?php echo $form->error($modelTwo,'passwd'); ?>
    </div>
    
    <div class="password" style="display: none;" class="row">
        <?php echo CHtml::link('Забыли пароль?', $this->createUrl('/recovery/recovery/')); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Продолжить') ?>
    </div>
    <?php $this->endWidget(); ?>
    
<?php $this->endWidget(); ?>    
</div>