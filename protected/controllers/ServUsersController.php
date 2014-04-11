<?php

class ServUsersController extends CAssaController
{

	public $layout='//layouts/column2';

	public function filters(){// описание фильтров
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
 function actionCreate()
	{
		$model=new ServUsers;

		if(isset($_POST['ServUsers']))
		{
			$model->attributes=$_POST['ServUsers'];
			$model->category=$_POST['category'];
                        if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionUpdate($id){
        $model=$this->loadModel($id);
            if(isset($_POST['ServUsers'])){
                $model->attributes=$_POST['ServUsers'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function actionUpdatecategory($id){
        $model=$this->loadModel($id);
        if(isset($_POST['ServUsers'])){
            $model->attributes=$_POST['ServUsers'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('updatecategory',array(
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
//            if(Yii::app()->request->isAjaxRequest){// Если это AJAX - запрос
            /*    if(isset($_GET['par'])){
                    switch($_GET['par']){
                        case 'managerlist':
                            $model=new ServUsers();
                            $this->renderpartial('_managerlist',array(
                                'model'=>$model,
                            ));
                        break;
                    }
                }
             * 
             */
//            }
//            else{
                if(isset($_GET['par'])){
                    switch($_GET['par']){
                        case 'listupdate':
                            $this->Parser();
                        break;
                    }
                }
		$model=new ServUsers();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ServUsers']))   $model->attributes=$_GET['ServUsers'];
                if (isset($_GET['ajax'])) {
                $this->renderPartial('index_table',array(
                        'model'=>$model,
                    ));
                }
                else {
                $this->render('index',array(
                        'model'=>$model,
                    )
                );
                }
//            }
	}

	public function loadModel($id)
	{
		$model=ServUsers::model()
                    ->with('ServUsersCategory','ServUsersDepartament','ServUsersDolgnost','Categories','ElbezUserCard')
                    ->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='serv-users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    private function Parser(){
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_dolgnost;')->queryAll() as $row=>$val){//ициализируем массив $dolgnost из таблицы serv_users_dolgnost
            $dolgnost[$val['id']]=str_replace(" ","",mb_strtolower($val['name'],'UTF-8'));
        }
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM reestr_offises_locate;')->queryAll() as $row=>$val){//ициализируем массив $officeallocate из таблицы reestr_offises_locate
            $officeallocate[$val['id']]=str_replace(" ","",mb_strtolower($val['name'],'UTF-8'));
        }
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_departament;')->queryAll() as $row=>$val){//ициализируем массив $departament из таблицы serv_users_departament
            $departament[$val['id']]=str_replace(" ","",mb_strtolower($val['name'],'UTF-8'));
        }
        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_otdel;')->queryAll() as $row=>$val){//ициализируем массив $otdel из таблицы serv_users_otdel
            $otdel[$val['id']]=str_replace(" ","",mb_strtolower($val['name'],'UTF-8'));
        }
        Yii::import('application.extensions.SimpleHTMLDOM.SimpleHTMLDOM');      //работаем с библиотекой SimpleHTMLDOM
        $simpleHTML = new SimpleHTMLDOM;                                        //создадим новй документ
//загрузимся со страницы Синтек и запишем массив
        $html = $simpleHTML->file_get_html('http://intranet.sintek.net/phone/index.php');//загрузимся со страницы
        $tbl=$html->find('table',2)->find('tr');                                //найдем третью таблицу
        foreach($tbl as $element=>$val){                                        //просканируем каждый элемент в этой таблице
            if($val->children(0)->tag=='td'){                                   //где наследником является td (но не tr)
                $a[$element]['id']=$val->children(0)->innertext;
                $str1=explode(',',explode('&',$val->children(1)->children()[0]->href)[1]);//$str=explode('&',$val->children(1)->children()[0]->href);
                $b=array_search(str_replace(' ','',mb_strtolower(explode('=',$str1[1])[1],'UTF-8')),$officeallocate);//распарсим локализацию и найдем идентификатор
                $a[$element]['locate']=$b;                                      //запишем в массив
                if($a[$element]['locate']==false){                              //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                    Yii::app()->db->createCommand('INSERT INTO reestr_offises_locate (`name`) VALUES (\''.$b.'\');')->query();//добавляем в базу
                    foreach(Yii::app()->db->createCommand('SELECT id,name FROM reestr_offises_locate;')->queryAll() as $row=>$va){//переинициализируем массив
                        $officeallocate[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                    }
                    $a[$element]['locate']=array_search($b,$officeallocate);    //снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                }
                $a[$element]['fio']=explode(' ',explode('=',$str1[0])[2]);
                $b=array_search(str_replace(array(' ','-й'),'',mb_strtolower($val->children(2)->innertext,'UTF-8')),$dolgnost);//распарсим должность и найдем идентификатор
                $a[$element]['dolgnost']=$b;                                    //запишем в массив
                if($a[$element]['dolgnost']==false){                            //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                    Yii::app()->db->createCommand('INSERT INTO serv_users_dolgnost (`name`) VALUES (\''.$b.'\');')->query();//добавляем в базу
                    foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_dolgnost;')->queryAll() as $row=>$va){//переинициализируем массив
                        $dolgnost[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                    }
                    $a[$element]['dolgnost']=array_search($b,$dolgnost);        //снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                }
                $a[$element]['email']=$val->children(3)->children() ? $val->children(3)->children()[0]->innertext : '-';
                $a[$element]['tel_in']=$val->children(4)->children() ? $val->children(4)->children()[0]->innertext : '-';
                $a[$element]['tel_mob']=$val->children(5)->children() ? $val->children(5)->children()[0]->innertext : '-';
                $dep_otd=explode('\\',$val->children(6)->innertext);            //сохраняем в $dep_otd значения департамента и отдела (если существует)
                $b=explode('\\',str_replace(array(' ','-й'),'',mb_strtolower($val->children(6)->innertext,'UTF-8')));//сохраняем в $b упакованные значения департамента и отдела (если существует)
                $a[$element]['departament']=array_search($b[0],$departament);   //пытаемся записать в массив идентификатор найденного департамента
                if($a[$element]['departament']==false){                         //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                    Yii::app()->db->createCommand('INSERT INTO serv_users_departament (`name`) VALUES (\''.$dep_otd[0].'\');')->query();//добавляем в базу
                    foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_departament;')->queryAll() as $row=>$va){//переинициализируем массив
                        $departament[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                    }
                    $a[$element]['departament']=array_search($b[0],$departament);//снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                }
                if(isset($b[1])){                                               //если есть второе значение - оно означает отдел - распарсим его
                    $a[$element]['otdel']=array_search($b[1],$otdel);           //пытаемся записать в массив идентификатор найденного отдела
                    if($a[$element]['otdel']==false){                           //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                        Yii::app()->db->createCommand('INSERT INTO serv_users_otdel (`name`) VALUES (\''.$dep_otd[1].'\');')->query();//добавляем в базу
                        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_otdel;')->queryAll() as $row=>$va){//переинициализируем массив
                            $otdel[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                        }
                        $a[$element]['otdel']=array_search($b[1],$otdel);       //снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                    }
                }
                else  $a[$element]['otdel']=1;                                  //если значение не найдено - значит отдела нет - запишем 1 т.е. (нет)
            }
        }
        unset($tbl);
        unset($html);
        unset($simpleHTML);
        $simpleHTML = new SimpleHTMLDOM;                                        //создадим новй документ
//загрузимся со страницы Неотехники и запишем массив
        $html = $simpleHTML->file_get_html('http://intranet.sintek.net/phone/index.php?company_name=%D0%9E%D0%9E%D0%9E%20%D0%9D%D0%B5%D0%BE%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D0%B0&menu_marker=si_stafflist'); 
        $tbl=$html->find('table',2)->find('tr');                                //найдем третью таблицу
        foreach($tbl as $element=>$val){                                        //просканируем каждый элемент в этой таблице
            if($val->children(0)->tag=='td'){                                   //где наследником является td (но не tr)
                $a1[$element]['id']=$val->children(0)->innertext;
                $str1=explode(',',explode('&',$val->children(1)->children()[0]->href)[1]);//$str=explode('&',$val->children(1)->children()[0]->href);
                $b=array_search(str_replace(' ','',mb_strtolower(explode('=',$str1[1])[1],'UTF-8')),$officeallocate);//распарсим локализацию и найдем идентификатор
                $a1[$element]['locate']=$b;                                     //запишем в массив
                if($a1[$element]['locate']==false){                             //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                    Yii::app()->db->createCommand('INSERT INTO reestr_offises_locate (`name`) VALUES (\''.$b.'\');')->query();//добавляем в базу
                    foreach(Yii::app()->db->createCommand('SELECT id,name FROM reestr_offises_locate;')->queryAll() as $row=>$va){//переинициализируем массив
                        $officeallocate[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                    }
                    $a1[$element]['locate']=array_search($b,$officeallocate);   //снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                }
                $a1[$element]['fio']=explode(' ',explode('=',$str1[0])[2]);
                $b=array_search(str_replace(array(' ','-й'),'',mb_strtolower($val->children(2)->innertext,'UTF-8')),$dolgnost);//распарсим должность и найдем идентификатор
                $a1[$element]['dolgnost']=$b;                                   //запишем в массив
                if($a1[$element]['dolgnost']==false){                           //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                    Yii::app()->db->createCommand('INSERT INTO serv_users_dolgnost (`name`) VALUES (\''.$b.'\');')->query();//добавляем в базу
                    foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_dolgnost;')->queryAll() as $row=>$va){//переинициализируем массив
                        $dolgnost[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                    }
                    $a1[$element]['dolgnost']=array_search($b,$dolgnost);       //снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                }
                $a1[$element]['email']=$val->children(3)->children() ? $val->children(3)->children()[0]->innertext : '-';
                $a1[$element]['tel_in']=$val->children(4)->children() ? $val->children(4)->children()[0]->innertext : '-';
                $a1[$element]['tel_mob']=$val->children(5)->children() ? $val->children(5)->children()[0]->innertext : '-';
                $dep_otd=explode('\\',$val->children(6)->innertext);            //сохраняем в $dep_otd значения департамента и отдела (если существует)
                $b=explode('\\',str_replace(array(' ','-й'),'',mb_strtolower($val->children(6)->innertext,'UTF-8')));//сохраняем в $b упакованные значения департамента и отдела (если существует)
                $a1[$element]['departament']=array_search($b[0],$departament);  //пытаемся записать в массив идентификатор найденного департамента
                if($a1[$element]['departament']==false){                        //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                    Yii::app()->db->createCommand('INSERT INTO serv_users_departament (name) VALUES (\''.$dep_otd[0].'\');')->query();//добавляем в базу
                    foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_departament;')->queryAll() as $row=>$va){//переинициализируем массив
                        $departament[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                    }
                    $a1[$element]['departament']=array_search($b[0],$departament);//снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                }
                if(isset($b[1])){                                               //если есть второе значение - оно означает отдел - распарсим его
                    $a1[$element]['otdel']=array_search($b[1],$otdel);          //пытаемся записать в массив идентификатор найденного отдела
                    if($a1[$element]['otdel']==false){                          //если идентификатор не найден, значит такой записи не существует - нужно добавить в базу
                        Yii::app()->db->createCommand('INSERT INTO serv_users_otdel (`name`) VALUES (\''.$dep_otd[1].'\');')->query();//добавляем в базу
                        foreach(Yii::app()->db->createCommand('SELECT id,name FROM serv_users_otdel;')->queryAll() as $row=>$va){//переинициализируем массив
                            $otdel[$va['id']]=str_replace(" ","",mb_strtolower($va['name'],'UTF-8'));
                        }
                        $a1[$element]['otdel']=array_search($b[1],$otdel);      //снова записываем в массив идентификатор (надеемся, что на этот раз все получится)
                    }
                }
                else  $a1[$element]['otdel']=1;                                 //если значение не найдено - значит отдела нет - запишем 1 т.е. (нет)
            }
        }
        unset($tbl);
        unset($html);
        unset($simpleHTML);
        $a=array_merge($a,$a1);//объединим два массива и начнем его обработку
// теперь просканируем и обновим таблицу serv_users, если появились новые сотрудники - их добавляем, если кто уволился - надо поставить active=0
        foreach($a as $users=>$user){
            $sql='SELECT * FROM serv_users WHERE fname=\''.$user['fio'][0].'\' AND sname=\''.$user['fio'][1].'\' AND tname=\''.$user['fio'][2].'\' AND active>0;';
            $tbl_usr=Yii::app()->db->createCommand($sql)->queryAll();
            $active=0;
            if(isset($tbl_usr[0])){                                             //если пользователя с такими ФИО нашли в базе
                if( ($tbl_usr[0]['departamentid']==$user['departament'])&&      // проверим легитимность данных по нему
                    ($tbl_usr[0]['dolgnostid']==$user['dolgnost'])&&
                    ($tbl_usr[0]['otdelid']==$user['otdel'])&&
                    ($tbl_usr[0]['email']==$user['email'])&&
                    ($tbl_usr[0]['tel_in']==$user['tel_in'])&&
                    ($tbl_usr[0]['tel_mob']==$user['tel_mob'])&&
                    ($tbl_usr[0]['officelocate']==$user['locate'])
                ){  $active=4;
                    Yii::app()->db->createCommand(                              // - данные легитимны
                        'UPDATE serv_users
                        SET active='.$active.' WHERE id='.$tbl_usr[0]['id'].';' //active=4 - изменим признак - пользователь просмотрен отличий нет
                    )->query();
                }
                else{  $active=2;
                    Yii::app()->db->createCommand(                              // - Данные устарели - обновим по нему информацию
                        'UPDATE serv_users
                        SET departamentid='.$user['departament'].
                        ', dolgnostid='.$user['dolgnost'].
                        ', otdelid='.$user['otdel'].
                        ', email=\''.$user['email'].
                        '\', tel_in=\''.$user['tel_in'].
                        '\', tel_mob=\''.$user['tel_mob'].
                        '\', officelocate='.$user['locate'].
                        ', active='.$active.                                    //active=2 - и поставим признак  - обновления данных о пользователе
                        ' WHERE id='.$tbl_usr[0]['id'].';'
                    )->query();
                }
/*                // проверка и добавление данных по пользователю в таблицу по электробезопасности
                $elbezid=Yii::app()->db->createCommand('SELECT id FROM serv_users_elbez WHERE userid='.$tbl_usr[0]['id'].';')->queryAll();//Проверим, есть ли данные по этому пользователю в таблице по эл. без.ти
                if(!isset($elbezid[0])){                                        // если записи по этому пользователю нет, то 
                    Yii::app()->db->createCommand(                              //добавим пользователя в таблицу serv_users_elbez
                        'INSERT INTO serv_users_elbez (userid) VALUES ('.$tbl_usr[0]['id'].');'
                    )->query();
                }
 * 
 */
            }
            else{  $active=3;
                Yii::app()->db->createCommand(                                  //такого пользователя в базе нет - добавим пользователя в таблицу serv_users
                    'INSERT INTO serv_users (fname,pass,sname,tname,departamentid,dolgnostid,otdelid,email,tel_in,tel_mob,officelocate,active)
                    VALUES(\''.$user['fio'][0].
                        '\',\''.md5($user['fio'][0]).
                        '\',\''.$user['fio'][1].
                        '\',\''.$user['fio'][2].
                        '\','.$user['departament'].
                        ','.$user['dolgnost'].
                        ','.$user['otdel'].
                        ',\''.$user['email'].
                        '\',\''.$user['tel_in'].
                        '\',\''.$user['tel_mob'].
                        '\','.$user['locate'].
                        ','.$active.');'                                        //active=3 - признак добавления нового пользователя
                )->query();
/*                // добавление данных по пользователю в таблицу по электробезопасности
                $maxid=Yii::app()->db->createCommand('SELECT max(id) as maxid FROM serv_users;')->queryAll()[0]['maxid'];//определим идентификатор нового пользователя
                Yii::app()->db->createCommand(                                  //добавим пользователя в таблицу serv_users_elbez
                    'INSERT INTO serv_users_elbez (userid) VALUES ('.$maxid.');'
                )->query();     
 * 
 */
            }
        }
        Yii::app()->db->createCommand('UPDATE serv_users su SET active=5 WHERE active=1;')->query();//сбросить активность всех пользователей, которых не обновили или не добавили или не просмотрели - т.е. кто уволен
        Yii::app()->db->createCommand('call serv_users_migration_update();')->query();//обновить таблицу migration и привести в порядок все active  в таблице serv_users
        Yii::app()->cache->delete('UsersList');                                 //удалить кеш списка пользователей
        
        Yii::app()->cache->delete('ServUsersDolgnost');                         //удалить кеш списка всех должностей пользователей системы
        Yii::app()->cache->delete('ServUsersDepartament');                      //удалить кеш списка всех департаментов компании
        Yii::app()->cache->delete('ServUsersOtdel');                            //удалить кеш списка всех отделов компании
        Yii::app()->cache->delete('ReestrOfficeLocate');                        //удалить кеш списка всех офисов компании

        Yii::app()->cache->delete('serv_users_list');                           //удалить кеш виджета списка всех пользователей системы
    }
}
