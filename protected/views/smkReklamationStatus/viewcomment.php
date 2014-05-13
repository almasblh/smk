<figure class="Form">
    <header id="Header">Коментарий
        <span style="float:right; margin:0;">
        <?php
            echo CHtml::imageButton(
                Yii::app()->request->baseUrl.'/images/Xmin.png',
                array('id'=>'esc',
                    'onclick'=>'$(\'.Form\').remove()'
                )
            );
        ?>
        </span>
    </header>
    <div id="Body">
        <?php
            echo $model->comment
        ?>
    </div><!-- form body-->
</figure>

