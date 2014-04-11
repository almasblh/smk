<?php

class EnabledFormsShow {

    //метод нахождения разрешенных акций для конкретного контроллера текущего пользователя
    // на входе:
    //          $ControllerId - идентификатор контроллера из таблицы serv_controllers базы СМК
    // на выходе:
    //          $f - список разрешенных акций (подставляем в accessRules() вызывающего контроллера)
    public function ActionsForUser($ControllerName){

        $cn=explode('Controller',$ControllerName);
        //делаем выборку из таблицы категорий меню по конкретному контроллеру
        $d=Categories::model()->with('ServControllersAction','ServControllers')
            ->findAll('ServControllers.name=:par',array(':par'=>$cn[0]));
//            ->findAll('controllerid=:par',array(':par'=>$ControllerId));
        
        //делаем список e всех разрешенных акций для данного контроллера (без привязки к пользователю)
        foreach($d as $row=>$value){
            $e[$value['id']]=$value->ServControllersAction['name'];
        }
        //делаем выборку по категориям пользователей в привязной таблице к меню
        $a=ServCatCat::model()->findAll('srv_catid=:srv_catid',
                                        array(':srv_catid'=>Yii::app()->session['catid']
                                        ));
        //
        foreach($a as $row=>$value){$b[$row]=$value['catid'];}
        $i=0;
        //формируем список разрешенных акций для категории пользователей, к которой принадлежит текущий пользователь
        foreach($b as $row=>$value){
            if(isset($e[$value])) $f[$i++]=$e[$value];
        }
        //делаем выборку по текущему пользователю в привязной таблице к меню
        $a=ServCatUser::model()->findAll('srv_userid=:srv_userid',
                                        array(':srv_userid'=>Yii::app()->session['uid']
                                        ));
        //
        foreach($a as $row=>$value){$c[$row]=$value['catid'];}
        if(isset($c)){                      //если есть хотя-бы один элемент в списке c, то
            //формируем список разрешенных акций для текущего пользователя
            $j=0;
            foreach($c as $row=>$value){
                if(isset($e[$value])) $g[$j++]=$e[$value];
            }
            if(isset($g)){                  //если есть хотя-бы один элемент в списке g - то объединяем списки
                $l=$i;                      //запомним максимальный индекс списка f
                foreach($g as $g1){         //для каждого элемента списка g
                    $sovp=false;            //сброс признака совпадения
                    for($k=0;$k<$l;$k++){   //цикл по всему списку f
                        if($f[$k]===$g1){   //ищем совпадение элемента из списка g в списке f
                            $sovp=true;     //если совпадение есть - выставляем признак 
                            $k=$l;          //и заканчиваем рабооту цикла
                        }
                    }
                    if(!$sovp) $f[$i++]=$g1;//если совпадений не было найдено, то дополняем список f новым значением акции 
                }
            }
        }
        if(!isset($f)) $f=array('_');
        return $f;//на выходе - список разрешенных акций для контроллера и пользователя
    }
}