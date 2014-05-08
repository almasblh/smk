<?php

class SmkProjectUnitsController extends CAssaController
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
                $model=$this->loadModel($id);
                $this->render('view',array(
                    'model'=>$model
		));
	}

	public function actionCreate(){
            $model=new SmkProjectUnits;
                if(isset($_POST['SmkProjectUnits'])){
                        $model->attributes=$_POST['SmkProjectUnits'];
                        if($model->save()){
                            $this-> ActiveProjectSessionSave($model->projectid);
                            $this->redirect(array('admin'));
                        }
                }
                $this->renderPartial('_form',array(
                        'model'=>$model,
                        'header'=>'Новый шкаф'
                ));
	}

	public function actionUpdate($id){
            $model=$this->loadModel($id);
            if(isset($_POST['SmkProjectUnits'])){
                $model->attributes=$_POST['SmkProjectUnits'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('_form',array(
                    'model'=>$model,
                    'header'=>'Редактирование данных по шкафу'
            ));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex($projectid=0){
/*		$dataProvider=new CActiveDataProvider('SmkProjectUnits');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
 * 
 */
            $model=new SmkProjectUnits('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['SmkProjectUnits']))
                $model->attributes=$_GET['SmkProjectUnits'];
            $this->render('index',array(
                'model'=>$model,
                'projectid'=>$projectid
            ));
	}

	public function actionAdmin()
	{
            if(Yii::app()->request->isAjaxRequest){                             // Если это AJAX - запрос, то обработаем
                if($_POST['chv']==1){                                         //chv - chanel_view - признак запроса на показ каналов
                    $model = new KdCollection();
                    //$mod=$model->srchProbiv($_POST['id']);
                    $this->renderPartial(
                        '_chanelview'
                        ,array(
                            'model'=>$model
                            ,false
                            ,true
                        )
                    );
                    yii::app()->end();
                }
            }
            $model=new SmkProjectUnits('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SmkProjectUnits']))
			$model->attributes=$_GET['SmkProjectUnits'];

		$this->render('admin',array(
			'model'=>$model,
		));

	}

	public function loadModel($id)
	{
		$model=SmkProjectUnits::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smk-project-units-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
