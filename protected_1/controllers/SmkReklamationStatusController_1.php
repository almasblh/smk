<?php

class SmkReklamationStatusController extends CAssaController
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new SmkReklamationStatus;

		if(isset($_POST['SmkReklamationStatus']))
		{
			$model->attributes=$_POST['SmkReklamationStatus'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionUpdate($id){
        if(Yii::app()->request->isAjaxRequest){// Если это AJAX - запрос, то обработаем
            switch($_GET['par']){
                case 'changedatestop':
                    $modelstatus=$this->loadModel($id);
                    if(isset($_POST['SmkReklamationStatus'])){
                            $modelstatus->attributes=$_POST['SmkReklamationStatus'];
                                if($modelstatus->save())
                                    $this->redirect(array('view','id'=>$model->id));
                    }
                    $this->renderpartial('_updatedatestop',array(
                        'modelstatus'=>$modelstatus,
                    ));
                break;
                case 'comment':
                    $model=$this->loadModel($id);
                    if(isset($_POST['SmkReklamationStatus'])){
                        $model->attributes=$_POST['SmkReklamation'];
                        if($model->save())
                            $modelstatus->attributes=$_POST['SmkReklamationStatus'];
                                if($modelstatus->save())
                                    $this->redirect(array('view','id'=>$model->id));
                    }
                    $this->renderpartial('_updatecomment',array(
                        'model'=>$model,
                    ));
                break;
                case 'changestatus':
                    $model= $this->loadModel($id);
                        if(isset($_POST['SmkReklamationStatus'])){
                        $model->attributes=$_POST['SmkReklamationStatus'];
                        if($model->save())
                            $model->attributes=$_POST['SmkReklamationStatus'];
                                if($model->save())
                                    $this->redirect(array('view','id'=>$model->id));
                    }
                    $this->renderpartial('_updatestatus',array(
                        'modelstatus'=>$model,
                    ));
                break;
            }
        }
        else{
            if(isset($_POST['SmkReklamationStatus'])){
                $model = SmkReklamation::model()->findByPk($this->loadModel($id)->reklamationid);
                $modelstatus= SmkReklamationStatus::model()->findByPk($id); //то вытаскиваем данные из модели статуса
                switch($_GET['par']){
                    case 'changedatestop':
                        $modelstatus->datestop=$_POST['SmkReklamationStatus']['datestop'];
                        $modelstatus->save();
                    break;
                    case 'comment':                                                 //если активен режим добавления коментария в статус
                        $modelstatus->aktpath=$_FILES['SmkReklamationStatus']['name']['aktpath'];
                        $modelstatus->datestop=date("Y-m-d H:i:s",mktime(0, 0, 0, date("m") , date("d")+3, date("Y")));//3 деня даю на чтение коментария
                        $modelstatus->steppersent=$_POST['SmkReklamationStatus']['steppersent'];
                        $creator=ServUsers::model()->findByPk(Yii::app()->user->id)->FIO2;
                        $modelstatus->comment.=date("Ymd H:i", time()).'('.$modelstatus->steppersent.'%) '.$creator.'->'.$_POST['SmkReklamationStatus']['NewComent'].'<br />';
                        $cardImage = \CUploadedFile::getInstance($modelstatus,'aktpath'); // загружаем картинку-файл во временную папку
                        if(isset($cardImage)){                                      // записываем наш файл в необходимую папку, это строчка обязательно должна быть в if`е,
                            //добавление в таблицу smk_reklamation_attaches новой записи
                            $path=time().'-'.$cardImage->name;
                            $mod= new SmkReklamationAttaches;
                            $mod->path=$path;
                            $mod->reklamationstatusid=$modelstatus->id;
                            $mod->save();
                            $cardImage->saveAs('data/reklamation/'.$path);
                            $modelstatus->attache=true;
                        }
                    break;
                    case 'changestatus':                                        //если активен режим изменения статуса
                        $modelstatus->datestop=date("Y-m-d H:i:s", time());     //записываем дату окончания статуса
                        $modelstatus->steppersent=100;                          //назначить процент выполнения этапа - 100%
                        $modelstatus->save();
                        $modelstatus= new SmkReklamationStatus();               //и создаем новую запись в таблице статусов
                        $modelstatus->attributes=$_POST['SmkReklamationStatus'];
                        $modelstatus->signaturecreator=Yii::app()->user->id;
                        $modelstatus->datecreaterecord=date("Y-m-d H:i:s", time());
                        $modelstatus->reklamationid=$model->id;
                    break;
                }            
                    $modelstatus->mailcount=0;                                  //активизация счетчика рассылок
                    $modelstatus->nexttimemail=date("Y-m-d H:i:s", time());     //время следующей почтовой раасылки - сейчас
                    if($modelstatus->statusid==-1){                             // если новый статус - "рекламация отработана", то 
                        $modelstatus->steppersent=100;                          // процент выполнения этапа - принудительно = 100%
                        $model->state=false;                                    // и сбросить состояние самой рекламации (данную процедуру выполняет триггер в базе, только чего-то не работает)
                    }
                    if($modelstatus->save()){
                        $model->laststatusid=$modelstatus->id;
                        $model->aktpath='nd.pdf';
                        if($model->save()){
                            $b=Yii::app()->cache->get('reclamations_cach_table');
                            $a=Yii::app()->cache->delete($b);               //стереть кеш с таблицей по рекламациям
                            //$this->render(array('SmkReklamation/view','id'=>$model->id));
                            $this->redirect(array('SmkReklamation/view','id'=>$model->id));
                        }
                        else{
                            $a=$model->getErrors();
                        }
                    }
            }
            $this->render('update',array(
                    'model'=>$model,
            ));
        }
    }

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SmkReklamationStatus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new SmkReklamationStatus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SmkReklamationStatus']))
			$model->attributes=$_GET['SmkReklamationStatus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=SmkReklamationStatus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smk-reklamation-status-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
