<?php

class SmkReklamationController extends CAssaController
{

	public $layout='//layouts/column2';

	public function filters()
	{

		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
                    /*
                        array(                                                  // установим кеширование страницы index на 100 сек
                            'COutputCache + index',
                            'duration'=>100,
                            'varyByParam'=>array('id','SmkReklamation_page','SmkReklamation'),
                        ),
                     * 
                     */
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


    public function actionView($id){
        if(isset($_GET['par'])){
            switch ($_GET['par']){
                case 'attaches':                                                //если хотим посмотреть список приложенных файлов - то выведем их
                    $this->renderPartial('_view_attaches',
                        array('Attaches'=>SmkReklamationAttaches::model()->findAll(array('condition'=>'reklamationstatusid='.$id))
                            )
                    );
                break;
                case 'excel':                                                   //если хотим вывести историю рекламации в excel
                    $objPHPExcel = new PHPExcel();                              //создаем объект Excel
                    $objPHPExcel = PHPExcel_IOFactory::load("XLSTemplates/Reklamation/Reklamation.xlsx");                                                          
                    $objPHPExcel->setActiveSheetIndex(0);                       //активируем первый лист Акт внутренних испытаний
                    $AktSheet = $objPHPExcel->getActiveSheet();                 //формируем объект листа Акт внутренних испытаний

                    $model = $this->loadModel($id); 
                    $AktSheet
                        ->setCellValue('C1',$model->id)
                        ->setCellValue('C2',$model->SmkProjects['Npgvr'])
                        ->setCellValue('C3',$model->object)
                        ->setCellValue('C4',$model->dogovor)
                        ->setCellValue('C5',$model->contactFIO)
                        ->setCellValue('C6',$model->contactTel)
                        ->setCellValue('C7',$model->problemname)
                        ->setCellValue('C8',$model->creator["FIO2"])
                        ->setCellValue('C9',Yii::app()->dateFormatter->format('d MMMM yyyy г.',$model->datecreaterecord))
                        ->setCellValue('C10',SmkReklamationStatus::model()->findByPk($model->laststatusid)->status['name']);
                    
                    $modelstatus = SmkReklamationStatus::model()->findAll(array('condition'=>'reklamationid='.$id));
                    $rw=13;
                    $input = $AktSheet->getStyle('A'.$rw);
                    foreach($modelstatus as $row=>$value){
                        $AktSheet
                            ->setCellValue('A'.$rw,$value->id)
                            ->setCellValue('B'.$rw,$value->status['name'])
                            ->setCellValue('C'.$rw,$value->creator->FIO2)
                            ->setCellValue('D'.$rw,$value->managercoment)
                            ->setCellValue('E'.$rw,$value->responsibleuser1['FIO2'])
                            ->setCellValue('F'.$rw,$value->datestart)
                            ->setCellValue('G'.$rw,$value->datestartfact)
                            ->setCellValue('H'.$rw,$value->datestop)
                            ->setCellValue('I'.$rw,$value->datestopfact)
                            ->setCellValue('j'.$rw,$value->comment)
                            ->setCellValue('K'.$rw,$value->attache?'+':'')
                                ;
                        if($rw>13){
                            $interval='A'.$rw.':K'.$rw;
                            $AktSheet->duplicateStyle($input, $interval);
                        }
                        $rw++;
                    }
                    ob_end_clean();
                    ob_start();
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="Akt_Protokol.xls"');
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                    $objWriter->save('php://output');
                break;
            }
        }
        else{
            $model = $this->loadModel($id); 
            $modelstatus = new SmkReklamationStatus();
            $modelstatus->unsetAttributes();  // clear any default values
            if(isset($_GET['SmkReklamationStatus'])) $modelstatus->attributes=$_GET['SmkReklamationStatus'];
            if(isset($_GET['task'])){
                switch($_GET['task']){
                    case 1:
                        Yii::app()->db->createCommand('INSERT INTO smk_reklamation_email_list (userid,reklamationid) VALUES ('.Yii::app()->user->id.','.$id.');')->query();
                        break;
                    case 0:
                        Yii::app()->db->createCommand('DELETE FROM smk_reklamation_email_list WHERE userid='.Yii::app()->user->id.' AND reklamationid='.$id.';')->query();
                        break;
                }
            }
            $this->render('view',array(
                    'model'=>$model,
                    'modelstatus'=> $modelstatus,//->srcView($model->id),//   $this->loadModelStatus($model->id),                    
            ));
        }
    }

    public function actionCreate(){//создание новой заявки на рекламацию
        $model=new SmkReklamation;
        if(isset($_POST['SmkReklamation'])){
            $model->attributes=$_POST['SmkReklamation'];
            $model->projectid=$_POST['SmkReklamation']['projectid'];
            $model->problemname=$_POST['SmkReklamation']['problemname'];
            $model->datecreaterecord=date("Y-m-d H:i:s", time());
            $model->signaturecreator=Yii::app()->user->id;
            $model->aktpath=time().'-'.$_FILES['SmkReklamation']['name']['aktpath'];
            $model->state=true;
            if($model->save()){
                $model_status=new SmkReklamationStatus();
                $model_status->reklamationid=$model->id;
                $model_status->statusid=0;                                      //первый статус - ввод рекламации
                $model_status->comment='Ввод новой рекламации';
                $model_status->signaturecreator=Yii::app()->user->id;
                $model_status->datecreaterecord=date("Y-m-d H:i:s", time());
                $model_status->datestart=date("Y-m-d H:i:s", time());
                $model_status->datestop=date("Y-m-d H:i:s",mktime(0, 0, 0, date("m") , date("d")+3, date("Y")));//3 дня даю на чтение новой рекламации
//                $model_status->responsibleuserid1=$adresat['userid'];           //ответственный - менеджер по рекламациям
//                $model_status->responsibleuserid1=0;
                $model_status->mailcount=0;
                $model_status->nexttimemail=date("Y-m-d H:i:s", time());        //время следующей почтовой раасылки - сейчас
                $model_status->steppersent=0;                                   //процент выполнения = 0%
                if($model_status->save()) {
                    $cardImage = \CUploadedFile::getInstance($model,'aktpath'); // загружаем картинку-файл во временную папку
                    if(isset($cardImage)){                                      // записываем наш файл в необходимую папку, это строчка обязательно должна быть в if`е,
                        //добавление в таблицу smk_reklamation_attaches новой записи
                        $path=time().'-'.$cardImage->name;
                        $mod= new SmkReklamationAttaches;
                        $mod->path=$path;
                        $mod->reklamationstatusid=$model_status->id;
                        $mod->save();
                        $cardImage->saveAs('data/reklamation/'.$path);
                        $model_status->attache=true;
                        $model_status->save();
                    }
                    $model->laststatusid=$model_status->id;                     //обновить в модели последний статус
                    $model->save();
                };
                Yii::app()->cache->delete('Yii.COutputCache.reclamations_cach_table......');           //стереть кеш с таблицей по рекламациям
                $this->redirect(array('index'));
            }
        }
        if(Yii::app()->request->isAjaxRequest)
            $this->renderPartial('create_form',array(
                'model'=>$model,
            ));
        else
            $this->render('create',array(
                'model'=>$model,
            ));
    }
    
    public function actionUpdate($id){

        if(Yii::app()->request->isAjaxRequest){// Если это AJAX - запрос, то обработаем
            $model=$this->loadModel($id);
            if(isset($_POST['SmkReklamation'])){
                $model->attributes=$_POST['SmkReklamation'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
            $this->renderPartial('_update',array(
                    'model'=>$model,
            ));
        }
        else{
            $model=$this->loadModel($id);
            if(isset($_POST['SmkReklamation'])){
                    $model->attributes=$_POST['SmkReklamation'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }
            $this->render('update',array(
                    'model'=>$model,
                    'modelstatus'=>$modelstatus
            ));
        }
    }

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAdminactionIndex()
	{
		$dataProvider=new CActiveDataProvider('SmkReklamation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionAssa()
	{
		$this->render('assa'
		);
        }
	public function actionIndex()
	{
		$model=new SmkReklamation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SmkReklamation']))
			$model->attributes=$_GET['SmkReklamation'];
                if (isset($_GET['ajax'])) {
                    $this->renderPartial('index_table',
                            array('model'=>$model)
                    );
                }else{
                    $this->render('index',array(
                            'model'=>$model,
                    ));
                }
	}

	public function loadModel($id)
	{
		$model=SmkReklamation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smk-reklamation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
