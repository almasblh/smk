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

/*	public function accessRules(){
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
    
	public function actionView($defectid){
            $model = $this->loadModel($defectid);
            $this->ActiveProjectSessionSave($model->projectid);
            //Yii::app()->user->setState('activeproject',$model->projectid);
            $modelstatus = new DefectsBookState();
            $modelstatus->unsetAttributes();  // clear any default values
            if(isset($_GET['DefectsBookStatus'])) $modelstatus->attributes=$_GET['DefectsBookStatus'];
            $this->render('view',array(
                'model'=>$model,
                'modelstatus'=> $modelstatus,//->srcView($model->id),//   $this->loadModelStatus($model->id),
                'defectid'=>$defectid
            ));
	}
	public function actionCreate($projectid){
		$model=new DefectsBook;
		if(isset($_POST['DefectsBook'])){
                    $model->attributes=$_POST['DefectsBook'];
                    $model->projectid=$_GET['projectid'];
                    $model->createdate=date("Y-m-d H:i:s", time());
                    $model->autorid=Yii::app()->user->id;
                    $model->laststate=1;
                    if($model->save()){
                        $users[0]=$model->touserid;
                        $this->Send_Email(//отправить емайл кому направлен дефект
                            $users,                                             //кому
                            0,                                                  //кому копии
                            'Уведомление от СМК по дефекту №'.$model->id,      //тема письма
                            'new',                                              //шаблон письма
                            $model,                                             //данные
                            'defect',                                           //путь - определяет путь к шаблону
                            0                                                   //срок окончания. если <0 то просрочено
                        );
                        $this->redirect(array('index',
                                'id'=>$projectid,
                                //'model'=>$model,
                                //'project'=>SmkProjects::model()->findByPk($projectid)
                            )
                        );
                    }
		}
		$this->renderPartial('crup_form',array(
                    'model'=>$model,
                    'projectid'=>$projectid
		));
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
