<?php
    $this->breadcrumbs=array(
            'Serv Users'=>array('index'),
            'Create',
    );
?>
<h1>Создание нового пользователя</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>