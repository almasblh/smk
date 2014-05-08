<?php

class OimPriborsController extends CAssaController
{
	public $layout='//layouts/column2';//использование второй колонки

	public function filters(){// описание фильтров
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

	public function actionView($id)//отобразить конкретный прибор
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionCreate()//создание нового прибора
	{
            $model=new OimPribors;
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if(isset($_POST['OimPribors']))
            {
                    $model->attributes=$_POST['OimPribors'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }
            $this->render('create',array(
                    'model'=>$model,
            ));
	}

        public function actionUpdate($id)//обновление данных по прибору
	{
		$model=$this->loadModel($id);
		if(isset($_POST['OimPribors'])){
                    $model->attributes=$_POST['OimPribors'];
                    $documentRoot = $_SERVER['DOCUMENT_ROOT']; // готовим переменные для пути
                    $imageDirectory = '/smk/data/'; // готовим переменные для пути
                    $imagePath = $documentRoot . $imageDirectory; // готовим переменные для пути
                    $cardImage = CUploadedFile::getInstance($model,'newpassport'); // загружаем картинку-файл во временную папку
                    if(isset($cardImage)){ 
                        $model->passpath=$cardImage->name;
                    }
                    if($model->save()){
                        if(isset($cardImage)) $cardImage->saveAs($imagePath . $cardImage->name);
                        $this->redirect(array('view','id'=>$model->id));
                    }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionDelete($id)//удаление прибора
	{
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

        public function actionIndex()// список всех приборов
	{
            $model=new OimPribors('search');
            $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$model->dataProvider,
		));
            }

        public function actionAdmin()//управление данными по приборам
	{
            $model=new OimPribors('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['OimPribors']))
                    $model->attributes=$_GET['OimPribors'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
	}
        
	public function loadModel($id)//возвращает данные по конкретному прибору по ID
	{
		$model=OimPribors::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)//	 * Performs the AJAX validation.
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='oim-pribors-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
