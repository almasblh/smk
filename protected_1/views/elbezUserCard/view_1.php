<?php
    $this->breadcrumbs=array(
            'Карточка по эл. безопасности'=>array('index'),
            $model->id,
    );
?>
<h1> Карточка по электробезопасности для пользователя <?php echo ' '.($userFIO=$model->GetUsersFIO($model->userid)) ?></h1>
<div class="Menu">
    <?php
    if((Yii::app()->user->id==$model->userid) && ($model->status==1)){
        $this->MenuButton('ElBezQuests','index','Здать экзамен','id='.$model->id);
    }
    if(isset(Yii::app()->user->getState('usermainrole')[0]['category']) && ((Yii::app()->user->getState('usermainrole')[0]['category']&&8192==true))){
        $this->MenuButton('ElbezUserCard','update','Редактировать','id='.$model->id,'ajax','.InputForm');
    }
    if(($model->status==2)){
        $this->MenuButton('ElBezQuests','index','Распечатать протокол');
    }
    if(($model->status==3)){
        $this->MenuButton('ElbezUserCard','update','Сохранить скан протокола','id='.$model->id.'&addattache=1','ajax','.InputForm');
    }
    ?>
</div>
<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            array('name'=>'userid',
                'value'=>$model->GetUsersFIO($model->userid)
            ),
            array('name'=>'grup',
                //'value'=>array(create_function('$data','$my_array=array(...);return $my_array[$data->value_id];'))
                   // $a=(($model->grup%10)==0)?'до 1000В':'до и св. 1000В';
                  //  $b=(int)($model->grup/10);
                  //  return $b.'гр. '.$a.' ';
                  //  return '1';

            ),
		'dateinspection',
		'ndocument',
		'rating',
		'typeinspection',
		'exttypeinspection',
		'nprotokol',
		'lastgrup',
		'lastdateinspection',
		'lastrating',
		'nextdateinspection',
		'signatureusertest1',
		'signatureusertest2',
		'signatureusertest3',
		'signatureusertest4',
		'signatureusertest5',
		'typepersonal',
	),
)); ?>
