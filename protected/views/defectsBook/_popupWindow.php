<?php
    $this->beginWidget(
        'zii.widgets.jui.CJuiDialog',
        array(
            'id' => 'popup_window',
            'options' => array(
                'title' => 'Дефект',
                'autoOpen' => false,
                'modal' => true,
                'resizable'=> false,
            ),
        )
    );
?>
<div id="popup_content">
</div>
<?php
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
