<?php
$this->breadcrumbs=array(
	'Smk Project Units'=>array('index'),
	'Шкаф '.$model->ReestrUnitName->caption,
);

?>

<h1><?php echo 'Шкаф '.$model->ReestrUnitName->caption; ?></h1>

<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            //'id',
            'SmkProjects.Npgvr',
            'ReestrUnitName.ReestrSystemName.caption',
            'ReestrUnitName.caption',
            'lastKD'
	),
    ));
?>
<div class="Menu">
    <?php
        $this->MenuButton('Konstrucktor','create','Собрать проект из КД (BOM-файла)','id='.$model->id.'&unitid='.$model->unitid.'&lastKD='.$model->lastKD);
        $this->MenuButton('KdCollection','admin','Список каналов','&id='.$model->id.'sw=chanel');
        $this->MenuButton('KdCollection','admin','Перечень элементов','id='.$model->id.'&sw=pe');
        //$this->MenuButton('KdCollection','admin','Список автоматов','id='.$model->id.'&sw=qf');
       

    ?>
</div>