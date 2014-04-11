<?php
/*    if($this->beginCache('reclamations_cach_table',
        array(//'duration'=>30,
                'varyByRoute'=>false,
                'varyByParam'=>array(
                    'id','SmkReklamation_page','SmkReklamation','SmkReklamation_sort'
                ),
            )
        )
    )
 * 
 */ {
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'smk-reklamation-grid',
            'dataProvider'=>$model->search(),
            'rowHtmlOptionsExpression'=>array($model,'getRowHtmlOptions'),          //метод модели
            'filter'=>$model,
            //'afterAjaxUpdate'=>'function(id, data) {$.fn.setPreviewLinksHandler(id, data);}',
            'columns'=>array(
                array('name'=>'id',
                    'type'=>'html',
                    'value'=>'CHtml::link($data->id,
                        CHtml::normalizeURL(array(
                            \'SmkReklamation/view&id=\'.$data->id
                            ))
                        )',
                    'htmlOptions'=>array(
                        'style'=>'width:2%',
                    )
                ),

                array('name'=>'st',
                    'value'=>'$data->state?($data->status->steppersent<100?"":"+"):"+++"',
                    //'filter'=>array(0=>'отработано', 1=> 'в работе'),
                    'htmlOptions'=>array(
                        'style'=>'width:1%;text-align:center',
                    )
                ),
                array('name'=>'projectid',
                    'value'=>'$data->SmkProjects->Npgvr',
                    'filter'=>$model->GetPGVRList(),
                    'htmlOptions'=>array(
                        'style'=>'width:2%',
                    )
                ),
                array('name'=>'problemname',
                    'type'=>'html',
                    'value'=>array($model,'getProblemComent'),                      //метод модели
                    'htmlOptions'=>array(
                        'style'=>'text-align:left',
                    )
                ),
                array('name'=>'datecreaterecord',
                    'type'=>'text',
                    'htmlOptions'=>array(
                        'style'=>'width:7%',
                    ),
                ),
                array('name'=>'countdays',
                    'type'=>'text',
                    'htmlOptions'=>array(
                        'style'=>'width:2%',
                    ),
                ),
                array('name'=>'signaturecreator',
                    'type'=>'raw',
                    'value'=>'CHtml::link(
                                CHtml::encode($data->creator->FIO2),
                                "http://intranet.sintek.net/phone/newwin.php?menu_marker=si_employeeview&dn=CN=".
                                $data->creator->FIO
                                .",OU=".
                                $data->creator->ReestrOfficeLocate->name
                                .",OU=SINTEK,DC=intranet-sintek,DC=net",
                                array(\'target\'=>\'_blank\')
                            )',
                    'filter'=>$model->GetUsersList(),                            //взять список всех пользователей из сессии
                    'htmlOptions'=>array(
                        'style'=>'width:8%',
                    )
                ),
/*                array('name'=>"laststatusid",
                    'value'=>'$data->status[\'statusid\']',
                    'filter'=>$this->GetReestrReklamationStatusName(),
                    'htmlOptions'=>array(
                        'style'=>'width:1%;text-align:center',
                    )
                ),
 * 
 */
                array('name'=>'laststatusid',
                    'type'=>'html',
                    'filter'=>$model->GetReestrReklamationStatusName(),
                    'value'=>'$data->status->status->name',
                    //'value'=>array($model,'getValueLastStatus'),                    //метод модели
                ),
                array('name'=>'status.responsibleuser1',
                    'type'=>'html',
                    'value'=>'
                        $data->status->responsibleuser1 ?
                        CHtml::link(CHtml::encode($data->status->responsibleuser1->FIO2),
                        "http://intranet.sintek.net/phone/newwin.php?menu_marker=si_employeeview&dn=CN=".$data->status->responsibleuser1->FIO.",OU=".$data->status->responsibleuser1->ReestrOfficeLocate->name.",OU=SINTEK,DC=intranet-sintek,DC=net",
                        array(\'target\'=>\'_blank\'))
                        :
                        "-"
                    ',
                    'filter'=>$model->GetUsersList(),                            //взять список всех пользователей из сессии
                    'htmlOptions'=>array(
                        'style'=>'width:8%',
                    )
                ),
            ),

        ));
        //$this->endCache();
    }
?>
