<?php
    $this->breadcrumbs=array(
            'Список по Электробезопасности',
    );
?>
<h1>Список пользователей по Электробезопасности</h1>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'elbez-user-card-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            array('name'=>'userid',
                'value'=>'$data->user->FIO',
                'filter'=>$model->GetUsersList(),
                ),
            array('name'=>'lastgrup',
                'value'=>array($model,'getLastGgrup'),
                ),
            array('name'=>'lastdateinspection',
                ),
            array('name'=>'lastrating',
                ),
            array('name'=>'dateinspection',
                ),
            array('name'=>'grup',
                'value'=>array($model,'getGgrup'),
                ),
            array('name'=>'rating',
                ),
            array('name'=>'ndocument',
                ),
            array('name'=>'nprotokol',
                ),
            array('name'=>'typeinspection',
                'value'=>'$data->typeinspection.\', \'.$data->exttypeinspection'
                ),
            array('name'=>'nextdateinspection',
                ),
		/*
		'typeinspection',
		'exttypeinspection',
		'nprotokol',
		'lastgrup',
		'lastdateinspection',
		'lastrating',
		'nextdateinspection',
		'signatureusertest1',
		'signatureusertest2',
		'signatureusertest3',
		'signatureusertest4',
		'signatureusertest5',
		'typepersonal',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

