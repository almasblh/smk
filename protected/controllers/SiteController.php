<?php

class SiteController extends CAssaController
{
	public $layout='//layouts/column2';
	public function actions(){
            return array(
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                ),
                'page'=>array(
                        'class'=>'CViewAction',
                ),
            );
	}
        
/*    public function accessRules(){// правила доступа к ресурсам контроллера
        return array(
            array('allow',  // список разрешений
                'users'=>array('*','$'),
            ),
        );
    }
 
	public function filters(){
            return array(
                'accessControl', // perform access control for CRUD operations
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
* 
 */    
    public function actionRobokassa(){// правила доступа к ресурсам контроллера
        $amount = 100; //$
        $orderId = 124;
        $description = 'велосипед с зеркалом';
        $clierntEmail = 'rewtrd@gmail.com';
        Yii::app()->rc->pay($amount, $orderId,$description,$clierntEmail);
    }

	public function actionError(){
//		if($error==Yii::app()->errorHandler->error)
		$error=Yii::app()->errorHandler->error;
                //$a=Yii::app()->errorHandler->error;
                if ($error['code']==403)
                    $this->redirect(array('login'));
                else{
                    if(Yii::app()->request->isAjaxRequest)
                            echo $error['message'];
                    else
                            $this->render('error', $error);
		}
	}

        
