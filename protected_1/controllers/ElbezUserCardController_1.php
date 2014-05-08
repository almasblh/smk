<?php

class ElbezUserCardController extends CAssaController
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

	public function actionView($id){
            //if($id==0){
            //    $this->actionCreate($userid,1);
            //}
                $this->render('view',array(
                        'model'=>$this->loadModel($id),
                ));
	}

	public function actionCreate($userid,$Partial=0){
            $model=new ElbezUserCard;
            if(isset($_POST['ElbezUserCard'])){                                 // если форма заполнена - обработаем
                $model->attributes=$_POST['ElbezUserCard'];                     //заполним модель атрибутами из фомы
                $model->userid=$userid;
                if(isset($_GET['memb3']) && $_GET['memb3']==true) $model->signatureusertest4=$_POST['signatureusertest4'];
                if(isset($_GET['memb4']) && $_GET['memb4']==true) $model->signatureusertest4=$_POST['signatureusertest4'];
                $locate_commision_PDK=Yii::app()->cache->get('locate_commision_PDK');//заберем закешированный массив значений по комиссии ПДК
                if($locate_commision_PDK['commision']==false){                  // если комисси не обнаружено
                    Yii::app()->db->createCommand(                              // то сформируем ее из атрибутов и добавляем в базу
                        'INSERT INTO elbez_commision (locate, user1id, user2id, user3id) VALUES ('.
                            $locate_commision_PDK['locate'].','.
                            $model->signatureusertest1.','.
                            $model->signatureusertest2.','.
                            $model->signatureusertest3.
                            ');'
                    )->query();
                }
                if($model->save()){                                             //проверим валидность введенных данных и в случае удачи - сохраним карточку в базу
                    ServUsers::model()->updateByPk($userid,array('elbezid'=>$model->id));//сохраним также ссылку на карточку для пользователя
                    Yii::app()->cache->delete('locate_commision_PDK');          //удалим кеш комиссии
                    Yii::app()->cache->delete(
                    "Yii.COutputCache.serv_users_listru..servUsers/index...."
                    );
                    $this->redirect(array('ServUsers/index'));                  //редирект на список пользователей
                }
                else{                                                           //если введенные данные не валидны - повторим ввод данных
                    //echo "<script type='text/javascript'>alert('Error create ElbezUserCard')</script>";
                    $this->render('cr_up_form',array(
                        'model'=>$model,
                        'userid'=>$userid,
                        'locate_commision_PDK'=>$locate_commision_PDK
                    ));
                }
            }
            else{                                                               // если форма не заполнена - т.е. только что выведена
                $locate=Yii::app()->db->createCommand(                          // сформируем закешированный массив значений по комиссии ПДК
                    'SELECT su.officelocate as `0` FROM serv_users su WHERE id='.$userid.';'
                )->queryRow()[0];
                $commision=Yii::app()->db->createCommand(
                    'SELECT locate,user1id AS head,user2id AS mb1,user3id AS mb2,user4id AS mb3,user5id AS mb4 FROM elbez_commision WHERE locate='.$locate.';'
                )->queryRow();
                $locate_commision_PDK['locate']=$locate;
                $locate_commision_PDK['commision']=$commision;
                Yii::app()->cache->set('locate_commision_PDK',$locate_commision_PDK);
                if($Partial=0){
                    $this->renderPartial('cr_up_form',array(                        //вывод формы для ввода карточки пользователя по электробезопасности
                            'model'=>$model,
                            'userid'=>$userid,
                            'locate_commision_PDK'=>$locate_commision_PDK
                        ));
                    }
                else{
                    $this->render('cr_up_form',array(                        //вывод формы для ввода карточки пользователя по электробезопасности
                            'model'=>$model,
                            'userid'=>$userid,
                            'locate_commision_PDK'=>$locate_commision_PDK
                        ));
                    }
            }
	}

	public function actionUpdate($id){
            $model=$this->loadModel($id);
            if(isset($_GET['addattache'])){//если хотим добавить скан протокола
                $this->renderPartial('attache_form',array(                      //вывод формы для сохранения скана
                    'model'=>$model
                ));
                Yii::app()->end();
            }
            if(isset($_POST['ElbezUserCard'])){                                 // если форма заполнена - обработаем
                $model->attributes=$_POST['ElbezUserCard'];                     //заполним модель атрибутами из фомы
                if(isset($_GET['memb3']) && $_GET['memb3']==true) $model->signatureusertest4=$_POST['signatureusertest4'];
                if(isset($_GET['memb4']) && $_GET['memb4']==true) $model->signatureusertest4=$_POST['signatureusertest4'];
                $locate_commision_PDK=Yii::app()->cache->get('locate_commision_PDK');//заберем закешированный массив значений по комиссии ПДК
                if($locate_commision_PDK['commision']==false){                  // если комисси не обнаружено
                    Yii::app()->db->createCommand(                              // то сформируем ее из атрибутов и добавляем в базу
                        'INSERT INTO elbez_commision (locate, user1id, user2id, user3id) VALUES ('.
                            $locate_commision_PDK['locate'].','.
                            $model->signatureusertest1.','.
                            $model->signatureusertest2.','.
                            $model->signatureusertest3.
                            ');'
                    )->query();
                }
                if($model->save()){                                             //проверим валидность введенных данных и в случае удачи - сохраним карточку в базу
                    Yii::app()->cache->delete('locate_commision_PDK');          //удалим кеш комиссии
                    $this->redirect(array('view','id'=>$model->id));                  //редирект на карточку пользователя
                }
                else{                                                           //если введенные данные не валидны - повторим ввод данных
                    //echo "<script type='text/javascript'>alert('Error create ElbezUserCard')</script>";
                    $this->render('cr_up_form',array(
                        'model'=>$model,
                        'userid'=>$model->userid,
                        'locate_commision_PDK'=>$locate_commision_PDK
                    ));
                }
            }
            else{                                                               // если форма не заполнена - т.е. только что выведена
                $locate=Yii::app()->db->createCommand(                          // сформируем закешированный массив значений по комиссии ПДК
                    'SELECT su.officelocate as `0` FROM serv_users su WHERE id='.$model->userid.';'
                )->queryRow()[0];
                $commision=Yii::app()->db->createCommand(
                    'SELECT locate,user1id AS head,user2id AS mb1,user3id AS mb2,user4id AS mb3,user5id AS mb4 FROM elbez_commision WHERE locate='.$locate.';'
                )->queryRow();
                $locate_commision_PDK['locate']=$locate;
                $locate_commision_PDK['commision']=$commision;
                Yii::app()->cache->set('locate_commision_PDK',$locate_commision_PDK);
                $this->renderPartial('cr_up_form',array(                        //вывод формы для ввода карточки пользователя по электробезопасности
                    'model'=>$model,
                    'userid'=>$model->userid,
                    'locate_commision_PDK'=>$locate_commision_PDK
                ));
            }
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
            $model=new ElbezUserCard();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ElbezUserCard']))
                    $model->attributes=$_GET['ElbezUserCard'];
            $this->render('index',array(
                'model'=>$model,
            ));
	}

	public function actionAdmin()
	{
		$model=new ElbezUserCard('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ElbezUserCard']))
			$model->attributes=$_GET['ElbezUserCard'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=ElbezUserCard::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='elbez-user-card-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
