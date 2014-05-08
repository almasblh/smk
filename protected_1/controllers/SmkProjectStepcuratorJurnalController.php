<?php

class SmkProjectStepcuratorJurnalController extends CAssaController
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

    public function accessRules(){
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


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['SmkProjectStepcuratorJurnal']))
		{
			$model->attributes=$_POST['SmkProjectStepcuratorJurnal'];
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
                $this->renderpartial(
                    'index',
                    array(
                        'model'=>SmkProjectStepcuratorJurnal::model()->search(SmkProjectStepcuratorJurnal::model()
                                ->with('ServUsers')
                                ->findAll(
                                    array(
                                        'condition'=>'projectstepid=:par',
                                        'params'=>array(':par'=>$_GET['projectstepid']),
                                        'order'=>'daterecord DESC'
                                    )
                                )
                        )
                    ),
                    false,
                    true
                );
	}

	public function actionCreate()
	{
                $model=new SmkProjectStepcuratorJurnal;
                $modelSmkProjectStep=0;
		if(isset($_POST['SmkProjectStepcuratorJurnal']))
		{
			$model->attributes=$_POST['SmkProjectStepcuratorJurnal'];
                        $model->daterecord=date("Y-m-d H:i:s", time());
                        $model->signaturestepcurator=Yii::app()->user->id;
                        $model->projectstepid=$_GET['id'];//projectstep
			if($model->save()){
                            $modelStep=SmkProjectStep::model()->find('id='.$model->projectstepid);
                            if(!isset($modelStep->datestopfact)){//если этап не завершен - то
                                $modelStep->current_persent=$model->current_percent;//завершено в процентах берем из формы
                                if(!isset($modelStep->datestartfact)) $modelStep->datestartfact=date("Y-m-d H:i:s", time());
                                if($model->current_percent==100) $modelStep->datestopfact=date("Y-m-d H:i:s", time());//если 100 процентов, то ставим завершение этапа
                                $modelStep->save();
                            }
                            //$this->redirect(array('SmkProjectStep/view','id'=>$model->projectstepid));
                        }
                        $this->redirect(array('SmkProjectStep/view','id'=>$model->projectstepid));
                        Yii::app()->end();
		}
                else{
                    $modelSmkProjectStep = SmkProjectStep::model()->findByPk($_GET['id']);
                    $last_percent = SmkProjectStepcuratorJurnal::model()->find(
                            array('condition'=>'projectstepid='.$_GET['id'],
                                'order'=>'daterecord DESC'
                            ));
                    if(isset($last_percent)){
                        $model->current_percent=abs($last_percent->current_percent);
                    }
                }
		$this->renderpartial('create',array(
			'model'=>$model,
                        'modelSmkProjectStep'=>$modelSmkProjectStep,
		));
	}
        
        public function actionAdmin()
	{
		$model=new SmkProjectStepcuratorJurnal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SmkProjectStepcuratorJurnal']))
			$model->attributes=$_GET['SmkProjectStepcuratorJurnal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=SmkProjectStepcuratorJurnal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smk-project-stepcurator-jurnal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