//*********************************************************************************************************************************************************
    
    // Действие по рассылке сообщений по этапам проекта
    public function actionProjectStepSendemail(){
        Yii::app()->db->createCommand("UPDATE test set ProjectStepSendemail=(ProjectStepSendemail+1);")->query();
        $projects=SmkProjects::model()->findAll();                              // грузим список всех проектов
        foreach($projects as $p=>$project){                                     // для каждого проекта
            if( $project['approved']>0                                          // если проект утвержден
                && $project['percentage_complet']<100                           // и процент выполнения меньше 100, то
            ){  
                $project_step=SmkProjectStep::model()->findAll(array(           // грузим все его этапы
                    'condition'=>'t.projectid='.$project['id']                 
                ));
                foreach($project_step as $m=>$val){                             // для каждого этапа
                    if(
                        $this->CalcSend($val['nexttimemail'])<0                 // дата рассылки просрочена
                        && ($val['datestopfact']==0)                            // и datestopfact не существует
                    ){
                        $datetostop=(getdate()[0]-getdate(strtotime($val['datestop']))[0]);//вычисление количества дней, оставшихся до окончания этапа (если <0, значит просрочено)
                    // формируем заголовок
                        $subject ='Уведомление от СМК по проекту ПГВР №'.$project['Npgvr'];  
                        if($val['mailcount']>0) $subject.=' (Повторно '.$val['mailcount'].'-й раз)';     // если это не первое сообщение, то допишем к теме - Повторно
                        if($datetostop>0) $subject.=' ПРОСРОЧЕНО';
                    // -------------------
                    // формируем $select
                        if($val['datestartfact']==0){                           // если этап не стартован (datestartfact=0)
                            $select='step_start';
                        }
                        else{
                            if($val['datestopfact']==0){                        // если этап стартован но незакончен
                                $select='step_stop';
                            }
                        }
                    // -------------------
                        if(isset($select)){                                     // если есть что рассылать
                            $adresat[] = $val['curatorid'];                     //назначим адресата - ответственного за этап
                            //вычисляем список подписчиков на рассылку по данной рекламации
                            $adresat_copy=0;
                            foreach(Yii::app()->db
                                ->createCommand('SELECT userid FROM smk_project_email_list WHERE projectid='.$val['projectid'].';')// AND id= $val['id'] - это если по этапам фильтровать
                                ->queryAll() as $adr=>$v)
                            $adresat_copy[]=$v['userid'];                       //и записываем их в массив $adresat_copy
                        //делаем рассылку
                            $this->Sendemail($adresat,
                                            $adresat_copy,
                                            $subject,
                                            $select,
                                            $val,
                                            $path='project',
                                            $datetostop
                                        );
                        // -------------------
                            $val['mailcount']+=1;                               //увеличиваем счетчик рассылок
                            $val['nexttimemail']=$this->CalcNextDate($val['datestop']);//формируем дату следующей рассылки
                            $dd=$this->DivDate($val['datestop'],$val['nexttimemail']);//вычислияем разность 
                            if($dd<0){                                          //если stopdate раньше nexttimemail (т.е. просрочено)
                                $val['nexttimemail']=date("Y-m-d H:i:s",getdate()[0]+86400);//дата следующей рассылки - завтра
                                if($val['current_persent']>0)                   //если процент выполнения положительный, то сделать отрицательным
                                    $val['current_persent']=-$val['current_persent'];
                            }
                            else if($dd<86400){                                 //если дата след рассылки не далее 1 дня от сегодня
                                $a=getdate(strtotime($val['datestop']));
                                $val['nexttimemail']=date("Y-m-d H:i:s", $a[0]+3600);// то дата сле рассылки = stopdate + 1 час
                            }
                            SmkProjectStep::model()                             //записываем информацию в базу
                                ->updateByPk(
                                    $val['id'],
                                    array('mailcount'=>$val['mailcount'],
                                        'nexttimemail'=>$val['nexttimemail'],
                                        'current_persent'=>$val['current_persent']
                                    )
                                );
                        }
                    }
                }
            }
            else{//если проект не утвержден - то
                if($project['stepsapproved']==1){                               //если все этапы утверждены - то
//-----------------------------                    
                    if($this->CalcSend($project['nexttimemailmanager'])<0                   // если дата рассылки просрочена
                         && $project['signaturemanagerid']==0                               // и подписи ответственного нет - то
                    ){
                        $subject = 'Уведомление от СМК по проекту ПГВР №'.$project['Npgvr'];  // формируем заголовок
                        if($project['mailcountmanager']>0) $subject.=' (Повторно '.$project['mailcountmanager'].'-й раз)';     // если это не первое сообщение, то допишем к теме - Повторно
                        $this->Sendemail(array($project['managerid']),                  //рассылка руководителю о необходимости утверждения
                                        0,                                              //копий нет                                              
                                        $subject,
                                        'new_project',
                                        $project,
                                        'project'
                         );
                        $project['mailcountmanager']+=1;                                //увеличиваем счетчик рассылок
                        $project['nexttimemailmanager']=date("Y-m-d H:i:s",getdate()[0]+86400);//дата следующей рассылки - завтра
                    }
//-----------------------------                    
                    if($this->CalcSend($project['nexttimemailshefOUP'])<0                   // если дата рассылки просрочена
                         && $project['signatureshefOUPid']==0                               // и подписи ответственного нет - то
                    ){
                        $subject = 'Уведомление от СМК по проекту ПГВР №'.$project['Npgvr'];  // формируем заголовок
                        if($project['mailcountshefOUP']>0) $subject.=' (Повторно '.$project['mailcountshefOUP'].'-й раз)';     // если это не первое сообщение, то допишем к теме - Повторно
                        $this->Sendemail(array(217),//18                                     //рассылка начальнику ОУП о необходимости утверждения 18 - id начальника ОУП
                                        0,                                              //копий нет                                              
                                        $subject,
                                        'new_project',
                                        $project,
                                        'project'
                         );
                        $project['mailcountshefOUP']+=1;                                //увеличиваем счетчик рассылок
                        $project['nexttimemailshefOUP']=date("Y-m-d H:i:s",getdate()[0]+86400);//дата следующей рассылки - завтра
                    }
//-----------------------------
/*                    if($this->CalcSend($project['nexttimemiletechdirector'])<0                   // если дата рассылки просрочена
                         && $project['signaturetechdirectorid']==0                               // и подписи ответственного нет - то
                    ){
                        $subject = 'Уведомление от СМК по проекту ПГВР №'.$project['Npgvr'];  // формируем заголовок
                        if($project['mailcounttechdirecor']>0) $subject.=' (Повторно '.$project['mailcounttechdirecor'].'-й раз)';     // если это не первое сообщение, то допишем к теме - Повторно
                        $this->Sendemail(array(217),                  //рассылка тех. директору о необходимости утверждения
                                        0,                                              //копий нет                                              
                                        $subject,
                                        'new_project',
                                        $project,
                                        'project'
                         );
                        $project['mailcounttechdirecor']+=1;                                //увеличиваем счетчик рассылок
                        $project['nexttimemiletechdirector']=date("Y-m-d H:i:s",getdate()[0]+86400);//дата следующей рассылки - завтра
                    }
 * 
 */
                    SmkProjects::model()                             //записываем информацию в базу
                        ->updateByPk(
                            $project['id'],
                            array(
                                'mailcountmanager'=>$project['mailcountmanager'],
                                'nexttimemailmanager'=>$project['nexttimemailmanager'],
                                'mailcountshefOUP'=>$project['mailcountshefOUP'],
                                'nexttimemailshefOUP'=>$project['nexttimemailshefOUP'],
                                'mailcounttechdirecor'=>$project['mailcounttechdirecor'],
                                'nexttimemiletechdirector'=>$project['nexttimemiletechdirector'],
                            )
                        );
                }
                else{                                                           //если этапы не утверждены - то
                    $project_step=SmkProjectStep::model()->findAll(array(           // грузим все этапы проекта
                        'condition'=>'t.projectid='.$project['id']                
                    ));
                    foreach($project_step as $m=>$val){                             // для каждого этапа
                        if($this->CalcSend($val['nexttimemail'])<0                  // если дата рассылки просрочена
                             && $val['signaturecurator']==0                         // и подписи ответственного нет - то
                        ){
                            $subject = 'Уведомление от СМК по проекту ПГВР №'.$project['Npgvr'];  // формируем заголовок
                            if($val['mailcount']>0) $subject.=' (Повторно '.$val['mailcount'].'-й раз)';     // если это не первое сообщение, то допишем к теме - Повторно
                            $this->Sendemail(array($val['curatorid'],               //рассылка ответственному за этап о необходимости утверждения
                                                ),                                               
                                                0,                                  //копий нет                                               
                                                $subject,
                                                'new_step',
                                                $val,
                                                'project'
                            );
                            $val['mailcount']+=1;                                           //увеличиваем счетчик рассылок
                            $val['nexttimemail']=date("Y-m-d H:i:s",getdate()[0]+86400);    //дата следующей рассылки - завтра
                            SmkProjectStep::model()                                         //записываем информацию в базу
                                ->updateByPk(
                                    $val['id'],
                                    array('mailcount'=>$val['mailcount'],
                                        'nexttimemail'=>$val['nexttimemail'],
                                    )
                                );
                        }
                    }
                }
            }
        }
    }
    
    public function actionReklamationSendemail(){
        $model = SmkReklamation::model()
                ->with(array('status'=>array(
                        'on'=>'status.id=t.laststatusid',                       //      выбор всех рекламаций с описанием последнего статуса
                )))
                ->findAll(array(
                    'condition'=>'t.state=true AND status.nexttimemail<NOW() AND (status.datestart<NOW() OR status.statusid=0)'
                                                                                //где рекламация не завершена
                                                                                // И дата рассылки просрочена
                                                                                // И (дата старта этапа наступила ИЛИ это ввод новой рекламации)
                ));
        $managers=Yii::app()->db->createCommand(                                //сформировать список адресатов менеджеров по рекламациям для рассылки
                    'SELECT userid FROM serv_users_role sur WHERE (sur.category & 4096)<>0 ORDER BY sur.category;'
                )->queryAll();                                                  //взять список всех менеджеров по рекламациям (в том числе и суперпользователя)
        foreach($model as $m=>$value){                                          //прокручиваем все рекламации
                $adresat[]=0;
                $adresat_copy[]=0;
                $datetostop=(getdate()[0]-getdate(strtotime($value['status']['datestop']))[0]);//вычисление количества дней, оставшихся до окончания этапа (если <0, значит просрочено)
                $subject = 'Уведомление от СМК по рекламации №'.$value['id'];  // формируем заголовок
                if($value['status']['mailcount']>0) $subject.=' (Повторно '.$value['status']['mailcount'].'-й раз)';     // если это не первое сообщение, то допишем к теме - Повторно
                if($datetostop>0) $subject.=' ПРОСРОЧЕНО';
                
                if($value['status']['statusid']==0){                             // если это ввод новой рекламации, то
                    $select='new';
                    $adresat = $managers;                                       // адресаты - менеджеры по рекламациям
                }
                else{
                    if($value['status']['steppersent']<100){                    // если выполнение этапа менее 100%, то
                        $select='coment';
                        $adresat[0] = $value['status']['responsibleuserid1'];   //назначим адресата - ответственного за этап
                        $adresat_copy = $managers;                              //копии писем разослать менеджерам
                    }
                    else{                                                       // если выполнение этапа = 100%,т.е. этап выполненн, то
                        $select='change_status';
                        $adresat = $managers;                                       // адресаты - менеджеры по рекламациям
                    }
                }
           //вычисляем список подписчиков на рассылку по данной рекламации
            foreach(Yii::app()->db
                ->createCommand('SELECT userid FROM smk_reklamation_email_list WHERE reklamationid='.$value['id'].';')
                ->queryAll() as $adr=>$v)
            {
                $adresat_copy[]=$v['userid'];                                   //и записываем их в массив $adresat_copy
            }
            $this->Sendemail(
                    $adresat,                                                   //делаем рассылку
                    $adresat_copy,
                    $subject,
                    $select,
                    $value,
                    $path='reklamation',
                    $datetostop
            );
            $value['status']['mailcount']+=1;                                   //увеличиваем счетчик рассылок
            $value['status']['nexttimemail']=$this->CalcNextDate($value['status']['datestop']);//формируем дату следующей рассылки
            $dd=$this->DivDate($value['status']['datestop'],$value['status']['nexttimemail']);//вычислияем разность 
            if($dd<0){                                                          //если stopdate
                $now=getdate();
                $value['status']['nexttimemail']=date("Y-m-d H:i:s",$now[0]+86400);
                if($value['status']['steppersent']>0)                           //если процент выполнения положительный, то сделать отрицательным
                    $value['status']['steppersent']=-$value['status']['steppersent'];
            }
            else if($dd<86400){
                $a=getdate(strtotime($value['status']['datestop']));
                $value['status']['nexttimemail']=date("Y-m-d H:i:s", $a[0]+3600);
            }
            SmkReklamationStatus::model()                                       //записываем информацию в базу
                ->updateByPk(
                    $value['status']['id'],
                    array('mailcount'=>$value['status']['mailcount'],
                        'nexttimemail'=>$value['status']['nexttimemail'],
                        'steppersent'=>$value['status']['steppersent']
                    )
                );
         }
    }
    
    //Функция вычисления следующей даты для рассылки
    //вход: $lastdate - дата окончания интервала
    //формула вычисления: return = now + (lastdate - now) / 2
    private function  CalcNextDate($lastdate){
        $lastdate=getdate(strtotime($lastdate));
        $now=getdate();
        $c=getdate($now[0]+($lastdate[0]-$now[0])/2);
        return date("Y-m-d H:i:s", $c[0]);
    }
    
    //Функция вычисления разности между сегодня и даты из параметра
    //вход: $date - дата
    private function  CalcSend($date){
        $date=getdate(strtotime($date));
        $now=getdate();
        return ($date[0]-$now[0]);
    }
    //Функция вычисления разности между двумя датами
    //вход: $date1 - дата
    //вход: $date2 - дата
    private function  DivDate($date1,$date2){
        $date1=getdate(strtotime($date1));
        $date2=getdate(strtotime($date2));
        return ($date1[0]-$date2[0]);
    }
    
    //Функция почтовой раасылки
    private function Sendemail(
            $userid,                                                            //кому
            $userid_copy=0,                                                       //кому копии
            $subject,                                                           //тема письма
            $select,                                                            //шаблон письма
            $value,                                                             //данные
            $path,                                                              //путь - определяет путь к шаблону
            $datetostop=0                                                       //срок окончания. если <0 то просрочено
    ){
        if($userid[0]==0) return 0;//если нет списка адресатов - выход

        Yii::app()->mailer->SetPathViews(Yii::app()->mailer->pathViewsDefault.'.'.$path);
        Yii::app()->mailer->SetPathLayouts(Yii::app()->mailer->GetPathViews().'.layouts');
        unset($adresat);
        foreach($userid as $us=>$row){                                          //составить список адресатов по количеству менеджеров по рекламациям
            $a=ServUsers::model()->findbyPk($row,array('select'=>"fname,sname,tname,email"));
            $adresat[]=$a->fname.' '.$a->sname.' '.$a->tname;
            Yii::app()->mailer->AddAddress($a->email);
        }
        Yii::app()->mailer->Host = 'smtp-nn.sintek-nn.ru';
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->From = 'smk@sintek-nn.ru';
        Yii::app()->mailer->FromName = 'smk';
        Yii::app()->mailer->CharSet = 'Windows-1251';//'UTF8';//
        Yii::app()->mailer->Subject = mb_convert_encoding($subject,"CP1251","UTF-8");
        Yii::app()->mailer->IsHTML(true);

        Yii::app()->mailer->Body = mb_convert_encoding(
                $this->renderFile(
                    Yii::getPathOfAlias(Yii::app()->mailer->GetPathLayouts().'.template').'.php',
                    array('content'=>
                        $this->renderFile(
                            Yii::getPathOfAlias(Yii::app()->mailer->GetPathViews().'.'.$select).'.php',
                            array('value'=>$value,'datetostop'=>$datetostop),
                            true
                        )       
                    ),
                    true
                ),
                "CP1251",
                "UTF-8"
            );
        Yii::app()->mailer->SendAssa();
        //Yii::app()->mailer->Send();
        if($userid_copy[0]!=0){//рассылка копий
            Yii::app()->mailer->ClearAddresses();
            foreach($userid_copy as $s=>$row){
                $a=ServUsers::model()->findbyPk($row['userid'],array('select'=>"email"));
                Yii::app()->mailer->AddAddress($a->email);
            }
            Yii::app()->mailer->Subject = mb_convert_encoding('(Копия) '.$subject,"CP1251","UTF-8");
            Yii::app()->mailer->Body = mb_convert_encoding(
                $this->renderFile(
                    Yii::getPathOfAlias(Yii::app()->mailer->GetPathLayouts().'.copy_template').'.php',
                    array('content'=>
                        $this->renderFile(
                            Yii::getPathOfAlias(Yii::app()->mailer->GetPathViews().'.'.$select).'.php',
                            array(  'value'=>$value,
                                    'datetostop'=>$datetostop
                            ),
                            true
                        ),
                        'adresat'=>$adresat       
                    ),
                    true
                ),
                "CP1251",
                "UTF-8"
            );
            //Yii::app()->mailer->Send();
            Yii::app()->mailer->SendAssa();
        }
    }    
