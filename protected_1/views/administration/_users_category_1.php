<div>
<?php
    echo CHtml::ajaxButton('Удалить категорию из меню',
        CHtml::normalizeUrl(array('Administration/CatUpdate&action=deletecatfrommenu')),
        array('type' => 'POST',
              'update' => '#data',
        ),
        array('name'=>'deletecatfrommenu','style'=>'width:50%')
    );
    echo '<b />';
    echo CHtml::dropDownList('catenable','1',$datcategory,array('style'=>'width:100%;height=20%','size'=>4));
?>
</div>
<div>
<?php
    echo CHtml::ajaxButton('Удалить пользователя из меню',
        CHtml::normalizeUrl(array('Administration/CatUpdate&action=deleteuserfrommenu')),
        array('type' => 'POST',
              'update' => '#data',
        ),
        array('name'=>'deleteuserfrommenu','style'=>'width:50%')
    ); 
    echo '<b />';
    echo CHtml::dropDownList('userenable','1',$datuser,array('style'=>'width:100%;height=20%','size'=>4));
?>
</div>
