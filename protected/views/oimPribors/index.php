<?php
$this->breadcrumbs=array(
	'Приборы отдела испытаний и метрологии',
);

/*$this->menu=array(
	array('label'=>'Создать новый прибор', 'url'=>array('create')),
	array('label'=>'Управление приборами', 'url'=>array('admin')),
    );
 * 
 */
?>

<h1>Приборы отдела испытаний и метрологии</h1>
<div class="content" id="listwiev">
<?php
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'summaryText'=>'Показано с {start} по {end} из {count}',
        'sorterHeader'=>'Сортировать по:',
        'sortableAttributes'=>array('name','descr','nextpoverdate','wherenow'),
)); ?>
</div>