<?php
    $this->breadcrumbs=array(
            'El Bez Quests',
    );
?>








<h1>Билеты по электробезопасности</h1>
Группа 2 до 1000 В
    <div class="row buttons">
        <?php
        for($i=1;$i<=10;$i++){
            echo CHtml::button('Билет №'.(($i==10)?'':'_').$i, array('submit' => array('view','b'=>$i)));
        }
        ?>
    </div>
    <div class="row buttons">
        <?php
        for($i=11;$i<=20;$i++){
            echo CHtml::button('Билет №'.$i, array('submit' => array('view','b'=>$i)));
        }
        ?>
    </div>
    <div class="row buttons">
        <?php
        for($i=21;$i<=30;$i++){
            echo CHtml::button('Билет №'.$i, array('submit' => array('view','b'=>$i)));
        }
        ?>
    </div>

