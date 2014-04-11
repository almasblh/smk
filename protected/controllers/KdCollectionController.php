<?php

class KdCollectionController extends CAssaController
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
	{
		$modellastKD = KdCollection::model()
                ->find(array('select'=>'max(version)'
                    ,'condition'=>'prunitid='.$id
                ));
                $lastKD=isset($modellastKD)?$modellastKD->max(version):0;
                $this->render('view',array(
                    'model'=>$this->loadModel($id)
                    ,'lastKD'=>$lastKD
		));
	}

	public function actionCreate()
	{
		$model=new KdCollection;

		if(isset($_POST['KdCollection']))
		{
			$model->attributes=$_POST['KdCollection'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['KdCollection']))
		{
			$model->attributes=$_POST['KdCollection'];
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('KdCollection');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionAdmin($id=0){//id - уникальный номер шкафа в базе
        $modelSmkProjectUnit = SmkProjectUnits::model()                         // эта модель со списком всех шкафов в проекте id
            ->with('ReestrUnitName','SmkProjects')
            ->find(array('condition'=>'t.id='.$id));
        if(isset($_GET['sw'])){                                                 //обработка кнопок (селектируются по параметру sw)
            switch($_GET['sw']){
                case 'excel':                                                   //если требуется вывести в ексел - то выводим
                    $data= TmpPE::model()->findAll();
                    $objPHPExcel = new PHPExcel();
                    //$objPHPExcel->getDefaultStyle()
                    //    ->getFont()
                    //        ->setName('Arial')
                    //        ->setSize(10);

                    foreach($data as $row=>$value){
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.($row+1), $value['pos_str'])
                            ->setCellValue('B'.($row+1), $value['element_str'])
                            ->setCellValue('C'.($row+1), $value['manufacture_str'])
                            ->setCellValue('D'.($row+1), $value['count_int']);
                    }
                    $objPHPExcel->getActiveSheet()->setTitle('Перечень элементов');
                    $objPHPExcel->setActiveSheetIndex(0);
                    ob_end_clean();
                    ob_start();
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="pe.xlsx"');
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $objWriter->save('php://output');
                break;
                case 'pe':                                                      //если требуется перечень элементов - формирование перечня элементов
                    $db = Yii::app()->db;
                    $sql = "CALL calc_PE({$id})";                               //перечень формируется сервером в процедуре calc_PE
                    $command=$db->createCommand($sql)->query();

                    $model = new TmpPE();
                    $this->render('admin'
                        ,array(
                            'model'=>$model,
                            'modelSmkProjectUnit'=>$modelSmkProjectUnit,
                            'unitid'=>$id,
                            'switch'=>$_GET['sw'],
                        )
                    );
                break;
                case 'chanel':                                                  //если требуется вывести каналы - то выводим каналы
                    $model=new KdCollection;
                    //$model->id=$id;
                    if(isset($_GET['KdCollection']))
                        $model->attributes=$_GET['KdCollection'];
                    $this->render('admin'
                        ,array(
                            'model'=>$model,
                            'modelSmkProjectUnit'=>$modelSmkProjectUnit,
                            'switch'=>$_GET['sw'],
                            'unitid'=>$id
                        )
                    );
                break;
            }
        }
    }
    
    public function loadModel($id){
        $model=KdCollection::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function loadModelActiveProject($id){
        $model=KdCollection::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model){
        if(isset($_POST['ajax']) && $_POST['ajax']==='kd-collection-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}