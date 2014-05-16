<?php
class DefectsBookController extends CAssaController
{
	public $layout='//layouts/column2';

	public function filters(){
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
    
	public function actionView($defectid){
            $model = $this->loadModel($defectid);
            $this->ActiveProjectSessionSave($model->projectid);
            $modelstatus = new DefectsBookState();
            $modelstatus->unsetAttributes();
            if(isset($_GET['DefectsBookStatus']))
                $modelstatus->attributes=$_GET['DefectsBookStatus'];
            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_view',array(
                    'model'=>$model,
                    'modelstatus'=> $modelstatus,
                    'defectid'=>$defectid
                ),false,true);
            }
            else{
                $this->render('view',array(
                    'model'=>$model,
                    'modelstatus'=> $modelstatus,
                    'defectid'=>$defectid
                ));
            }
	}
	public function actionCreate($projectid){                               //вункция создания нового дефекта
            $model=new DefectsBook;
            if(isset($_POST['ajax']) && $_POST['ajax']=='defects-book-form'){   //валидация данных в форме
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['DefectsBook'])){                                   //если форма заполнена - анализируем полученные данные
                $model->attributes=$_POST['DefectsBook'];                       //запишем все атрибуты из формы в модель
                Yii::app()->user->setState('NewDefectToUser',$model->touserid); //записать адресата в сессию
                $model->projectid=$_GET['projectid'];
                $model->createdate=date("Y-m-d H:i:s", time());
                $model->autorid=Yii::app()->user->id;
                $model->laststate=1;                                            //последний статус дефекта - 1 т.е. открыто
                if($_POST['users_email_copy1']!=0) $users_email_copy[]=$_POST['users_email_copy1'];//сформируем массив - кому копии рассылать
                if($_POST['users_email_copy2']!=0) $users_email_copy[]=$_POST['users_email_copy2'];
                if($_POST['users_email_copy3']!=0) $users_email_copy[]=$_POST['users_email_copy3'];
                if($_POST['users_email_copy4']!=0) $users_email_copy[]=$_POST['users_email_copy4'];
                if($_POST['users_email_copy5']!=0) $users_email_copy[]=$_POST['users_email_copy5'];
                    $cardImage = \CUploadedFile::getInstance($model,'attachepath'); // загружаем картинку-файл во временную папку
                    if(isset($cardImage)){
                        $path=time().'-'.$cardImage->name;
                        $model->attachepath=$path;
                    }
                if($model->validate()){                                         // если модель прошла валидацию - сохраняем данные в базу
                    if($model->save()){                                         // пробуем - сохранять данные в базу
                        if(isset($cardImage)){                                  // если получилось - то
                                                                                // записываем наш файл в необходимую папку, это строчка обязательно должна быть в if`е,
                            $cardImage->saveAs('data/defects/files/'.$path);
                        }
                        $users[0]=$model->touserid;                             //создадим массив с пользователем кому направлен дефект
                        $this->Send_Email(                                      //отправляем емайл
                            $users,                                             //кому
                            isset($users_email_copy)?$users_email_copy:0,       //если есть копии - то кому копии
                            'Уведомление от СМК по дефекту №'.$model->id,      //тема письма
                            'new',                                              //шаблон письма
                            $model,                                             //данные
                            'defect',                                           //путь - определяет путь к шаблону
                            0,                                                  //срок окончания. если <0 то просрочено
                            Yii::app()->user->id                                // отправлено от зарегистрированного пользователя (требование подтверждения получения)
                        );
                        $this->redirect(array('index','id'=>$projectid,));      //редирект на индекс
                    }
                    else {
                        $this->redirect(array('index','id'=>$projectid,));      //если модельзаписать не удалось - то просто редирект на индекс (здесь надо бы вывести какое нибудь сообщение)
                    }
                }
                else{
                    $this->redirect(array('index','id'=>$projectid,));          // если валидация не прошла - то просто редирект на индекс
                }
            }
            $model->touserid=Yii::app()->user->getState('NewDefectToUser');     // выводим форму для заполнения - взять адресата из сессии
            $this->renderPartial('crup_form',array(
                'model'=>$model,
                'projectid'=>$projectid
            ), false, true);                                                    // для работы скриптов в ajax-е
	}
	public function actionUpdate($id){
            $model=$this->loadModel($id);
            if(isset($_POST['DefectsBook']))
            {
                $model->attributes=$_POST['DefectsBook'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('update',array(
                    'model'=>$model,
            ));
	}
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionIndex($id=0){
            if($id==0) $id=Yii::app()->user->getState('activeproject');
            if($id==0) $this->redirect(array('/SmkProjects/index'));
            
            $project=SmkProjects::model()->findByPk($id);
            $model=new DefectsBook();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['DefectsBook']))
                    $model->attributes=$_GET['DefectsBook'];
            $this->render('index',array(
                'model'=>$model,
                'project'=>$project
            ));
	}
	public function actionAdmin(){
            $model=new DefectsBook('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['DefectsBook']))
                $model->attributes=$_GET['DefectsBook'];
            $this->render('admin',array(
                'model'=>$model,
            ));
	}
	public function loadModel($id){
            $model=DefectsBook::model()->findByPk($id);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}
	protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='defects-book-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
	}
}
