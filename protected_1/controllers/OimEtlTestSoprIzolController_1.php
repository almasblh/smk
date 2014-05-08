<?php

class OimEtlTestSoprIzolController extends Controller
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
		$model=new OimEtlTestSoprIzol;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OimEtlTestSoprIzol']))
		{
			$model->attributes=$_POST['OimEtlTestSoprIzol'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OimEtlTestSoprIzol']))
		{
			$model->attributes=$_POST['OimEtlTestSoprIzol'];
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
		$dataProvider=new CActiveDataProvider('OimEtlTestSoprIzol');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
            $modeltest= ReestrOimEtlTests::model()->findByPk($_GET['testid']);
            $modelizm= new $modeltest->modelname;                             // модель - модель нужного измерения
            $modeltest=OimEtlTests::model()->findByPk($_GET['id']);
        //    $model=new OimEtlTestSoprIzol('search');
	//	$model->unsetAttributes();  // clear any default values
	//	if(isset($_GET['OimEtlTestSoprIzol']))
	//		$model->attributes=$_GET['OimEtlTestSoprIzol'];

		$this->render('admin',array(
                    'modelizm'=>$modelizm,
                        'modeltest'=>$modeltest,
		));
	}

	public function loadModel($id)
	{
		$model=OimEtlTestSoprIzol::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='oim-etl-test-sopr-izol-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
