
<?php

class DefectsBookController extends CAssaController
{
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

    public function actionCreate(){
        $model=new DefectsBook;
        if(isset($_POST['DefectsBook'])){
            $model->attributes=$_POST['DefectsBook'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionUpdate($id){
        $model=$this->loadModel($id);
        if(isset($_POST['DefectsBook'])){
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

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionView(){
        $this->renderPartial(
            '_view',
            array(
                'model'=>new DefectsBookStateDefect,
                'defectid'=>$_GET['defectid']
            )
        );
    }
    
    public function actionIndex(){
        if(Yii::app()->request->isAjaxRequest){// Если это AJAX - запрос, то обработаем

            Yii::app()->end();
        }
        else
        {   if(!Yii::app()->user->getState('activeproject')){
                //echo CJavaScript::quote(ShowMessage('Не выбран активный проект.'));
                $this->redirect(array('SmkProjects/select'));
            }   
            $model=new DefectsBook('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['DefectsBook'])) $model->attributes=$_GET['DefectsBook'];
            $this->render('index',
                        array(
                            'model'=>$model,
                        )
                    );
        }
    }

    public function loadModel($id)
    {
        $model=DefectsBook::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='defects-book-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionAddnewdefect()
    {
        if(isset($_POST['NewDefectForm']))
        {
            $model= new DefectsBook;//()->with('DefectsBookStateDefect');

            //$model->attributes=$_POST['NewDefectForm'];
            $model->mnemoid=$_POST['NewDefectForm']['mnemoid'];
            $model->nodeid=$_POST['NewDefectForm']['nodeid'];
            $model->describe=$_POST['NewDefectForm']['describe'];
            $model->tocategoryid=$_POST['NewDefectForm']['tocategoryid'];
            $model->touserid=$_POST['NewDefectForm']['touserid'];
            $model->projectid=Yii::app()->user->getState('activeproject');
            $model->autorid=Yii::app()->user->id;
            $model->curstate=0;
            $model->createdate=date("Y-m-d H:i:s", time());

            if($model->save())
            {
                $model1= new DefectsBookStateDefect;
                $model1->defectid=$model->id;
                $model1->state=$model->curstate;
                $model1->comment=$_POST['NewDefectForm']['comment'];
                $model1->date=$model->createdate;
                $model1->signatureuserid=$model->autorid;
                $model1->tocategoryid=$model->tocategoryid;
                $model1->touserid=$model->touserid;

                if($model1->save()){
//                    $this->redirect(CHtml::normalizeUrl(array('index')));
                    $this->renderPartial(
                        '_none_form',
                        array(
                            'model'=>new NewDefectForm,
                        )
                    );
                    Yii::app()->end();
                }
                else{
                    $this->redirect(CHtml::normalizeUrl(array('index')));
                    $this->renderPartial(
                        '_none_form',
                        array(
                            'model'=>new NewDefectForm,
                        )
                    );
                    Yii::app()->end();
                }
            }
            else{
                $this->redirect(CHtml::normalizeUrl(array('index')));
            }
        }
        else{
            $this->renderPartial(
                '_newdefect',
                array(
                    'model'=>new NewDefectForm,
                )
            );
        }
    }    
    
    
}
