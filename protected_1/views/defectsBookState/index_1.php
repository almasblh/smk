<?php
$this->breadcrumbs=array(
	'Defects Book States',
);
?>
<h1>Defects Book States</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'defects-book-grid',
	'dataProvider'=>$model->search($defectid),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'id',
                'htmlOptions'=>array(
                    'style'=>'width:2%',
                )
            ),
            array('name'=>'state',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'comment',
                'htmlOptions'=>array(
                    'style'=>'width:50%;text-align:center',
                )
            ),
            array('name'=>'date',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'signaturecreatorid',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
            array('name'=>'touserid',
                'htmlOptions'=>array(
                    'style'=>'text-align:center',
                )
            ),
/*            array(
                'class'=>'CButtonColumn',
                'header'=>'Действия',
                'buttons'=>array(
                    'btnComment'=>array(
                        'label'=>'Ответить',
                        //'visible'=>array($modelstatus,'getVisiblebtnComment'),                     //метод модели
                        //'visible'=>'(($data->steppersent<100) && (($data->responsibleuserid1=='.$a.')||(int)('.$cat.')))',
                        'url'=>'Yii::app()->createUrl("/DefectsBookStatus/update",array("id"=>$data->id,"par"=>"comment"))',
                        'click'=>'function() {
                                    var url = $(this).attr(\'href\');
                                    $.get(url, function(response) {
                                        $(".InputForm").html(response);
                                    });
                                    return false;
                                }',
                    ),
                ),
                'template'=>'{btnComment}',
                'htmlOptions'=> array('width'=>'180px'),
            ),
 * 
 */
    ),
));
?>
<div class="Menu">
<?php
        $this->MenuButton('DefectsBookStatus','create','Ответить','id='.$defectid,'ajax','.InputForm');
?>
</div>
