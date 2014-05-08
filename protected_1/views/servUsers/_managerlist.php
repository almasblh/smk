<figure class="Form">
    <header id="Header">Список менеджеров по рекламациям
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
    /*
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'serv-users-grid',
	'dataProvider'=>$model->search(),
        'summaryText'=>'Показано с {start} по {end} из {count}',
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'fname',
                    'type'=>'html',
                    'value' => 'CHtml::link(CHtml::encode($data->fname),
                                array("ServUsers/view","id" => $data->id))',
                ),
		'sname',
		'tname'

	),
    ));
     * 
     */
    echo "assa";
    ?>

        
    <div>.</div>
    <?php $this->endWidget(); ?>
    </div><!-- form body-->
</figure>