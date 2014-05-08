<?php

class AdministrationController extends CAssaController
{
    public $layout='//layouts/column2';

    public function filters(){// описание фильтров
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
    public function accessRules(){// правила доступа к ресурсам контроллера
        return array(
            array('allow', // список разрешений для конкретных пользователей
                'actions'=>array('index','CatUpdate'),
                'users'=>array(217),
            ),
            array('deny',  // список запрещений для всех пользователей
                'users'=>array('*','@'),
            ),
        );
    }
    
    public function actionIndex(){
        
        // создаем массив, который будем кормить CDropdownList и CListBox
        $data = CHtml::listData(Categories::model()->findAll(array('order'=>'lft')), 'id', 'nameExt'); // Здесь переопределяем поле name на nameExt. Ниже описано зачем.
        $datServControllers=CHtml::listData(ServControllers::model()->findAll(), 'id', 'nameExt');
        $datServControllersAction=CHtml::listData(ServControllersAction::model()->findAll(), 'id', 'nameExt');
        $datcategory = CHtml::listData(ServUsersCategory::model()->findAll(), 'id', 'name');
        $datuser = CHtml::listData(ServUsers::model()->findAll(), 'id', 'FIO');

        $this->render('catupdate',array(
            'CaptionMenu'=>'(Введите название меню)',
            'data'=>$data,
            'datServControllers'=>$datServControllers,
            'datServControllersAction'=>$datServControllersAction,
            'datuser'=>$datuser,
            'datcategory'=>$datcategory,
        ));
    }

    private function MakeListCategory($menuid){
        //$i=0;
        $datcategory = array();
        foreach(Categories::model()->findByPk($menuid)->ServUsersCategory as $row){
            $datcategory[$row->id]=$row->name;
        }
        return $datcategory;
    }

    private function MakeListUsers($menuid){
        //$i=0;
        $datuser = array();
        foreach(Categories::model()->findByPk($menuid)->ServUsers as $row){
            $datuser[$row->id]=$row->FIO;
        }
        return $datuser;
    }
    
    public function actionCatUpdate(){

        if(isset($_POST['tree']) && $_POST['tree'] == 'manage') {
            $menuid = Yii::app()->request->getPost('menuid');
            $node = Categories::model()->findByPK($menuid);
            $nodeTo = Categories::model()->findByPK($_POST['nodeto']);
            $upwin=1;
            if(Yii::app()->request->isAjaxRequest){// Если это AJAX - запрос, то обработаем
                switch ($_GET['action']){// Каждой кнопке присвоен свой action
                    case 1:{//нажато кнопка "Обработать"
                    };break;
                    case 'addcattomenu':{// Добавить категорию в меню
                        $ServCatCat = ServCatCat::model()->find('catid=:catid AND srv_catid=:srv_catid', array(':catid'=>$menuid,':srv_catid'=>$_POST['catid']));
                        if(!isset($ServCatCat)){
                            $ServCatCat = new ServCatCat;
                            $ServCatCat->catid=$menuid;
                            $ServCatCat->srv_catid=$_POST['catid'];
                            $ServCatCat->save();
                        }
                    };break;
                    case 'addusertomenu':{// Добавить пользователя в меню
                        $ServCatUser = ServCatUser::model()->find('catid=:catid AND srv_userid=:srv_userid', array(':catid'=>$menuid,':srv_userid'=>$_POST['userid']));
                        if(!isset($ServCatUser)){
                            $ServCatUser = new ServCatUser;
                            $ServCatUser->catid=$menuid;
                            $ServCatUser->srv_userid=$_POST['userid'];
                            $ServCatUser->save();
                        }
                    };break;
                    case 'deletecatfrommenu':{// Удалить категорию из меню
                        $ServCatCat = ServCatCat::model()->find('catid=:catid AND srv_catid=:srv_catid', array(':catid'=>$menuid,':srv_catid'=>$_POST['catenable']));
                        if(isset($ServCatCat)){
                            $ServCatCat->delete();
                        }
                    };break;
                    case 'deleteuserfrommenu':{// Удалить пользователя из меню
                        
                        $ServCatUser = ServCatUser::model()->find('catid=:catid AND srv_userid=:srv_userid', array(':catid'=>$menuid,':srv_userid'=>$_POST['userenable']));
                        if(isset($ServCatUser)){
                            $ServCatUser->delete();
                        }
                    };break;
                    $upwin=2;
                    case 'addmenuitem':{                // Добавление узла
                        $newNode = new Categories();
                        $newNode->caption = $_POST['caption'];
                        $newNode->controllerid = $_POST['controllerid'];
                        $newNode->actionid = $_POST['actionid'];
                        $node->appendChild($newNode);
                        //$node->save();
                        $upwin=2;
                    };break;
                    case 'deletemenuitem':{
                        $node->deleteNode(true);
                        $upwin=2;
                    };break;
                    case 'upmenuitem':{
                        $node->moveLeft();
                        $upwin=2;
                    };break;
                    case 'downmenuitem':{
                        $node->moveRight();
                        $upwin=2;
                    };break;
                    case 'beforemenuitem':{
                        $node->moveBefore($nodeTo);
                        $upwin=2;
                    };break;
                    case 'belowmenuitem':{
                        $node->moveBelow($nodeTo);
                        $upwin=2;
                    };break;
                }
                if($upwin==1){
                    $this->renderPartial('_users_category', array('datuser'=>$this->MakeListUsers($menuid),'datcategory'=>$this->MakeListCategory($menuid)), false, true);
                }
                if($upwin==2){
                    $data = CHtml::listData(Categories::model()->findAll(array('order'=>'lft')), 'id', 'nameExt');
                    $this->renderPartial('_menu_list', array('data'=>$data), false, true);
                }
                Yii::app()->end();// Завершаем приложение
            }
            else {// Если это простой запрос - обработка
                //$node = Categories::model()->findByPK($menuid);
                //$nodeTo = Categories::model()->findByPK($_POST['nodeto']);
                // Добавление узла
                if(isset($_POST['add'])) {
                    $newNode = new Categories();
                    $newNode->caption = $_POST['caption'];
                    $newNode->controllerid = $_POST['controllerid'];
                    $newNode->actionid = $_POST['actionid'];
/*
                    $newNode->caption = $_POST['caption'];
                    $newNode->controller = $_POST['controller'];
                    $newNode->action = $_POST['action'];
 * 
 */
                    $node->appendChild($newNode);
                }
                // Удаление узла
                if(isset($_POST['delete'])) {
                    $node->deleteNode(true);
                }
                // Перемещение узла на уровень выше
                if(isset($_POST['up'])) {
                    $node->moveLeft();
                }
                // Перемещение узла на уровень ниже
                if(isset($_POST['down'])) {
                    $node->moveRight();
                }
                // Перемещение узла А перед узлом Б
                if(isset($_POST['before'])) {
                    $node->moveBefore($nodeTo);
                }
                // Переместить узел А внутрь узла Б (в подкатегорию)
                if(isset($_POST['below'])) {
                    $node->moveBelow($nodeTo);
                }
                $this->refresh();
            }
        }
        
        $this->actionIndex();
    }
}