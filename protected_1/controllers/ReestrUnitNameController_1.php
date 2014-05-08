<?php

class ReestrUnitNameController extends CAssaController
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

    public function actionView($id){
            $this->render('view',array(
                    'model'=>$this->loadModel($id),
            ));
    }

    public function actionCreate(){
            $model=new ReestrUnitName;

            if(isset($_POST['ReestrUnitName']))
            {
                    $model->attributes=$_POST['ReestrUnitName'];
                    if($model->save())
                            $this->redirect(array('Admin','id'=>$model->id));
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
    }

    public function actionUpdate($id){
            $model=$this->loadModel($id);

            if(isset($_POST['ReestrUnitName']))
            {
                    $model->attributes=$_POST['ReestrUnitName'];
                    if($model->save())
                            $this->redirect(array('admin','id'=>$model->id));
            }

            $this->render('update',array(
                    'model'=>$model,
            ));
    }

    public function actionDelete($id){
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex(){
            $dataProvider=new CActiveDataProvider('ReestrUnitName');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    public function actionAdmin(){
            $model=new ReestrUnitName('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ReestrUnitName']))
                    $model->attributes=$_GET['ReestrUnitName'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    public function loadModel($id){
            $model=ReestrUnitName::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='reestr-unit-name-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
