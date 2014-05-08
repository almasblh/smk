<?php

$this->breadcrumbs=array(
	'Serv Users'=>array('index'),
	$model->id,
);
?>

<h1>Просмотр данных пользователя №<?php echo $model->id; ?></h1>

<?php
    $depart=(isset($model->ServUsersDepartament->name)?$model->ServUsersDepartament->name:'-');
    $dol=(isset($model->ServUsersDolgnost->name)?$model->ServUsersDolgnost->name:'-');
    $order=(isset($model->ServUsersOtdel->name)?$model->ServUsersOtdel->name:'-');
    $sector=(isset($model->ServUsersSector)?$model->ServUsersSector->name:'-');
    
    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'fname',
            'sname',
            'tname',
            array('name'=>'departamentid',
                'value'=>$depart
                ),
            array('name'=>'dolgnostid',
                'value'=>$dol
            ),
            array('name'=>'otdelid',
                'value'=>$order
            ),
           //  array('name'=>'category',
           //     'value'=>implode(", ", Yii::app()->user->getState('activecategory')),
           // ),
            'active',
            array('name'=>'email',
                'type'=>'html',
                'value'=>CHtml::mailto($model->email)
            ),
            'tel_in',
            'tel_mob',
        ),
    ));
    if($this->EnableForCurrentUser('ServUsersController','update'))
        echo CHtml::link(
            'Редактировать данные пользователя',
            CHtml::normalizeUrl(
                array('ServUsers/update',
                        'id'=>$model->id,
                )
            )
        ).'</br>';
    if($this->EnableForCurrentUser('ServUsersController','update'))
        echo CHtml::link(
            'Назначить (снять) категорию пользователю',
            CHtml::normalizeUrl(
                array('ServUsers/update',
                        'id'=>$model->id,
                        'cat'=>1,
                )
            )
        );
?>
