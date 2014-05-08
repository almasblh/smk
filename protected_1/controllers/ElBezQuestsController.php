<?php

class ElBezQuestsController extends CAssaController
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

    public function actionView($b)
    {
        $allticket=0;
        $allresult=0;
        $result[]=0;
        $usrans[]=0;
        $grup=20;
        if(!isset($_POST['yt0'])){                                               //если это первое обращение, то сосчитаем кол-во правильных ответов
            $maxticket=Yii::app()->db->createCommand(
                'select MAX(ebq.nquest) a from el_bez_quests ebq WHERE ebq.grup='.$grup.';'
                )->queryAll()[0]['a'];                                              //нашли максимальное кол-во вопросов в билетах на определенную группу
            for($i=0;$i<$maxticket;$i++){                                           //цикл по формированию вопросов
                $quest[$i]=Yii::app()->db->createCommand(
                    'SELECT * FROM el_bez_quests ebq WHERE nquest='.($i+1).' AND ebq.grup='.$grup.' ORDER BY RAND() LIMIT 1;'
                    )->queryAll()[0];                                               //определили случайный вопрос из билета
                $ans[$i]=Yii::app()->db->createCommand(
                    'SELECT * FROM el_bez_ans eba WHERE eba.questid='.$quest[$i]['id'].';'
                    )->queryAll();                                                  //определили список ответов для него
            }
            if($quest[0]['right']==0){//если в базе в таблице quest не расписан номер правильного ответа, то вычислим его из таблицы ответов (временно, будет время - добавить правильные ответы для 2-й группы)
                foreach($ans as $a=>$an){                                               //в массив $quest вставляем номера правильных ответов
                    foreach($an as $answ){
                        if($answ['right'])
                            $quest[$a]['right']=$answ['nans']-1;
                    }
                }
            }
            Yii::app()->cache->set('ElBezQoestions-quest', $quest);
            Yii::app()->cache->set('ElBezQoestions-ans', $ans);
        }
        else{
            $quest=Yii::app()->cache->get('ElBezQoestions-quest');
            $ans=Yii::app()->cache->get('ElBezQoestions-ans');
            Yii::app()->cache->delete('ElBezQoestions-quest');
            Yii::app()->cache->delete('ElBezQoestions-ans');
            foreach($ans as $row=>$val){
                if(isset($_POST[$row+1]) && $_POST[$row+1]==($quest[$row]['right']-1)){
                    $result[$row]=1;
                    $allresult++;
                }
                else $result[$row]=0;
                $usrans[$row]=isset($_POST[$row+1])?$_POST[$row+1]:-1;
                $allticket++;
            }
        }
        $this->render('view',array(
            'nticket'=>$b,
            'quest'=>$quest,
            'ans'=>$ans,
            'allticket'=>$allticket,
            'allresult'=>$allresult,
            'result'=>$result,
            'usrans'=>$usrans
        ));
    }
	public function actionCreate()
	{
		$model=new ElBezQuests;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElBezQuests']))
		{
			$model->attributes=$_POST['ElBezQuests'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElBezQuests']))
		{
			$model->attributes=$_POST['ElBezQuests'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
    public function actionIndex($id=0)
    {
        $allticket=0;
        $allresult=0;
        $result[]=0;
        $usrans[]=0;
        $usercard=ElbezUserCard::model()->findByPk($id);
        
        if(!isset($_POST['yt0'])){                                               //если это первое обращение, то сосчитаем кол-во правильных ответов
            $maxticket=Yii::app()->db->createCommand(
                'select MAX(ebq.nquest) a from el_bez_quests ebq WHERE ebq.grup<='.$usercard['grup'].';'
                )->queryAll()[0]['a'];                                              //нашли максимальное кол-во вопросов в билетах на определенную группу
            for($i=0;$i<$maxticket;$i++){                                           //цикл по формированию вопросов
                $quest[$i]=Yii::app()->db->createCommand(
                    'SELECT * FROM el_bez_quests ebq WHERE nquest='.($i+1).' AND ebq.grup<='.$usercard['grup'].' ORDER BY RAND() LIMIT 1;'
                    )->queryAll()[0];                                               //определили случайный вопрос из билета
                $ans[$i]=Yii::app()->db->createCommand(
                    'SELECT * FROM el_bez_ans eba WHERE eba.questid='.$quest[$i]['id'].';'
                    )->queryAll();                                                  //определили список ответов для него
            }
/*            if($quest[0]['right']==0){//если в базе в таблице quest не расписан номер правильного ответа, то вычислим его из таблицы ответов (временно, будет время - добавить правильные ответы для 2-й группы)
                foreach($ans as $a=>$an){                                               //в массив $quest вставляем номера правильных ответов
                    foreach($an as $answ){
                        if($answ['right'])
                            $quest[$a]['right']=$answ['nans'];
                    }
                }
            }
 * 
 */
            Yii::app()->cache->set('ElBezQoestions-quest', $quest);
            Yii::app()->cache->set('ElBezQoestions-ans', $ans);
        }
        else{
            $quest=Yii::app()->cache->get('ElBezQoestions-quest');
            $ans=Yii::app()->cache->get('ElBezQoestions-ans');
            Yii::app()->cache->delete('ElBezQoestions-quest');
            Yii::app()->cache->delete('ElBezQoestions-ans');
            foreach($ans as $row=>$val){
                if(isset($_POST[$row+1]) && $_POST[$row+1]==($quest[$row]['right']-1)){
                    $result[$row]=1;
                    $allresult++;
                }
                else $result[$row]=0;
                $usrans[$row]=isset($_POST[$row+1])?$_POST[$row+1]:-1;
                $allticket++;
            }
        }
        $this->render('view',array(
            //'nticket'=>$b,
            'quest'=>$quest,
            'ans'=>$ans,
            'allticket'=>$allticket,
            'allresult'=>$allresult,
            'result'=>$result,
            'usrans'=>$usrans,
            'usercard'=>$usercard
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ElBezQuests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ElBezQuests']))
			$model->attributes=$_GET['ElBezQuests'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElBezQuests the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ElBezQuests::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ElBezQuests $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='el-bez-quests-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
