<?php

class KonstrucktorController extends CAssaController
{
	public $layout='//layouts/column2';
        
    private function manufactur_save($newelement,$Name){
        if($Name=="") $newelement->manufactureid=1;//если производителя нет в КД то установим любого производителя - id=1
        else{//ИНАЧЕ
            $manufactor=ReestrElementManufacture::model()->findAll();//возмем список всех производителей
            $find=false;//сброс признака производитель найден в базе
            foreach($manufactor as $row=>$value){//поищем производителя в базе по имени
                if($value['name']==$Name) {
                    $newelement->manufactureid=$value->id;//если производитель найден - то запишем его
                    $find=true;//и установим признак - производитель есть в базе
                    break;
                }
            }
            if(!$find){//если призводителя нет в базе тонадо его туда записать
                $newmanufactur = new ReestrElementManufacture();//сформируем новую модель призводителя
                $newmanufactur->name=$Name;//запишем его имя
                //$newmanufactur->caption=$Caption;
                $newmanufactur->save();//и сохраним в базе
                $newelement->manufactureid=$newmanufactur->id;//и запишем его идентификатор
            }
        }
        return $newelement;//вернем модель с идентификатором производителя
    }

    private function element_save($model,$p_n,$caption,$referens,$manufacture){
        $find=false;
        $elements=Elements::model()->findAll();
        foreach($elements as $row=>$value){
            if($value['p_n']==$p_n) {
                $model->elementid=$value['id'];
                $find=true;
                break;
            }
        }
        if(!$find){//если элемента нет в базе то надо его туда записать
            $newelement = new Elements();
            $newelement->p_n=$p_n;
            $newelement->caption=$caption;
            $newelement->referens=$referens;
            $this->manufactur_save($newelement,$manufacture);// запишем призводителя в базу
            $newelement->save();//и сохраним новый элемент в базе
            $model->elementid=$newelement->id;
            //$elements=Elements::model()->findAll();
        }
        return($model);
    }
    
    private function assemble_save($model,$Refdes,$AssembleName,$Ninassemble){
        if($AssembleName<>"") {//если в файле есть информация о сборке то
            $find=false;//сбр признак найден в базе
            $assemble=ReestrAssemblageName::model()->findAll();//определить модель сборок
            foreach($assemble as $row=>$value){//производим поиск сборки в базе
                if($value['name']==$AssembleName) {
                    $model->assemblegid=$value['id'];//если нашли то записываем id сборки
                    if($Ninassemble<>"")   $model->ninassenblege=$Ninassemble;//если в КД есть номер в сборке то пишем его
                    else{//иначе
                        $a=explode('_',$Refdes);//берем в refdes последний элемент - это и есть номер в сборке
                        $model->ninassenblege=$a[count($a)-1];
                    }
                    $find=true;//и установим признак нашли в базе
                    break;
                }
            }
            if(!$find){//если сборки нет в базе то надо ее туда записать
                $newassemble = new ReestrAssemblageName();
                $newassemble->name=$AssembleName;
                $newassemble->save();
                $model->assemblegid=$newassemble->id;//и присвоить ид новой сборки
                if($Ninassemble<>"")   $model->ninassenblege=$Ninassemble;//если в КД есть номер в сборке то пишем его
                else{//иначе
                    $a=explode('_',$Refdes);//берем в refdes последний элемент - это и есть номер в сборке
                    $model->ninassenblege=$a[count($a)-1];
                }
                //$assemble=ReestrAssemblageName::model()->findAll();//и переопределить модель сборок
            }
        }
        return $model;
    }
    
    private function part_save($model,$Part){
        if($Part<>"") {//если в файле есть информация о часть 1 то
            $datpart=explode(',',$Part);//разберем данные
            if(isset($datpart[1]) && $datpart[1]<>"") {//есть p/n - значит это элемент - распарсим
                foreach($datpart as $row=>$value){
                    $datpart[$row]=iconv('windows-1251','utf-8',$value);
                }
                $this->element_save($model
                        ,$datpart[1] //$p_n
                        ,$datpart[0] //$caption
                        ,$datpart[3] //$referens
                        ,$datpart[2] //$manufacture
                );//запишем элемент
            }
        }
        return $model;
    }

