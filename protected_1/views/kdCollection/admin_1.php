<?php
    switch($switch){
        case 'pe':
            echo $this->renderPartial('_pe'
            ,array(
                'model'=>$model,
                'modelSmkProjectUnit'=>$modelSmkProjectUnit,
                'unitid'=>$unitid
            ));
            break;
        case 'chanel':
            echo $this->renderPartial('_chanels'
            ,array(
                'model'=>$model,
                'modelSmkProjectUnit'=>$modelSmkProjectUnit,
                'unitid'=>$unitid
            ));
            break;
    }
?>

