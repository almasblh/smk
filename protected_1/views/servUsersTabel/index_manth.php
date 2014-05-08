<?php
$manthstring=array(
 'январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь'  
);
    for($manth=0;$manth<12;$manth++){
        echo '<div id=manth'.$manth.'>';
        echo CHtml::ajaxbutton($manthstring[$manth],
                CHtml::normalizeUrl(array('ServUsersTabel/index&manth='.$manth)),
                array('type' => 'POST',
                      'update' => '#manth'.$manth,
                ),
                array(
                    'name'=>'button'.$manth,
                    'style'=>'width:100px;margin-left:20px'
                )
            );
        echo '</div>';
    }
?>
