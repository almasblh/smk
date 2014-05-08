<div class="form">
<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'mydialog',
                    'options' => array(
                        'title' => 'Внимание',
                        'autoOpen' => true,
                        'modal' => true,
                        'resizable'=> false
                    ),
                ));

    echo $msg;
?>

<?php
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
