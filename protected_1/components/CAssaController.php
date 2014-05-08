<?php
class CAssaController extends Controller
{
/*    function init(){
        // Если параметр не пуст и текущий режим не соответствует выставленному в настройках
        if(
            !empty(Yii::app()->user->useHttps) &&
            Yii::app()->request->isSecureConnection!==Yii::app()->user->useHttps
        ){
            $schema = 'http://';
            if(Yii::app()->user->useHttps){
                $schema = 'https://';
            }
 
            // получим URL с нужной схемой
            $url = $schema.Yii::app()->request->serverName.Yii::app()->request->url;
 
            // перенаправим на него пользователя
            Yii::app()->request->redirect($url, true);
        }
    }
 * 
 */
    
    public function ActiveProjectSessionSave($id){
        $project=SmkProjects::model()->findByPk($id);
        Yii::app()->user->setState('activeproject',$project->id);
        Yii::app()->user->setState('activeprojectname',$project->Name);
        Yii::app()->user->setState('activeprojectpgvr',$project->Npgvr);
        Yii::app()->user->setState('activeprojectstep',0);
        Yii::app()->user->setState('activeprojectstepname','не выбран');
        $this->MakeControllersAndActionsListForCurrentUser(Yii::app()->user->id);
    }
 
    protected function beforeAction($action) {
        if (Yii::app()->user->isGuest && ($this->id.'/'.$action->id !== 'site/login')) {
          Yii::app()->user->loginRequired();
        }
        return true;
    }
    
