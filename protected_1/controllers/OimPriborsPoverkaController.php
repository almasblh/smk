<?php

class OimPriborsPoverkaController extends CAssaController
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

        public function actionIndex(){
            $model=new OimPriborsPoverka();
            $model->GetAllTables();
            if(isset($_POST['OimPriborsPoverka'])){
                $model->attributes=$_POST['OimPriborsPoverka'];
                $cardImage = CUploadedFile::getInstance($model,'svidpath'); // загружаем картинку-файл во временную папку
                if(isset($cardImage))   $model->svidpath=$cardImage->name;                
                if($model->SaveAll()){//валидация и сохранение формы
                    if(isset($cardImage)) $cardImage->saveAs($_SERVER['DOCUMENT_ROOT'] . '/smk/data/' . $cardImage->name); // записываем нашу картинку в необходимую папку, это строчка обязательно должна быть в if`е, потому что все что в if`е проходит валидацию. То есть если файл не прошел валидацию он не запишется
                    $this->redirect(array('OimPribors/index','id'=>$model->id));
                }
            }
            $this->render('index',array(
                'model'=>$model,
            ));
	}            
}
