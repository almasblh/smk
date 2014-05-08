<?php
Yii::app()->clientScript->registerScriptFile('js/assa.js');// регистрируем javascript файл


    $this->breadcrumbs=array(
        'Serv Users'=>array('index'),
        'Список пользователей',
    );
?>
<h1>Список пользователей</h1>
<div class="Menu">
    <?php
    if(Yii::app()->user->getState('sup')){
        $this->MenuButton('ServUsers','index','Пересканировать список','par=listupdate');
    }
    ?>
</div>
<div class="SubMenu">
</div>
<?php
    $this->renderPartial('index_table', array('model'=>$model));
?>
<div class="status_view"></div>
