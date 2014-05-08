<!DOCTYPE HTML5">

<html xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>js/jGrowl/jquery.jgrowl.css" />
<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/help.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/UI_functions.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jGrowl/jquery.jgrowl.js');
    Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
    Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css')
?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
    <div id="header">
        <div id="logo">
            <a target="_blank" href='http://intranet.sintek.net/'><img src='<?php echo Yii::app()->request->baseUrl; ?>/images/logo.JPG' alt='логотип' name='logo' id='scrlogo' /></a>
        </div>
    </div><!-- header -->
    <div class="InputForm ui-widget-content"></div>
    <div id="mainmenu">
<?php
    $isGuest=Yii::app()->user->isGuest;
    if(!Yii::app()->user->isGuest){                                             //Если пользователь зарегистрирован
        $ac=Yii::app()->user->getState('activecategory');
        $ac= (isset($ac) && $ac>0) ? implode(", ", $ac) : '(не определено)';
        echo '<div id="page" align="center"><h8>'
            .Yii::app()->user->getState('userstring')
            .$ac
            .'</h8></div>';                                                     // Выводим информацию о пользователе
        $this->widget('zii.widgets.CMenu',array(                                    //выведем список на экран
            'items'=>array(                                                         //формируем стандартные пункты меню
                array(  'label'=>'Главная',
                        'url'=>CHtml::normalizeUrl(array('site/index')),
                        'visible'=>$isGuest
                ),
                array(  'label'=>'Напишите нам',
                        'url'=>CHtml::normalizeUrl(array('site/contact')),
                        'visible'=>$isGuest
                ),
                array(  'label'=>'О системе',
                        'url'=>CHtml::normalizeUrl(array('site/About')),
                        'visible'=>$isGuest
                ),
                array(  'label'=>'Выход ('.Yii::app()->user->getState('username').')',
                        'url'=>CHtml::normalizeUrl(array('site/Logout')),
                        'visible'=>!$isGuest
                ),
                array(  'label'=>'Сменить пароль',
                        'url'=>CHtml::normalizeUrl(array('site/passchange')),
                        'visible'=>!$isGuest
                ),
                array(  'label'=>'Администрирование',
                        'url'=>CHtml::normalizeUrl(array('Administration/index')),
                        'visible'=>isset(Yii::app()->user->getState('usermainrole')[0]['category']) && (Yii::app()->user->getState('usermainrole')[0]['category'] ==-1) //если это суперпользователь
                ),
                array(  'label'=>'Инфо',
                        'url'=>CHtml::normalizeUrl(array('site/Contact')),
                )
            )
        ));
    }
?>
</div><!-- mainmenu -->
<div id="breadcrumbs">
<?php
    if(isset($this->breadcrumbs)){
            $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
            ));
        }
?>
</div><!-- breadcrumbs -->
<div id="Activeproject">
<?php
    if(!Yii::app()->user->isGuest){
        $apsn=Yii::app()->user->getState('activeprojectstepname');
        echo '<h6 text-align: center>'
            .CHtml::ajaxLink(
                    'Активный проект',
                    CHtml::normalizeUrl(array('select','par'=>'Project')),
                    array('type' => 'POST',
                          'update' =>'.InputForm',
                    )
            )
            .' - '
            .Yii::app()->user->getState('activeprojectname')
            .', '
            .'ПГВР № '.Yii::app()->user->getState('activeprojectpgvr')
            .' / '
            .CHtml::ajaxLink(
                    'Этап',
                    CHtml::normalizeUrl(array('select','par'=>'Step')),
                    array('type' => 'POST',
                          'update' =>'.InputForm',
                    )
            )
            .' - '
            .(isset($apsn) ? $apsn : 'не выбран')
            .'</h6>';
    }
?>
</div>
<div class="Menu">
    <?php
        $this->MenuButton('SmkProjects','index','Проекты');
        $this->MenuButton('SmkReklamation','index','Рекламации');
//        $this->MenuButton('OimPmiTests','index','ОИиМ');
//        $this->MenuButton('Konstrucktor','index','Констр');
        
        $this->MenuButton('Site','Robokassa','Robokassa');
        
        $this->MenuButton('Site','ProjectStepSendemail','Proj_S_mail');
        $this->MenuButton('Site','ReklamationSendemail','Rekl_S_mail');
        $abcd=ElbezUserCard::model()->findByAttributes(array('userid'=>Yii::app()->user->id));
        if(isset($abcd)){
            $this->MenuButton('ElbezUserCard','view','Электробезопасность','id='.$abcd->id);
        }
        $this->MenuButton('ServUsers','index','Список пользователей','','NewWin');
        echo CHtml::link(
            CHtml::button('Телефонный  справочник ООО"Синтек"'),
            'http://intranet.sintek.net/phone/index.php',
            array(  'target'=>'_blank')
        );
        if(Yii::app()->user->getState('sup')){
            $this->MenuButton('Site','index','Сбросить весь кеш','par=cachereset');
        }

    ?>
</div>
<?php
    echo $content;
?>
<div id="footer">Copyright &copy; <?//php echo date('Y'); ?> by AlMas Company. All Rights Reserved.</div>
</div><!-- page -->
</body>
</html>
