<?php
class MailerCommand extends CConsoleCommand
{
//*********************************************************************************************************************************************************
    public function __construct() {
        date_default_timezone_set('Europe/Moscow');
    }
    
    // Действие по рассылке сообщений по этапам проекта
    public function actionProjectStepSendemail(){
        return;
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
/*            foreach(Yii::app()->db
                ->createCommand('SELECT userid FROM smk_reklamation_email_list WHERE reklamationid='.$value['id'].';')
                ->queryAll() as $adr=>$v)
            {
                $adresat_copy[]=$v['userid'];                                   //и записываем их в массив $adresat_copy
            }
 * 
 */
            $this->Sendemail(
                    $adresat,                                                   //делаем рассылку
                    0,//$adresat_copy, - не надо рассылать копии
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
        Yii::app()->mailer->Send();
/*        
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
            Yii::app()->mailer->Send();
            //Yii::app()->mailer->SendAssa();
        }
 * 
 */
    }   
//*********************************************************************************************************************************************************
}
?>
