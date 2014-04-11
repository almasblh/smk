<?php

class OimEtlTestsController extends CAssaController
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

        
    public function accessRules(){// правила доступа к ресурсам контроллера
        $f=array();
        if(!Yii::app()->user->getState('sup')){
            $f=$this->ActionsForUser(__CLASS__);
        }
        return array(
            array('allow',  // список разрешений
                'actions'=>$f,
                'users'=>array(Yii::app()->user->id),
            ),
            array('deny',  // список запрещений
                'users'=>array('*','$'),
            ),
        );
    }

	public function actionView($id)
	{   $model=$this->loadModel($id);
            if(!isset($model)){
                $this->redirect(array('index'));
            }
            else{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
            }
	}

        public function actionCreate()
	{
		$model=new OimEtlTests;
                $model->projectid=YII::app()->user->getState('activeproject');

		if(isset($_POST['OimEtlTests']))
		{
			$model->attributes=$_POST['OimEtlTests'];
                        $model->datestart=date("Y-m-d H:i:s", time());
                        $model->datecreaterecord=date("Y-m-d H:i:s", time());
                        $model->signturecreator=YII::app()->user->id;
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['OimEtlTests']))
		{
			$model->attributes=$_POST['OimEtlTests'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$model=new OimEtlTests();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OimEtlTests']))
                    $model->attributes=$_GET['OimEtlTests'];
                if(isset($_GET['testid'])){                                     // если есть параметр testid
                    $modeltest= ReestrOimEtlTests::model()->findByPk($_GET['testid']);
                    $modelizm= new $modeltest->modelname;                       // модель - модель нужного измерения
                    $this->redirect(                                            // то переходим на нужный нам контроллер для ввода измерений по ЭТЛ
                        CHtml::normalizeUrl(
                            array($modeltest->modelname.'/admin&id='.$_GET['id'].'&testid='.$_GET['testid'])
                        )
                    );
                }

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionAdmin()
	{
		$model=new OimEtlTests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OimEtlTests']))
			$model->attributes=$_GET['OimEtlTests'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=OimEtlTests::model()->findByPk($id);
		if($model===null)
                    $this->redirect(array('index'));
			//throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='oim-etl-tests-jurnal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function actionOtchets($id=0){                                       //модуль создания отчетов по испытаниям ЭТЛ

        $jurnal = OimEtlTests::model()->findByPk($id);                          //модель журнала
        $vkpe=$jurnal->SmkProjectUnits->ReestrUnitName->ReestrSystemName->vkpe; //формирование первого номера ВКПЕ
       // switch($jurnal->SmkProjectUnits->ReestrUnitName->systemid){             //формирование первого номера ВКПЕ
       //     case 2: $vkpe='420140';
       //         break;
       //     default: $vkpe='421457';
       // }
        $pgvr=explode (".",$jurnal->SmkProjects->Npgvr);                        //формирование второго номера ВКПЕ ПГВР(первый номер)
        $zavN=sprintf('%03d',$jurnal->SmkProjectUnits->vkpeN );                 //формирование третьего номера ВКПЕ - заводской номер                    
        $str_units=$jurnal->SmkProjectUnits->ReestrUnitName->caption
                .' ВКПЕ '
                .$vkpe.'.'.$pgvr[0].'.'.$zavN
                .' сер.№ '
                .$pgvr[0].$zavN
                ."\n";
        $str_file=$jurnal->SmkProjectUnits->ReestrUnitName->caption
                .' ВКПЕ '
                .$vkpe.'.'.$pgvr[0].'.'.$zavN;
        switch($jurnal->testid){
            case 6:                                                             //если требуется вывести протокол по автоматам
                $objPHPExcel = new PHPExcel();                                  //создаем объект Excel
                $objPHPExcel = PHPExcel_IOFactory::load(
                    "XLSTemplates/ETL/Template_ETL_Avtomt_otchet.xlsx"
                );
                $objPHPExcel->setActiveSheetIndex(0);                           //активируем первый лист
                $AktSheet = $objPHPExcel->getActiveSheet();                     //формируем объект листа 
                $AktSheet                                                       // формируем шапку документа
                    ->setCellValue('AS1', $jurnal->SmkProjects['customer'])
                    ->setCellValue('AS2', $jurnal->SmkProjects['Works'])
                    ->setCellValue('BG3', Yii::app()->dateFormatter->format('d MMMM yyyy г.', $jurnal->datecreaterecord))
                    ->setCellValue('AT5', $jurnal->num)
                    ->setCellValue('A20', $str_units)
                ;                    
                $AktSheet                                                       // формируем подписи документа
                    ->setCellValue('BR92', $jurnal->ServUsersTester1['FIO'])
                    ->setCellValue('BR93', $jurnal->ServUsersTester2['FIO'])
                    ->setCellValue('BR96', $jurnal->ServUsersTester3['FIO'])
                ;
                ob_end_clean();
                ob_start();
                header('Content-Type: application/vnd.ms-excel');
                $str_file='avtomat_'.$str_file.'.xls';
                header('Content-Disposition: attachment;filename='.$str_file);
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                $objWriter->save('php://output');
            break;
            case 4:                                                             //если требуется протокол по заземляющим проводникам
               // $jurnal = OimEtlTests::model()->findByPk($id);             //модель журнала

                $objPHPExcel = new PHPExcel();                              //создаем объект Excel
                $objPHPExcel = PHPExcel_IOFactory::load(
                    "XLSTemplates/ETL/Template_ETL_Zazeml_otchet.xlsx"
                );
                $objPHPExcel->setActiveSheetIndex(0);                       //активируем первый лист
                $AktSheet = $objPHPExcel->getActiveSheet();                 //формируем объект листа 
                $AktSheet
                    ->setCellValue('AS1', $jurnal->SmkProjects['customer'])
                    ->setCellValue('AS2', $jurnal->SmkProjects['Works'])
                    ->setCellValue('BG3', Yii::app()->dateFormatter->format('d MMMM yyyy г.', $jurnal->datecreaterecord))
                    ->setCellValue('AT5', $jurnal->num)
                    ->setCellValue('A18', $str_units)
                ;                    
                $AktSheet                                                       // формируем подписи документа
                    ->setCellValue('BR159', $jurnal->ServUsersTester1['FIO'])
                    ->setCellValue('BR160', $jurnal->ServUsersTester2['FIO'])
                    ->setCellValue('BR162', $jurnal->ServUsersTester3['FIO'])
                ;
                ob_end_clean();
                ob_start();
                header('Content-Type: application/vnd.ms-excel');
                $str_file='zazeml_'.$str_file.'.xls';
                header('Content-Disposition: attachment;filename='.$str_file);
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                $objWriter->save('php://output');
            break;
            case 7:                                                             //если требуется протокол по контуру заземления
               // $jurnal = OimEtlTests::model()->findByPk($id);             //модель журнала

                $objPHPExcel = new PHPExcel();                              //создаем объект Excel
                $objPHPExcel = PHPExcel_IOFactory::load(
                    "XLSTemplates/ETL/Template_ETL_Kontur_Zazeml.xlsx"
                );
                $objPHPExcel->setActiveSheetIndex(0);                       //активируем первый лист
                $AktSheet = $objPHPExcel->getActiveSheet();                 //формируем объект листа 
                $AktSheet
                    ->setCellValue('AS1', $jurnal->SmkProjects['customer'])
                    ->setCellValue('AS2', $jurnal->SmkProjects['Works'])
                    ->setCellValue('BG3', Yii::app()->dateFormatter->format('d MMMM yyyy г.', $jurnal->datecreaterecord))
                    ->setCellValue('AT5', $jurnal->num)
                    ->setCellValue('A18', $str_units)
                ;                    
                $AktSheet                                                       // формируем подписи документа
                    ->setCellValue('BR37', $jurnal->ServUsersTester1['FIO'])
                    ->setCellValue('BR38', $jurnal->ServUsersTester2['FIO'])
                    ->setCellValue('BR40', $jurnal->ServUsersTester3['FIO'])
                ;
                ob_end_clean();
                ob_start();
                header('Content-Type: application/vnd.ms-excel');
                $str_file='kontur_zazeml_'.$str_file.'.xls';
                header('Content-Disposition: attachment;filename='.$str_file);
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                $objWriter->save('php://output');
            break;
            case 1:                                                             //если требуется вывести протокол по сопротивлению изоляции
                $objPHPExcel = new PHPExcel();                                  //создаем объект Excel
                $objPHPExcel = PHPExcel_IOFactory::load(
                    "XLSTemplates/ETL/Template_ETL_Sopr_Izol_otchet.xlsx"
                );
                $objPHPExcel->setActiveSheetIndex(0);                           //активируем первый лист
                $AktSheet = $objPHPExcel->getActiveSheet();                     //формируем объект листа 
                $a=$jurnal->SmkProjects['customer'];
                $b=$jurnal->SmkProjects['object'];
                $AktSheet                                                       // формируем шапку документа
                    ->setCellValue('AS1', $jurnal->SmkProjects['customer'])
                    ->setCellValue('AS2', $jurnal->SmkProjects['Works'])
                    ->setCellValue('BG3', Yii::app()->dateFormatter->format('d MMMM yyyy г.', $jurnal->datecreaterecord))
                    ->setCellValue('AT5', $jurnal->num)
                    ->setCellValue('A20', $str_units)
                ;                    
                $AktSheet                                                       // формируем подписи документа
                    //->setCellValue('A47', $jurnal->ServUsersTester1->ServUsersDolgnost['name'])
                    ->setCellValue('BR47', $jurnal->ServUsersTester1['FIO'])
                    //->setCellValue('A48', $jurnal->ServUsersTester1->ServUsersDolgnost['name'])
                    ->setCellValue('BR48', $jurnal->ServUsersTester2['FIO'])
                    ->setCellValue('BR50', $jurnal->ServUsersTester3['FIO'])
                ;
                ob_end_clean();
                ob_start();
                header('Content-Type: application/vnd.ms-excel');
                $str_file='sopr_izol_'.$str_file.'.xls';
                header('Content-Disposition: attachment;filename='.$str_file);
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                $objWriter->save('php://output');
            break;
        }
    }        
}
