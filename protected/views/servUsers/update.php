<?php

    $this->breadcrumbs=array(
            'Serv Users'=>array('index'),
            $model->id=>array('view','id'=>$model->id),
            'Обновление данных пользователя',
    );
?>

<h1>Обновление данных пользователя № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>