    public function filters(){
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
    
    public function actionIndex(){
        $model=0;
        $this->render('index',array(
                'model'=>$model,
        ));
    }
    
    public function actionCreate(){
        if(Yii::app()->request->isAjaxRequest){
            
        }
        if(isset($_POST['KdCollectionTemp'])){                                  //если есть что-то из формы, то переходим к обработке
//            $pars_error=0;                                                    //сброс признака ошибки парсинга
            $model=KdCollectionTemp::model()->findAll();                        //парсинг BOM файла по конкретному проекту, запись в базу
            foreach($model as $row){                                            //для начала очистим таблицу парсинга
                $row->delete();                                                 
            }
            $model=new KdCollectionTemp();                                      //создадим модель
            $BOMfile = CUploadedFile::getInstance($model,'BOMfile');            //загружаем файл во временную папку
            if(isset($BOMfile)){                                                //при удачной загрузке
                $f = fopen($BOMfile->tempName, 'r');                            //открываем файл
                $file_attr=fgetcsv($f, 1000, ',');                              //читаем самую первую строку - заголовки столбцов
                foreach($file_attr as $row=>$value){                            //далее читаем все строчки файла последовательно
//вставить ajax функцию вывода прогресса парсинга в класс progress
//$a='function() {$("#progress").load($i++);return false;}';
//echo CHtml::textField('progress', $model->progress++);
//echo CHtml::encode($model->progress++);
                    $conv=iconv('windows-1251','utf-8',$value);                 //меняем кодировку на UTF-8
                    $bd_attr = ReestrKdAtributes::model()                       //загружаем в модель аттрибутов все возможные аттрибуты, какие есть в базе
                        ->find('caption=:cond', array(':cond'=>$conv));
                    if(isset($bd_attr))                                         //при удачной загрузке
                        $rname[$bd_attr->name]=$row;                            //формируем динамический массив, в котором учитываются номер столбца в файле и соответствующий ему атрибут
                    else{                                                       //иначе - формируем строку с ошибкой
                        $model->pars_str_error='Ошибка: Не нйдена таблица аттрибутов в базе. Парсинг невозможен. Свяжитесь с разработчиком';
                    }
                }
                unset($model);                                                  //стираем модель 
                if(!isset($model->pars_str_error)){                             //если ошибок парсинга аттрибутов не найдено то продолжаем
                    while(!feof($f)){                                           //пока не закончился файл
                        $data = fgetcsv($f, 1000, ',');                         //читаем новую строку из файла
                        if((isset($data[$rname['P/N']]) && $data[$rname['P/N']]<>"")//если есть p/n
                                ||
                            (isset($data[$rname['Part1']]) && $data[$rname['Part1']]<>"")// или есть часть 1
                        ) {                                                     //значит это элемент - распарсим
                            foreach($data as $row=>$value){
                                $data[$row]=iconv('windows-1251','utf-8',$value);
                            }
                            $model=new KdCollectionTemp();
                            $model->attributes=$_POST['KdCollectionTemp'];
                            $model->refdes=$data[$rname['RefDes']];             //запишем refdes
                            $a=explode('/',$model->refdes);
                            if($a[0]=='X1' && isset($a[1])){
                                $c=explode('_',$a[1]);
                                $b=explode('A',$c[0]);
                                $model->bascet=$b[1];
                                $model->ninbascet=$c[1];
                                $model->nio=$c[2];
                                $modtmp = KdCollectionTemp::model()
                                    ->with('Elements')
                                    ->find('refdes=\''.$c[0].'_'.$c[1].'\'');
                                if(isset($modtmp))
                                    $model->note=$modtmp->Elements->p_n;
                                else {$model->pars_str_error.=                  //не нашли модуля - ошибка в КД - надо сказать об этом конструктору
                                        'Ошибка: Не найден модуль '
                                        .$c[0].'_'.$c[1]
                                        .'. Провеоьте КД </br>';
                                }
                            }
                            $model->type=$data[$rname['Type']];                 //запишем тип
                            $this->element_save($model                          //запишем элемент
                                    ,$data[$rname['P/N']]
                                    ,$data[$rname['Name']]
                                    ,$data[$rname['Referens']]
                                    ,$data[$rname['Manufactured']]
                                );  
                            $this->assemble_save($model                         //запишем информацию о сборке
                                    ,$data[$rname['RefDes']]
                                    ,$data[$rname['Assemble']]
                                    ,$data[$rname['Ninassemble']]
                                );          
                            if(isset($rname['Part1']))  $this->part_save($model //зпишем 1-ю часть
                                    ,$data[$rname['Part1']]
                                );                                  
                            if(isset($rname['Part2']))  $this->part_save($model //зпишем 2-ю часть
                                    ,$data[$rname['Part2']]
                                );                                  
                            if(isset($rname['Part3']))  $this->part_save($model //зпишем 3-ю часть
                                    ,$data[$rname['Part3']]
                                );                                  
                            if(isset($rname['Symbol']))  $model->symbol=$data[$rname['Symbol']];            //запишем символ
                            if(!$model->note && isset($rname['Note'])) $model->note=$data[$rname['Note']];  //запишем Примечание
                            if(isset($rname['Nominal']))  $model->nominal=$data[$rname['Nominal']];         //запишем номинал

                            if(isset($rname['SignalStart'])) $str=$data[$rname['SignalStart']];
                            if(isset($rname['SignalPart1'])) $str.=' '.$data[$rname['SignalPart1']];
                            if(isset($rname['SignalPart2'])) $str.=' '.$data[$rname['SignalPart2']];
                            if(isset($rname['SignalPart3'])) $str.=' '.$data[$rname['SignalPart3']];
                            if(isset($rname['SignalEnd'])) $str.=' '.$data[$rname['SignalEnd']];
                            if(isset($str)) $model->chanelname=trim($str);      //если есть канал, то запишем Канал
                            if(!$model->save())                                 //если запись НЕ удалась, 
                                $model->pars_str_error                          //то надо вывести предупреждение, что запись не удалась
                                    .='Не удалась запись c RefDes = '
                                    .$data[$rname['RefDes']]
                                    .' Проверьте КД.</br>';
                        }//конец условия это элемент - распарсим
                    }//конец цикла парсинга файла
                }//конец условия если ошибок парсинга аттрибутов не найдено
                if(!isset($model->pars_str_error)){                             //если ошибок парсинга нет, значит все получилось и надо переписать в основную таблицу kdKollection
                    if($model->lastKD>2){                                               //если версия КД больше 2, то
                        $model=KdCollection::model()
                            ->findAll(array('condition'=>'version='.$model->lastKD-1));   //надо найти записи в таблице kdKollection с версией КД меньшей lastKD
                        foreach($model as $row){                                //и удалить их все
                            $row->delete();                                                 
                        }
                    }
                    $model=KdCollection::model()
                        ->findAll(array('condition'=>'version='.$model->lastKD));//найти записи в таблице kdKollection с версией КД = lastKD
                    foreach($model as $row=>$value){                            //и зделать их неактивными
                        $value->actual=0;
                        $value->save();
                    }                    
                    $modeltemp=KdCollectionTemp::model()->findAll();            //сформировать модель из временной таблицы со всеми записями
                    foreach($modeltemp as $row=>$value){                        //организовать цикл по всем записям модели временной таблицы
                        $model=new KdCollection();                              //создать модель новой таблицы
                        //$a=$value->attributes;
                        $model->attributes=$value->attributes;                  //сохранить все атрибуты временной модели в новой модели
                        $model->refdes=$value->refdes;
                        $model->prunitid=$_GET['id'];//$value->prunitid;        //сохранить информацию о номере шкафа
                        $model->actual=1;                                       //дополнить новую модель полями ver,datecreate,signaturecreator
                        $model->datecreate=date("Y-m-d H:i:s", time());         //запишем дату создания
                        $model->signaturecreator=Yii::app()->user->id;          //запишем создателя
                        $model->version=$model->lastKD+1;                       //запишем версию
                        if(!$model->save()){                                    //если не удалась запись в новую модель
                            $pars_str_error                                     //то надо вывести предупреждение, что запись не удалась
                                ='Не удалась перезапись данные из временной в основную таблицу. '
                                .'Обратитесь к разработчику.</br>';
                            break;                                              //и преравть цикл
                        }
                    }
                    $modproject=SmkProjectUnits::model()                        //наконец надо в таблицу smk_project_units
                        ->find(array('condition'=>'id='.$model->prunitid));     //записать информацию о последней версии КД
                    $modproject->lastKD=$model->version;
                    $modproject->save();
                    
                }//конец цикла записи таблицы kdKollection
                if(!isset($model->pars_str_error)
                        &&
                    !isset($pars_str_error)){                                   //окончательно проверяем все ошибки
                    $this->redirect(CHtml::normalizeUrl(array('index')));       //и если их нет то переходим в индекс
                }
                else{                                                           //Ошибки есть - надо вывести форму с описанием найденных ошибок $pars_str_error
                    $model=new KdCollectionTemp();
                    $model->pars_str_error=$pars_str_error;
                    $this->render('create',array(
                            'model'=>$model,
                    ));
                }
            }//конец условия при удачной загрузке BOM-файла
        }//конец обработки формы
        else{
            $model=new KdCollectionTemp();
            $model->prunitid=$_GET['id'];
            $model->lastKD=$_GET['lastKD'];
            $this->render('create',array(
                'model'=>$model,
                'unitid'=>$_GET['unitid']
                )
            );
        }
    }
}