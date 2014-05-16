<?php

class DefectsBookStateController extends CAssaController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/*	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
 * 
 */
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
	public function actionCreate($defectid){
            $model=new DefectsBookState;
            if(isset($_POST['DefectsBookState'])){
                $model->attributes=$_POST['DefectsBookState'];
                $model->state=$_GET['par'];
                $model->defectid=$defectid;
                $model->projectid=DefectsBook::model()->findByPk($defectid)->projectid;
                $model->date=date("Y-m-d H:i:s", time());
                $model->signaturecreatorid=Yii::app()->user->id;
                $cardImage = \CUploadedFile::getInstance($model,'attachepathstate'); // загружаем картинку-файл во временную папку
                if(isset($cardImage)){
                    $path=time().'-'.$cardImage->name;
                    $model->attachepathstate=$path;
                }
                if($model->save()){
                    if(isset($cardImage)){                                  // записываем наш файл в необходимую папку, это строчка обязательно должна быть в if`е,
                        $cardImage->saveAs('data/defects/files/'.$path);
                    }
                    DefectsBook::model()->updateByPk($defectid,array(           //обновить поля самого дефекта
                        'laststate'=>$model->state,
                        'touserid'=>($_GET['par']==0)?0:$model->touserid,
                        'priority'=>$_POST['DefectsBook']['priority']
                    ));
                    if($model->state<>0){
                        $users[0]=$model->touserid;
                        $this->Send_Email(//отправить емайл кому направлен дефект
                            $users,                                             //кому
                            0,                                                  //кому копии
                            'Уведомление от СМК по дефекту №'.$model->defectid,      //тема письма
                            'comment',                                              //шаблон письма
                            $model,                                             //данные
                            'defect',                                           //путь - определяет путь к шаблону
                            0,                                                  //срок окончания. если <0 то просрочено
                            Yii::app()->user->id                                // отправлено от зарегистрированного пользователя (требование подтверждения получения)
                        );
                    };
                    $modeldefect=DefectsBook::model()->findByPk($defectid);
                    $project=SmkProjects::model()->findByPk($modeldefect->projectid);
                    $this->redirect(array('DefectsBook/index',
                        'defectid'=>$defectid
                    ));
                }
            }
            $this->renderPartial('crup_form',array(
                'model'=>$model,
                'defectmodel'=>DefectsBook::model()->findByPk($defectid),
            ));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['DefectsBookState']))
		{
			$model->attributes=$_POST['DefectsBookState'];
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

	public function actionIndex($defectid)
	{
                $model=new DefectsBookState('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DefectsBookState']))
			$model->attributes=$_GET['DefectsBookState'];

		$this->render('index',array(
			'model'=>$model,
                    'defectid'=>$defectid
		));
	}

	public function actionAdmin()
	{
		$model=new DefectsBookState('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DefectsBookState']))
			$model->attributes=$_GET['DefectsBookState'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=DefectsBookState::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='defects-book-state-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
