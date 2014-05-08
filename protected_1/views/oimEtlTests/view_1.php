<?php
/* @var $this OimEtlTestsJurnalController */
/* @var $model OimEtlTestsJurnal */

$this->breadcrumbs=array(
	'Испытание '=>array('index'),
	$model->id,
);

?>

<h1>Испытание №<?php echo $model->num; ?></h1>

<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'num',
            array('name'=>'testid',
                'value'=>$model->ReestrOimEtlTests->name
            ),
            array('name'=>'projectid',
                'value'=>$model->SmkProjects->Npgvr
            ),
		'datestart',
		'datestop',
		'ServUsersTester1.FIO',
		'ServUsersTester2.FIO',
		'ServUsersTester3.FIO',
		'resume',
		'comment',
	),
    ));
    

    
?>
