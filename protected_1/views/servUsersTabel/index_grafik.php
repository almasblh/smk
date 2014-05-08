<?php
/*echo '<table id="'.$ym.'">';
    echo '<tr>';
    $ym=split("-",$ym);
    $maxd=date('t',  mktime(0, 0, 0, $ym[0], 1, $ym[1]));
    echo '<td>дни</td>';
    for ($i=1;$i<=$maxd;$i++){
        echo '<td>'.$i.'</td>';
    }
    echo '</tr>';
    echo '<tr>';
    $maxd=date('t',  mktime(0, 0, 0, $ym[0], 1, $ym[1]));
    echo '<td>начало</td>';
    for ($i=1;$i<=$maxd;$i++){
        echo '<td>'.$i.'</td>';
    }
    echo '</tr>';
    echo '<tr>';
    echo '<td>конец</td>';
    $maxd=date('t',  mktime(0, 0, 0, $ym[0], 1, $ym[1]));
    for ($i=1;$i<=$maxd;$i++){
        echo '<td>'.$i.'</td>';
    }
    echo '</tr>';    
echo '</table>';
 * 
 */
$y_m=split("-",$ym);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tabel'.$ym,
	'dataProvider'=>$model->search(yii::app()->user->id,$model->date),
	'filter'=>$model,
	'columns'=>array(
                array('name'=>'date',
                ),
                array('name'=>'timestart',
                ),
                array('name'=>'timestop',
                ),
                array('name'=>'отработано',
                ),
                array('name'=>'сверхурочно',
                ),
		/*array(
			'class'=>'CButtonColumn',
		),
                 * 
                 */
	),
));
?>
