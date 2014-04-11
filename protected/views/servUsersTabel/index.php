<?php
/* @var $this ServUsersTabelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Табель',
);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/ServUsersTabel/grafik.js');
?>

<h2>Табель</h2>

<?php
    $manthstring=array(
     'январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь'  
    );

    for($year=2013;$year<(2013+10);$year++){
        echo CHtml::button($year.' год',
                array(
                    'name'=>'button'.$year,
                    'style'=>'width:100%;background-color:#C5FBBD;border:1px #009933;border-style:outset;',
                    'class'=>'year-button'
                )
            );
        echo '<div id=year'.$year.' style="display:none">';
        for($manth=1;$manth<13;$manth++){
            echo CHtml::ajaxbutton($manthstring[$manth-1],
                    CHtml::normalizeUrl(array(
                            'ServUsersTabel/index'
                        )
                    ),
                    array('type' => 'POST',
                            'data'=>array('ym'=>'js:this.name'),
                            'success' => "function(data){
                                var div = document.createElement('div');
                                div.innerHTML=data
                                var elems = div.getElementsByTagName('table')
                                $('#'+elems[0].id).html(data);
                            }",
                    ),
                    array(
                        'name'=>$manth.'-'.$year,
                        'id'=>'button-manth',
                        'style'=>'width:100px;margin-left:20px',
                     )
                );
            echo '<div id='.$manth.'-'.$year.'></div>';
        }
        echo '</div>';
    }
    echo '<div id=assa></div>';
?>
