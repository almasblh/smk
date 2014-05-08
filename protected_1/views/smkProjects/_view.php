<div class="view">
    <table>
        <tr>
            <td>
                <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'data'=>$data,
                        'attributes'=>array(
                            'Npgvr',
                            'Name',
                            //'dogovor',
                            array('name'=>'managerid',
                                'type'=>'html',
                                'value'=>CHtml::link(CHtml::encode($data->manager["FIO"]),array("ServUsers/view","id"=>$data->managerid))
                            ),
                            array('name'=>'kuratorid',
                                'type'=>'html',
                                'value'=>CHtml::link(CHtml::encode($data->kurator["FIO"]),array("ServUsers/view","id"=>$data->kuratorid))
                            ),
                            array('name'=>'percentage_complet',
                                'type'=>'html',
                                'value'=>$data->percentage_complet,
                                'cssClass'=>($data->percentage_complet<50) ? 'redBackground' : 'blackBackground',
                            )
                        ),
                    ));
                ?>
            </td>
            <td>
                <?php
                echo CHtml::link(
                        'Посмотреть детально',
                        CHtml::normalizeUrl(array('SmkProjects/view','id'=>$data->id))
                    );
/*                echo '</br >';
                echo CHtml::link(
                        'Добавить данные по этапам',
                        CHtml::normalizeUrl(array('SmkProjectStep/Create','projectid'=>$data->id))
                    );
 * 
 */
                ?>
            </td>
        </tr>
    </table>

</div>