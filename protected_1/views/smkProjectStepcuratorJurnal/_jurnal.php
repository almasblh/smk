<table>
    <tr>
        <td></td>
        <td>
<h4>Записи журнала</h4>
<?php
    foreach($model as $row){
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'jurnal-steps-grid',
            'dataProvider'=>$row->search(),
            'columns'=>array(
                'daterecord',
                'current_percent',
                'comment',
               // array('name'=>'signaturestepcurator',
               //     'type'=>'html',
               //     'value'=>'CHtml::link(CHtml::encode($data->signaturestepcurator["FIO"]),array("ServUsers/view","id"=>$data->signaturestepcurator))'
               // ),
               // 'signaturestepcurator'
            ),
        ));
    }
    echo CHtml::link(
        'Добавить еще запись в журнал',
        CHtml::normalizeUrl(array('SmkProjectStepcuratorJurnal/Create','projectstepid'=>$row->projectstepid))
    );
?>
        </td>
    </tr>
</table>


