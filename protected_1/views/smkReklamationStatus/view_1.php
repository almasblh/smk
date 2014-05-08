<?php
/* @var $this SmkReklamationStatusController */
/* @var $model SmkReklamationStatus */

$this->breadcrumbs=array(
	'Smk Reklamation Statuses'=>array('index'),
	$model->id,
);

?>

<h1>View SmkReklamationStatus #<?php echo $model->id; ?></h1>

<?php
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'reklamationid',
		'statusid',
		'comment',
		'signaturecreator',
		'datecreationrecord',
		'datestart',
		'datestop',
		'responsibleuserid1',
		'responsibleuserid1',
		'responsibleuserid1',
        ),
    ));
?>
