<?php
/* @var $this AdministrtionController */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('name-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

$this->breadcrumbs=array(
	'Administrtion',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
<?php
    $this->widget('zii.widgets.grid.CGridView', array(
           'id'=>'Serv-Users-Access-Controllers-grid',
           'dataProvider'=>$model->search(),
           //'filter'=>$model,
           'columns'=>array(
                   //'id',
                    array(//'name'=>'ServControllers.name',
                            'header'=>'Контроллер',
                            'value'=>'$data->ServControllers->name',
                            //            'value' => 'CHtml::link(CHtml::encode($data->artist->name), - пример на будущее
                            //                         array("artist/view","id" => $data->artist->id))',                        
                            'htmlOptions'=> array('width'=>'17%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'Caption',
                            'value'=>'$data->ServControllers->caption',
                            'htmlOptions'=> array('width'=>'25%'),
                            'sortable'=>true,
                     ),
                    'ServUser.fname',     
                    /*array(  'header'=>'Юзер',
                            'value'=>'$data->ServUser->fname',
                            'htmlOptions'=> array('width'=>'10%'),
                            'sortable'=>true,
                     ),
                     * 
                     */

                    array(  'header'=>'Категория',
                            'value'=>'$data->ServUsersCategory->name',
                            'htmlOptions'=> array('width'=>'10%'),
                        
                            'sortable'=>true,
                     ),
                    array(  'header'=>'visible',
                            'value'=>'$data->visible',
                            'htmlOptions'=> array('width'=>'4%'),
                            'type' => 'raw',
                            'sortable'=>true,
                            'filter'=>true,
                     ),
                    array(  'header'=>'index',
                            'value'=>'$data->index',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'list',
                            'value'=>'$data->list',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'create',
                            'value'=>'$data->create',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'view',
                            'value'=>'$data->view',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'update',
                            'value'=>'$data->update',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'delete',
                            'value'=>'$data->delete',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                    array(  'header'=>'admin',
                            'value'=>'$data->admin',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),
                   array(
                        'class'=>'CButtonColumn',
                   ),
           ),

    ));
    
    $this->widget('zii.widgets.grid.CGridView', array(
           'id'=>'Serv-Controllers-grid',
           'dataProvider'=>$model1->search(),
           //'filter'=>$model1,
           'columns'=>array(
                    'id',
                    'name',
                    'caption',
                    'parrentcontrollerid',
                    /*array(  'header'=>'parent cont name',
                            'value'=>'$data->admin',
                            'htmlOptions'=> array('width'=>'4%'),
                            'sortable'=>true,
                     ),

                   array(
                        'class'=>'CButtonColumn',
                   ),
                     * 
                     */
            ),

    ));

 ?>
</p>