//*********************************************************************************************************************************************************
    
        public function actionPasschange(){
            $model=new ChangePassForm;
            if(isset($_POST['ChangePassForm'])){
                $model->attributes=$_POST['ChangePassForm'];
                if($model->validate()){
                    $a=ServUsers::model()->findByPk(Yii::app()->user->id);
                    $b=$_POST['ChangePassForm']['oldpass'];
                    $c=md5($b);
                    $d=$a->pass;
                    $e=$_POST['ChangePassForm']['newpass1'];
                    $f=$_POST['ChangePassForm']['newpass2'];
                    if(md5($_POST['ChangePassForm']['oldpass'])===$a->pass && $_POST['ChangePassForm']['newpass1']===$_POST['ChangePassForm']['newpass2']){
                        $a->pass=md5($_POST['ChangePassForm']['newpass1']);
                        $a->save();
                        $this->render('messagebox',array('msg'=>'Пароль успешно сменён.'));
                    }
                    else{
                        $this->render('messagebox',array('msg'=>'Не верно. Попробуйте еще раз.'));
                    }
                }
            }
            else {
                $this->render('passchange',array('model'=>$model));
            }
        }
        
        public function actionSelect(){
            if(isset($_GET['par'])){
                if(isset($_POST['Project'])){//по заполнению формы выбора активного этапа проекта
                    $this->ActiveProjectSessionSave($_POST['Project']);
                    $this->redirect(Yii::app()->user->returnUrl);
                }            
                elseif(isset($_POST['Step'])){//если форма заполнена - то сохраняем результаты
                    $this->ActiveProjectStepSessionSave($_POST['Step']);
                    $this->redirect(Yii::app()->user->returnUrl);
                }
                elseif($_GET['par']=='Project')
                    $this->renderPartial('select_project'/*,array('model'=>$model)*/);
                elseif($_GET['par']=='Step'){
                    $model= SmkProjectStep::model()
                        ->with('SmkProjectStepName')
                        ->findAll(array(
                            'condition'=>'projectid='.Yii::app()->user->getState('activeproject')
                            )
                        );
                    $this->renderPartial('select_project_step',array('model'=>$model));
                }
            }
        }
                
        public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
        
        public function actionIndex(){
            if(isset($_GET['par']) && $_GET['par']=='cachereset'){
                Yii::app()->cache->flush();
                $this->redirect(Yii::app()->user->returnUrl);
            }
            $model=new ServUsersRole;
            $model->unsetAttributes();
            if(isset($_GET['ServUsersRole']))
                $model->attributes=$_GET['ServUsersRole'];

            $this->render('index',
                array('model'=>$model)
            );
	}
        
        public function actionLogin(){
            //Yii::app()->cache->delete('users_list');
            $model=new LoginForm;
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
            if(isset($_POST['LoginForm'])){
                    $model->attributes=$_POST['LoginForm'];
                    if($model->validate() && $model->login()){
                        $this->MakeControllersAndActionsListForCurrentUser(Yii::app()->user->id);
                        $roles=Yii::app()->db->createCommand(
                            'SELECT * FROM serv_users_role sur WHERE userid='.Yii::app()->user->id.';'
                        )->queryAll();
                        Yii::app()->user->setState('userroles',$roles);         //записать в сессию все роли пользователя по всем проектам
                        $mainrole=Yii::app()->db->createCommand(
                            'SELECT * FROM serv_users_role sur WHERE projectid=0 AND userid='.Yii::app()->user->id.';'
                        )->queryAll();
                        Yii::app()->user->setState('usermainrole',$mainrole);   //записать в сессию основную роль пользователя
                        Yii::app()->user->setState('reklmanager',isset($mainrole[0]['category'])?(boolean)($mainrole[0]['category']&4096):0);//менеджер по рекламациям
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
            }
            $this->render('login',array('model'=>$model));//отобразим вьювер формы логин
        }
        
    public function actionLogout(){
        Yii::app()->cache->flush();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}

