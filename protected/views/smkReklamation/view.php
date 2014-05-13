<?php
$this->breadcrumbs=array(
	'Smk Reklamations'=>array('index'),
	$model->id,
);
?>

<h2>Рекламация №<?php echo $model->id; ?></h2>
<div class="Menu">
    <?php
        $this->MenuButton('SmkReklamation','index','Рекламации');
        $this->MenuButton('SmkReklamation','update','Редактировать рекламацию','id='.$model->id,'ajax','.InputForm');
        $this->MenuButton('SmkReklamation','view','Вывод в Excel','id='.$model->id.'&par=excel');
        $rid=Yii::app()->db->createCommand('SELECT userid AS `0` FROM smk_reklamation_email_list WHERE userid='.Yii::app()->user->id.' AND reklamationid='.$model->id.';')->queryRow();
        if(!isset($rid[0]))
            $this->MenuButton('SmkReklamation','view','ВКЛЮЧИТЬ в рассылку','id='.$model->id.'&task=1');
        else
            $this->MenuButton('SmkReklamation','view','УДАЛИТЬ из рассылки','id='.$model->id.'&task=0');
    ?>
</div>
<div class="MoreComment ui-widget-content"></div>
<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            array('name'=>'SmkProjects.Npgvr',
                'type'=>'html',
                'value'=>CHtml::link($model->SmkProjects['Npgvr'],
                    CHtml::normalizeURL(array(
                        'SmkProjects/view&select=1&id='.$model->projectid
                        ))
                    )
            ),
            array('name'=>'object',
                'value'=>($model->projectid==106)?$model->object:$model->SmkProjects['object']
            ),
            array('name'=>'dogovor',
                'value'=>($model->projectid==106)?$model->dogovor:$model->SmkProjects['dogovor']
            ),
            array('name'=>'contactFIO'
            ),
            array('name'=>'contactTel'
            ),
            array('name'=>'problemname'
            ),
            array('name'=>'signaturecreator',
                'type'=>'html',
                'value'=>CHtml::link(CHtml::encode($model->creator["FIO2"]),
                            array("ServUsers/view","id"=>$model->signaturecreator)
                        )
            ),
            array('name'=>'datecreaterecord',
                'value'=>Yii::app()->dateFormatter->format('d MMMM yyyy г.',$model->datecreaterecord).' (Прошло '.$model->countdays.' дн. со дня создания рекламации)'
            ),
            array('name'=>'laststatusid',
                'type'=>'text',
                'value'=>SmkReklamationStatus::model()->findByPk($model->laststatusid)->status['name'],
            ),
	),
    ));
    
    

    
    
?>
<h2>Этапы</h2>

<h6>Приложения</h6>
<div class="Ataches">---</div>
<?php
    $a=Yii::app()->user->id;
    $cat=Yii::app()->user->getState('reklmanager');
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smk-reklamation-status-grid',
	'dataProvider'=>$modelstatus->srcView($model->id),
        'rowHtmlOptionsExpression'=>array($modelstatus,'getRowColor'),          //метод модели
	'columns'=>array(
            array('name'=>'id',
                'htmlOptions'=> array('width'=>'30px'),
            ),
            array('name'=>'statusid',
                'type'=>'html',
                'value'=>array($modelstatus,'getStatus'),                       //метод модели
                'htmlOptions'=> array('width'=>'180px'),
            ),
            array('name'=>'signaturecreator',
                'type'=>'html',
                'value'=>'CHtml::link(
                            CHtml::encode($data->creator->FIO2),
                            "http://intranet.sintek.net/phone/newwin.php?menu_marker=si_employeeview&dn=CN=".
                            $data->creator->FIO
                            .",OU=".
                            $data->creator->ReestrOfficeLocate->name
                            .",OU=SINTEK,DC=intranet-sintek,DC=net",
                            array(\'target\'=>\'_blank\')
                        )',
                'htmlOptions'=> array('width'=>'150px'),
            ),
            array(
                'name'=>'managercoment',
                'type'=>'html',
                'value'=>array($modelstatus,'getTask'),                         //метод модели
            ),
            array('name'=>'responsibleuserid1',
                'type'=>'html',
                'value'=>'
                    $data->responsibleuser1 ?
                    CHtml::link(CHtml::encode($data->responsibleuser1->FIO2),
                    "http://intranet.sintek.net/phone/newwin.php?menu_marker=si_employeeview&dn=CN=".$data->responsibleuser1->FIO.",OU=".$data->responsibleuser1->ReestrOfficeLocate->name.",OU=SINTEK,DC=intranet-sintek,DC=net",
                    array(\'target\'=>\'_blank\'))
                    :
                    "-"
                ',
                'htmlOptions'=> array('width'=>'100px'),
            ),
            array('name'=>'datestart',
                'htmlOptions'=> array('width'=>'90px','align'=>'center'),
            ),            
            array('name'=>'datestartfact',
                'htmlOptions'=> array('width'=>'90px','align'=>'center'),
                //'null'=>'-',
            ),            
            array('name'=>'datestop',
                'type'=>'raw',
                'value'=>array($modelstatus,'getDateStop'),                     //метод модели
                'htmlOptions'=> array('width'=>'90px','align'=>'center'),
            ),            
            array('name'=>'datestopfact',
                'htmlOptions'=> array('width'=>'90px','align'=>'center'),
            ),            
            array('name'=>'comment',
                'type'=>'raw',
                'value'=> array($modelstatus,'getComent'),                      //метод модели
                'cssClassExpression'=>'($data->comment) ? "greenBackground" : "yelloBackground" '
            ),
            array('name'=>'attache',
                'type'=>'raw',
                'value'=>'$data->attache
                     ?  CHtml::ajaxlink(
                            CHtml::image(\'./images/document3232.png\',\'file\'),
                                Yii::app()->createUrl("/SmkReklamation/view",array("id"=>$data->id,"par"=>"attaches")),
                            array(\'type\' => \'POST\',
                                \'update\' => \'.Ataches\'
                            )
                        )
                    : ""
                    ',
            ),
            array(
                'class'=>'CButtonColumn',
                'header'=>'Действия',
                'buttons'=>array(
                    'btnComment'=>array(
                        'label'=>'Добавить комментарий',
                        'visible'=>array($modelstatus,'getVisiblebtnComment'),                     //метод модели
                        //'visible'=>'(($data->steppersent<100) && (($data->responsibleuserid1=='.$a.')||(int)('.$cat.')))',
                        'url'=>'Yii::app()->createUrl("/SmkReklamationStatus/update",array("id"=>$data->id,"par"=>"comment"))',
                        'click'=>'function() {
                                    var url = $(this).attr(\'href\');
                                    $.get(url, function(response) {
                                        $(".InputForm").html(response);
                                    });
                                    return false;
                                }',
                    ),
                    'btnStatus'=>array(
                        'label'=>'Изменить статус',
                        'visible'=>array($model,'getVisiblebtnStatus'),                     //метод модели
                        //'visible'=>'(('.$model->laststatusid.'==$data->id) && ('.$cat.'))',
                        'url'=>'Yii::app()->createUrl("/SmkReklamationStatus/update",array("id"=>$data->id,"par"=>"changestatus"))',
                        'click'=>'function(){
                                    var url = $(this).attr(\'href\');
                                    $.get(url, function(response) {
                                        $(".InputForm").html(response);
                                    });
                                    return false;
                                }',
                    ),
                ),
                'template'=>'{btnComment} {btnStatus}',
                'htmlOptions'=> array('width'=>'180px'),

            ),

	),
    ));

    
    ?>

