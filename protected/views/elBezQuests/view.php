<?php
    $this->breadcrumbs=array(
            'El Bez Quests'=>array('index'),
            '',
    );
?>

<?php
    $form=$this->beginWidget('CActiveForm', array(
            'id'=>'el-bez-quests-form',
            'enableAjaxValidation'=>false,
    ));
?>

<?php
    if($allticket>0){
        $resume=0;
        $a=$allresult/$allticket;
        if($a>0.9) $rating=5;
        elseif($a>0.75) $rating=4;
        elseif($a>0.65) $rating=3;
        elseif($a>0.5) $rating=2;
        else $rating=1;
        if($rating>2) $resume=1;
        $str='<h1>';
        if ($resume){
            $status=2;
        }
        else{
            $status=1;
            $str.="НЕ ";
        }
        $str.="Сдал. Оценка - ".$rating;
        $str.='</h1>';
        echo $str;
        $usercard->status=$status;
        $usercard->save();
        if(($resume))$this->MenuButton('ElBezQuests','index','Распечатать протокол');
        $this->MenuButton('ElBezQuests','index','Попробовать еще раз','id='.$usercard->id);
    }
    foreach($quest as $q=>$val){
        echo '<h6>Вопрос №'.$val['nquest'].': '.$val['name'].'</h6>';
        if($allticket>0)
            if($result[$q])
                echo '<h4 style="background-color: #00FF00;">Правильно</h4>';
        else
            echo '<h4 style="background-color: #FF0000;color:#FFFFFF">НЕ правильно! Правильный ответ № '.($quest[$q]['right']).'</h4>';
        unset($a);
        foreach($ans[$q] as $an=>$v){
            $a[$an]=$v['name'];
        }
        echo CHtml::radioButtonList(
                $val['nquest'],
                ($allticket>0)?$usrans[$q]:-1,
                $a,
                array(
                )
            );
    }
?>
<div class="row buttons">
    <?php
        if($allticket==0) echo CHtml::submitButton('Проверить');
    ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->