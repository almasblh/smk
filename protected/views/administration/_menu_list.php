<?php
    echo CHtml::ajaxButton('Удалить пункт меню',
        CHtml::normalizeUrl(array('Administration/CatUpdate&action=deletemenuitem')),
        array('type' => 'POST',
              'update' => '#menulist',
        ),
        array('name'=>'deletemenuitem','style'=>'width:50%')
    );
    echo '<b />';
    echo CHtml::listBox('menuid',
        '1',
        $data,
        array(
            'style'=>'width:100%;height=30%',
            'size'=>25,
            'onchange'=>
                CHtml::ajax(
                    array(
                        'type' => 'POST',
                        'update' => '#data',
                        'url'=>CHtml::normalizeUrl(array('CatUpdate&action=1')),
                        'cache'=>true
                    )
                ),
        )
    );
?>