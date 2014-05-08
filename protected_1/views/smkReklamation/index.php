<?php
/* @var $this SmkReklamationController */
/* @var $model SmkReklamation */
$this->breadcrumbs=array(
	'Smk Reklamations'=>array('index'),
	'Рекламации',
);
?>

<h2>Рекламации</h2>
<?php
    $value=Yii::app()->cache->get('ReklStat');
    if($value===false){
        $sql="CALL smk_reklamation_stat(30);";
            $value=Yii::app()->db->createCommand($sql)->queryAll()[0];
        Yii::app()->cache->set('ReklStat', $value, 100);//записать в кеш на 100 секунд
    }    
?>    
    <table  class="ReklamationStat">
    <thead>
    	<tr>
            <td colspan="5" id="head">Статистика</td>
        </tr>
        <tr align="center" valign="middle" bgcolor="#33FFFF">
            <td width="14%">Всего рекламаций</td>
            <td width="14%">Открыто на сегодня</td>
            <td width="14%">Закрыто на сегодня</td>
            <td width="29%">Открыто за последние 30 дней</td>
            <td width="28%">Закрыто за последние 30 дней</td>
        </tr>
	</thead>
    <tbody>
        <tr align="center" valign="middle" bgcolor="white">
            <td><?php echo $value['rall']?></td>
            <td><?php echo $value['ropen']?></td>
            <td><?php echo ($value['rall']-$value['ropen'])?></td>
            <td><?php echo $value['ropenfrom']?></td>
            <td><?php echo $value['rcloseto']?></td>
        </tr>
    </tbody>
</table>

<div class="Menu">
    <?php
        $this->MenuButton('SmkReklamation','create','Добавить новую рекламацию','','ajax','.InputForm');
        //$this->MenuButton('ServUsers','index','Список менеджеров','par=managerlist','ajax','.InputForm');
    ?>
</div>
<div class="SubMenu">
</div>

<div class="ProjectTable">    
<?php
    $this->renderPartial('index_table', array('model'=>$model));
?>
<div class="status_view"></div>
</div>