    public function ActiveProjectStepSessionSave($id){
        //$project=SmkProjectStep::model()->findByPk($id);
        Yii::app()->user->setState('activeprojectstep',$id);                        //сохраняем активный этап в сессию
        $str=SmkProjectStepName::model()->findByPk($id)->name;
        Yii::app()->user->setState('activeprojectstepname',$str);                   //и имя этапа
        $this->MakeControllersAndActionsListForCurrentUser(Yii::app()->user->id);   //переопределяем права пользователя
    }
    public function MenuButton( $controller,                                    //Имя контроллера
                                $action,                                        //Имя акции
                                $Title,                                         //Наименование кнопки
                                $par='',                                        //Параметры
                                $SubjectType='',                                //тип окна заполнения данными "ajax","PopUpWin","NewWin"
                                $div=''                                         //тег окна заполнения
            ){
        $param = $par=='' ? '' : '&'.$par;
        if($this->EnableForCurrentUser($controller,$action)){                   // проверка на допуск пользователя к данной кнопке
            switch($SubjectType){
                case 'ajax':                                                    // если это ajax кнопка
                    echo CHtml::ajaxButton(                                     // то вывод ajax
                            $Title,
                            array($controller.'/'.$action.$param),
                            array('type' => 'POST',
                                  'update' =>$div,
                            )
                    );
                break;
                case 'PopUpWin':
                    echo CHtml::link(
                            CHtml::button($Title),
                            array($controller.'/'.$action.$param)
                            ,array(
                                'onclick'=>'window.open(
                                    this.href,
                                    \'\',
                                    \'scrollbars,menubar,location,width=400,height=300,top=0\'
                                ); win.focus(); return false'
    //                                \'menubar=no,resizable=no,scrollbars=no,status=no,location,width=400,height=300,top=0\'
                            )
                    );
                break;
                case 'NewWin':                                                  //создание нового окна
                    echo CHtml::link(
                            CHtml::button($Title),
                            array($controller.'/'.$action.$param)
                            ,array(
                               'target'=>"_blank"
                            )
                    );
                break;
                default:                                                        //иначе вывод простой кнопки
                    echo CHtml::link(
                            CHtml::button($Title),
                            array($controller.'/'.$action.$param)
                    );
                break;
            }
        }
    }
       
    //метод нахождения разрешенных действий для конкретного контроллера текущего пользователя
    // на входе:
    //          $ControllerName 
    // на выходе:
    //          $f - список разрешенных действий (подставляем в accessRules() вызывающего контроллера)
    public function ActionsForUser($ControllerName){

        $cn=explode('Controller',$ControllerName);
        $EnableActions=Yii::app()->user->getState('enactions');
        $f=array();
        if(isset($EnableActions)){
            foreach($EnableActions as $row=>$value){
                if($value[0]===$cn[0]){
                    $f[$row]=$value[1];
                }
            }
        }
        //$f[]='select';
        if(count($f)==0) $f[0]='_';
        return $f;
    }
    
    public function MakeControllersAndActionsListForCurrentUser($userid){
        
        $ap=Yii::app()->user->getState('activeproject');
        $aps=Yii::app()->user->getState('activeprojectstep');
        $aps=isset($aps)?$aps:0;
        $str='userid='.$userid//Yii::app()->user->id                            // построение запроса - выбрать текущего пользователя
           // .' AND datestart<now()'                                             // где дата начала действия роли в прошлом
           // .' AND (datestop>=now() OR datestop=0)'                             // дата окончания действия роли в будущем или настоящем
            .' AND (projectid=0 OR projectid='.($ap>0 ? $ap : 0).')'            // если роль зависит от проекта то она должна соответсвовать текущему проекту
            .' AND (projectstepid=0 OR projectstepid='.($aps>0 ? $aps : 0).')'; // если роль зависит от этапа проекта, то она должна соответствовать текущему этапу
        $a=ServUsersRole::model()
                ->with('ServUsersCategory')
                ->findAll($str);                                                //выборка по всем текущим доступным категориям пользователя
        $role=(int)0;
        foreach($a as $row=>$value){                                            //объединим все текущие роли пользователя по или
            $role=$role|$value['category'];
            $ActiveCategory[$value['category']]=$value->ServUsersCategory['name'];
        }
        Yii::app()->user->setState('activecategory',isset($ActiveCategory)?$ActiveCategory:0);//запишем в сессию список активных категорий пользователя
        if($role==-1){                                                          //если получился суперпользователь то просто записть это в сессию
            Yii::app()->user->setState('sup',true);
            return;
        }
        else{//иначе нужно перебрать все доступные роли и определить общий массив разрешенных действий для ввсех доступных контроллеров
            Yii::app()->user->setState('sup',false);
//            if($role==0){//если роль не определена - по умолчанию - пользователь - нужно перебрать все права пользователя
            $out=array();
            $ec=ServCatCat::model()// в начале переберем права роли по умолчанию - пользователь
                ->with('Categories.ServControllers',
                        'Categories.ServControllersAction'
                )
                ->findAll('srv_catid=:srv_catid',
                        array(':srv_catid'=>0       //здесь 0 так как роль = 0
                        )
                );
                //теперь в $ec список id из таблицы меню categories
                foreach($ec as $row=>$value){
                    $ContrAct[0]=$value->Categories->ServControllers['name'];//сюда подставляем имя контроллера
                    $ContrAct[1]=$value->Categories->ServControllersAction['name'];//сюда подставляем имя акции
                    $tListActionCategory[$value['catid']]=$ContrAct;//записываем все в массив
                }
                foreach($tListActionCategory as $row=>$value){//проверить если выходной массив не содержит подобного то дописать
                    if(!isset($out[$row]))
                        $out[$row]=$value;
                }
//            }
//            else{// если же роль есть - переберем все роли пользователя и назначим права
            $test=1;// теперь переберем все назначенные роли текущему пользователю и назначим права
            for($i=0;$i<=31;$i++){       //организуем цикл по 32 разрядам числа $role
                $irole=$role&$test;     //выделяем очередной бит (роль)
                $test=$test<<1;         //сдвигаем бегущую тестовую единичку
                if($irole){             //если у пользователя данная роль определена, 
                    //$ListCategoryUser[$row]=$value['category'];//наверное можно заменить на irole
                    $ec=ServCatCat::model()
                            ->with('Categories.ServControllers',
                                    'Categories.ServControllersAction'
                            )
                            ->findAll('srv_catid=:srv_catid',
                                    array(':srv_catid'=>$irole//$ListCategoryUser[$row]
                                    )
                            );
                        //теперь в $ec список id из таблицы меню categories
                    foreach($ec as $row=>$value){
                        $ContrAct[0]=$value->Categories->ServControllers['name'];//сюда подставляем имя контроллера
                        $ContrAct[1]=$value->Categories->ServControllersAction['name'];//сюда подставляем имя акции
                        $tListActionCategory[$value['catid']]=$ContrAct;//записываем все в массив
                    }
                    foreach($tListActionCategory as $row=>$value){//проверить если выходной массив не содержит подобного то дописать
                        if(!isset($out[$row]))
                            $out[$row]=$value;
                    }
                }
            }
 //           }
        }
        Yii::app()->user->setState('enactions',$out);//запишем все акции и контроллеры в сессию
    }//end
    
    // процедура определения, возможно ли конкретное действие конкретному контроллеру текущему пользователю
    public function EnableForCurrentUser($controller,$action){
        if(Yii::app()->user->getState('sup')) return true;
        // доделать!!!!!!!!!!!!!
        foreach($this->ActionsForUser($controller) as $row=>$value){
            if($value == $action){
                return true;
            }
        }
        return false;
    }

    public function  GetDaysBetween($date1 , $date2){
        if($date2==0) return '-';
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2)->days;
        if($datetime1>$datetime2) $interval=-$interval;
        return $interval;
    }
    //Функция вычисления разности между сегодня и даты из параметра
    //вход: $date - дата
    private function  GetDaysFromNowAndDate($date){
        $date=getdate(strtotime($date));
        $now=getdate();
        return ($date[0]-$now[0]);
    }
    //Функция почтовой раасылки
    public function Send_Email(
            $userid,                                                            //кому
            $userid_copy=0,                                                     //кому копии
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
            $adresat[]=$value->GetUsersFIO($row);
            Yii::app()->mailer->AddAddress($value->GetUsersEmail($row));
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
                            array('value'=>$value,
                               // 'project'=>SmkProjects::model()->findByPk($value->projectid)
                            ),
                            true
                        )       
                    ),
                    true
                ),
                "CP1251",
                "UTF-8"
            );
        Yii::app()->mailer->Send();
    }   
}
?>
