<?php
/*    if($this->beginCache('serv_users_list',
        array(
            'duration'=>300,
                'varyByRoute'=>false,
                'varyByParam'=>array(
                    'id','ServUsers_page','ServUsers','ServUsers_sort','elbezid'
                ),
            )
        )
    )
 * 
 */
    {   //$a='Yii.COutputCache.'.'serv_users_list'.Yii::app()->language.'..'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id.'....';
        $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'serv-users-grid',
	'dataProvider'=>$model->search(),
        'summaryText'=>'Показано с {start} по {end} из {count}',
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'fname',
                'type'=>'html',
                'value'=>array($model,'getUserLink'),
            ),
            'sname',
            'tname',
            array('name'=>'elbezid',
                'type'=>'raw',
                'value'=>array($model,'getElBez'),
                'htmlOptions'=>array(
                    'style'=>'width:1%;text-align:center;',
                ),
                'cssClassExpression'=>array($model,'getElBezHtmlOptions'),
                'filter'=>array('0'=>'ok','1'=>'здать','2'=>'распечатать протокол','3'=>'сохранить скан'),
            ),
            array('name'=>'dolgnostid',
                'type'=>'html',
                'value'=>'$data->ServUsersDolgnost->name',
                'filter'=>$model->GetServUsersDolgnost(),
            ),
            array('name'=>'departamentid',
                'type'=>'html',
                'value'=>'$data->ServUsersDepartament->name',
                'filter'=>$model->GetServUsersDepartament(),
                ),
            array('name'=>'otdelid',
                'type'=>'html',
                'value'=>'$data->ServUsersOtdel->name',
                'filter'=>$model->GetServUsersOtdel(),
            ),
             array('name'=>'category',
                'type'=>'html',
                'value'=>'$data->ServUsersCategory["name"]',
            ),
            'tel_in',
            'tel_mob',
            array('name'=>'email',
                'type'=>'html',
                'value' => 'CHtml::mailto($data->email)',                    
            ),
            array('name'=>'officelocate',
                'value' =>'$data->ReestrOfficeLocate->name',// array($model,'getOffice'),
                'filter'=>$model->GetReestrOfficeLocate(),
            )
	)
    ));
   // $this->endCache();
}
?>

