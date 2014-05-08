<?php
class OimPmiTestsController extends CAssaController
{
    public $layout='//layouts/column2';
    
    public function actionIndex(){
        $model = new SmkProjectStep();
        if(isset($_REQUEST['SmkProjectStep']))
            $model->attributes=$_REQUEST['SmkProjectStep'];        
        $this->render('index',array(
                'model'=>$model,
        ));
    }
    
    public function actionView($id){
        $test=Yii::app()->user->getState('activeproject');
        if($id>0)//если есть ид - то запишем новый активный проект
            if($id<>$test)
                $this->ActiveProjectSessionSave($id);
        else{
            if(isset($test))//если нет ил но есть активный проект то используем его как ид
                 $id=$test;
            else
                return;//здесь надо вывести ошибку что ничего нет exeption!!!!!!!
        };        
        $this->render('view',array(
                'model'=>SmkProjectStep::model()->find(array('condition'=>'projectid='.$id)),//' AND stepid=10')),
        ));
    }    
    
    public function actionTest(){
        
        $model=new KdCollection(('srchProbiv'));
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['KdCollection']))
                $model->attributes=$_GET['KdCollection'];

        $this->render('test',array(
                'model'=>$model,
        ));
    }

    public function actionOtchets($id=0){                                       //модуль создания отчетов по внутренним испытаниям отдела испытаний
        //setlocale(LC_ALL, 'rus');                                             //установка русской локали
        if(isset($_GET['sw'])){                                                 //обработка кнопок (селектируются по параметру sw)
            switch($_GET['sw']){
                case 'akt_prot_in_test':                                        //если требуется вывести протокол в ексел - то выводим
                    $project = SmkProjects::model()->findByPk($id);             //модель проекта
                    $units = SmkProjectUnits::model()                           //модель шкафов в составе проекта
                            ->with('ReestrUnitName')
                            ->findAll(array('condition'=>'projectid='.$id));
                    $step = SmkProjectStep::model()                             //модель этапа внутренних испытаний
                        ->find(array('condition'=>'projectid='.$id.' AND stepid=10'));
                    $str_units='';                                              //формирование списка шкафов которые проверялись
                    foreach($units as $row=>$value){
                        switch($value->ReestrUnitName->systemid){               //формирование первого номера ВКПЕ
                            case 2: $vkpe='420140';
                                break;
                            default: $vkpe='421457';
                        }
                        $pgvr=explode (".",$project->Npgvr);                    //формирование второго номера ВКПЕ ПГВР(первый номер)
                        $zavN=sprintf('%03d',$value->vkpeN);                    //формирование третьего номера ВКПЕ - заводской номер
                        $str_units.='Шкаф '                                 //формирование строки с перечнем шкафов в проекте
                            .$value->ReestrUnitName->caption
                            .' ВКПЕ '
                            .$vkpe.'.'.$pgvr[0].'.'.$zavN
                            .' сер.№ '
                            .$pgvr[0].$zavN
                            ."\n";
                    }

                    $objPHPExcel = new PHPExcel();                              //создаем объект Excel
                    switch($units[0]->ReestrUnitName->systemid){                //определяем принадлежность системы (АСУТП АСУПТ телемеханика) - пока затычка
                        case 1:                                                 //????????????????????????? в последствии надо-бы разделить все шкафы по системам и генерить отдельные протоколы
                                $objPHPExcel = PHPExcel_IOFactory::load(        //если это АСУ ТП
                                    "XLSTemplates/OIM/Template_XLS_In_Test_Akt_Protokol_ASUTP.xlsx"
                                );                                              //загружаем шаблон АСУ ТП
                                $instr="АСУ ТП";
                            break;
                        case 2:
                                $objPHPExcel = PHPExcel_IOFactory::load(        //если это АСУ ПТ
                                    "XLSTemplates/OIM/Template_XLS_In_Test_Akt_Protokol_ASUPT.xlsx"
                                );                                              //загружаем шаблон  АСУ ПТ
                                $instr="АСУ ПТ";
                            break;
                        case 3:                                                 // если это телемеханика
                                $objPHPExcel = PHPExcel_IOFactory::load(
                                    "XLSTemplates/OIM/Template_XLS_In_Test_Akt_Protokol_SHTM.xlsx"
                                );                                              //загружаем шаблон телемеханики
                                $instr="телемеханики";
                            break;
                        default:
                            
                    }
                    $objPHPExcel->setActiveSheetIndex(0);                       //активируем первый лист Акт внутренних испытаний
                    $AktSheet = $objPHPExcel->getActiveSheet();                 //формируем объект листа Акт внутренних испытаний
                    $date=$step->datestartfact;
                    $str_period='C '
                            .Yii::app()->dateFormatter->format('d MMMM yyyy г.', $step->datestartfact)
                            .' по '
                            .Yii::app()->dateFormatter->format('d MMMM yyyy г.', $step->datestopfact);
                    $str=$str_period
                        ." провела внутренние испытания системы "
                        .$instr." в составе:\n"
                        .$str_units
                        ."Объекта "
                        .$project->object.', ПГВР № '.$project->Npgvr;                        
                    $AktSheet
                        ->setCellValue('BJ4', Yii::app()->dateFormatter->format('d MMMM yyyy г.', time()))
                        ->setCellValue('BN8', Yii::app()->dateFormatter->format('d MMMM yyyy г.', time()))
                        ->setCellValue('A6', 'системы '.$instr.' объекта '.$project->object.', ПГВР № '.$project->Npgvr)
                        ->setCellValue('A20', $str);

                    $objPHPExcel->setActiveSheetIndex(1);                       //активируем второй лист Протокол внутренних испытаний
                    $ProtokolSheet = $objPHPExcel->getActiveSheet();            //формируем объект листа Протокол внутренних испытаний
                    $ProtokolSheet
                        ->setCellValue('B1', Yii::app()->dateFormatter->format('d MMMM yyyy г.', time()))
                        ->setCellValue('Z9', $str_period
                        )
                        ->setCellValue('W6', $project->object.', ПГВР № '.$project->Npgvr)
                        ->setCellValue('W7', $str_units);
                    ob_end_clean();
                    ob_start();
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="Akt_Protokol.xls"');
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                    $objWriter->save('php://output');
                break;
                case 'akt_in_test':                                             //если требуется вывести акт в ексел - то выводим

                break;
            }
        }
    }

    public function loadModel($id)
    {
            $model=SmkProjectStep::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }    
}
?>
