<?php

class SmkProjectStepController extends CAssaController
{

	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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

	public function actionView($id=0){
            if($_GET['id']){
                $model = SmkProjectStep::model()->with(array('SmkProjectStepName','SmkProjects','ServUsersStepCurator'))->findByPk($id);
                $modelJurnal = SmkProjectStepcuratorJurnal::model()->search(SmkProjectStepcuratorJurnal::model()
                    ->with('ServUsers')
                    ->findAll(
                        array(
                            'condition'=>'projectstepid=:par',
                            'params'=>array(':par'=>$id),
                            'order'=>'daterecord DESC'
                        )
                    )
                );
                Yii::app()->user->setState('activeprojectstep',$model->stepid);
                Yii::app()->user->setState('activeprojectstepname',$model->SmkProjectStepName['name']);
                $this->render('view',array(
                    'model'=>$model,
                    'modelJurnal'=>$modelJurnal
                ));
            }
	}

	public function actionCreate($projectid)
	{
	
                if(!isset($projectid))
                    $projectid=Yii::app()->user->getState('activeproject');
                else 
                    $this->ActiveProjectSessionSave($projectid);

                $model=new SmkProjectStep;

		if(isset($_POST['SmkProjectStep']))
		{
                    $model->attributes=$_POST['SmkProjectStep'];
                    $model->projectid=$projectid;
                    $model->signaturecreator=$a=Yii::app()->user->id;
                    $model->datecreaterecord=date("Y-m-d H:i:s", time());
                    $model->ncorrect+=1;
                    $model->signaturecurator=0;
                    $a=SmkProjectStep::model()->
                    //$model->agreed=0;
                    $model->nexttimemail=$model->datecreaterecord;              //время следующей почтовой раасылки - сейчас
                    if($model->save()){                                         //запись в таблицу этапров проекта
                        //запись роли ответственного исполнителя в таблицу его ролей
                        $modelcurator=ServUsersRole::model()                    //пытаемся получить существующие роли пользователя по этому проекту и этому этапу
                            ->find(array('condition'=>
                                            't.projectid='.$projectid.
                                            ' AND t.projectstepid='.$model->stepid.
                                            ' AND t.userid='.$model->curatorid
                                    )
                                );
                        if(!isset($modelcurator)){                              //если запись не найдена - то
                            $modelcurator=new ServUsersRole;                    //создадим новую
                            $modelcurator->userid=$model->curatorid;            //
                            $modelcurator->projectid=$projectid;
                            $modelcurator->projectstepid=$model->stepid;
                            $modelcurator->category=2048;
                        }
                        else{                                                   //если запись найдена - то
                            $modelcurator->category!=2048;                      //добавим права куратора этапа
                        }
                        $modelcurator->signaturecreator=$model->signaturecreator;
                        $modelcurator->datecreaterecord=$model->datecreaterecord;
                        $modelcurator->save();                                  //запись в таблицу ролей
                    }
                    $this->redirect(array('SmkProjects/view','id'=>$model->projectid));
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id=0)
	{
            if(Yii::app()->request->isAjaxRequest){
                if(isset($_GET['par'])){                                        // обработка сортировки этапов
                    //$query='call smkChangeRow('.$_GET['projectid'].','.$_GET['ordern'].','.$_GET['par'].');';//поменять местами этапы в направлении par
                    Yii::app()->db->createCommand(
                        'call smkChangeRow('.$_GET['projectid'].','.$_GET['ordern'].','.$_GET['par'].');'//поменять местами этапы в направлении par
                    )->query();
                    $model = SmkProjects::model()->findByPk($_GET['projectid']);
                    $this->renderPartial('index', array('model'=>$model));
                }
                else{
                    $model = $this->loadModel($id);
                    $this->renderPartial('_form_dates', array('model'=>$model));
                }
            }
            else{
                $model = $this->loadModel($id);
                if (isset($_POST['SmkProjectStep'])){
                    $model->attributes=$_POST['SmkProjectStep'];
                    $model->datecreaterecord=date("Y-m-d H:i:s", time());
                    $model->ncorrect+=1;
                    $model->signaturecurator=0;
                    //$model->agreed=0;
                    $model->nexttimemail=$model->datecreaterecord;              //время следующей почтовой раасылки - сейчас
                    if($model->save()){
                        SmkProjects::model()->updateByPk(
                            $model->projectid,
                            array('signaturemanagerid'=>0,
                                'signatureshefOUPid'=>0,
                                'datesignaturetechdirector'=>0,
                                'approved'=>0
                            )
                        );
                    }
                }
                elseif (isset($_GET['sign'])){
                    $model->signaturecurator=Yii::app()->user->id;
                    $model->save();
                }
                $this->redirect(array('SmkProjects/view','id'=>$model->projectid));
            }
        }

	public function actionDelete($id,$projectid)
	{
		$this->loadModel($id)->delete();
                $model = SmkProjects::model()->findByPk($projectid);
                $this->renderPartial('index', array('model'=>$model));
                //$this->redirect(CHtml::normalizeUrl(array('SmkProjects/view','id'=>$projectid)));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SmkProjectStep');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new SmkProjectStep('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SmkProjectStep']))
			$model->attributes=$_GET['SmkProjectStep'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id){
            $model=SmkProjectStep::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smk-project-step-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
