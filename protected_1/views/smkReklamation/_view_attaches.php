<?php
foreach($Attaches as $row=>$value){
    echo CHtml::link($value['path'],
            array('/Viewfiles',
              'path' => 'reklamation/'.$value->path
            ),
            array('target'=>'_blank')
            ).'<br />';
}
echo '---<br />';
?>
