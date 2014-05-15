<?php

class SmkProjectsController extends CAssaController
{
    public $layout='//layouts/column2';

    public function filters(){
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
/*            array(
            'COutputCache',
            'duration'=>30,
            'varyByParam'=>array('id'),
            ),
 * 
 */
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

        
        public function actionView($id=0)
	{
            $test=Yii::app()->user->getState('activeproject');
            if($id>0)//если есть ид - то запишем новый активный проект
                if($id<>$test)
                    $this->ActiveProjectSessionSave($id);
            else{
                if(isset($test))//если нет ил но есть активный проект то используем его как ид
                     $id=$test;
                else
                    return;//здесь надо вывести ошибку что ничего нет exeption!!!!!!!
            };
            
            if( isset($_GET['projectstep'])                                     //записать активный этап
                && $_GET['projectstep']>0
                    && $_GET['projectstep']<>Yii::app()->user->getState('activeprojectstep')
            )   $this->ActiveProjectStepSessionSave($_GET['projectstep']);
            //$steps_model=$this->loadModelSteps($id);                            //загрузка модели с этапами для данного проекта
            if(isset($_GET['email'])){
                switch($_GET['email']){
                    case 1:
                        Yii::app()->db->createCommand('INSERT INTO smk_project_email_list (userid,projectid) VALUES ('.Yii::app()->user->id.','.$id.');')->query();
                        break;
                    case 0:
                        Yii::app()->db->createCommand('DELETE FROM smk_project_email_list WHERE userid='.Yii::app()->user->id.' AND projectid='.$id.';')->query();
                        break;
                }
            }
            $model=SmkProjects::model()->findByPk($id);                         // загрузка модели проекта
            if(isset($_GET['gantti']) && $_GET['gantti']=='view'){
//                if($model->approved==0){                                            // если план не утвержден
//                    Yii::app()->cache->delete('SmkProjectsGant'.$model->id);        // то сбросить кеш для диаграммы Ганта для проекта
//                };
//                if(Yii::app()->cache->get('SmkProjectsGant'.$model->id)===false){   // Если кеша нет, то надо вновь просчитать диаграмму Ганта
                    $stepName=SmkProjectStepName::model()->findAll();
                    foreach($model->SmkProjectStep() as $row=>$value){
                        $data[] = array(
                            'label' => '(План) '.$stepName[$value['stepid']-1]->name,
                            'start' => $value['datestart'], 
                            'end'   => $value['datestop'],
                        );
                        if(isset($value['datestopfact'])) $class='stop';
                        elseif(isset($value['datestartfact'])) $class='start';
                        else $class='nostart'; 
                        $data[] = array(
                            'label' => '..........(Факт)',
                            'start' => isset($value['datestartfact'])?$value['datestartfact']:$value['datestart'], 
                            'end'   => isset($value['datestopfact'])?$value['datestopfact']:$value['datestart'],
                            'class' => $class,
                        );                
                    }
                    if(isset($data)){                                               // если данные есть - формируем класс
                        $gantti = new gantti($data, array(
                          'title'      => 'Этапы',
                          'cellwidth'  => 20,
                          'cellheight' => 22
                        ));
                    }
                    else $gantti = '';                                              // иначе - формируем пустышку
//                    Yii::app()->cache->set('ElBezQoestions-quest', $gantti);
//                }
                $this->renderPartial('gantti',array(                      //отрендерим и запишем в переменную $value
//                    'model'=>$model,
                    'gantti'=>$gantti,
                    )
                );
                Yii::app()->end();
            }
/*                
            if($model->approved==0){                                            // если план не утвержден
                Yii::app()->cache->delete('SmkProjectsGant'.$model->id);        // то сбросить кеш для диаграммы Ганта для проекта
            };
            if(Yii::app()->cache->get('SmkProjectsGant'.$model->id)===false){   // Если кеша нет, то надо вновь просчитать диаграмму Ганта
                $stepName=SmkProjectStepName::model()->findAll();
                foreach($model->SmkProjectStep() as $row=>$value){
                    $data[] = array(
                        'label' => '(План) '.$stepName[$value['stepid']-1]->name,
                        'start' => $value['datestart'], 
                        'end'   => $value['datestop'],
                    );
                    if(isset($value['datestopfact'])) $class='stop';
                    elseif(isset($value['datestartfact'])) $class='start';
                    else $class='nostart'; 
                    $data[] = array(
                        'label' => '..........(Факт)',
                        'start' => isset($value['datestartfact'])?$value['datestartfact']:$value['datestart'], 
                        'end'   => isset($value['datestopfact'])?$value['datestopfact']:$value['datestart'],
                        'class' => $class,
                    );                
                }
                if(isset($data)){                                               // если данные есть - формируем класс
                    $gantti = new gantti($data, array(
                      'title'      => 'Этапы',
                      'cellwidth'  => 20,
                      'cellheight' => 22
                    ));
                }
                else $gantti = '';                                              // иначе - формируем пустышку
                Yii::app()->cache->set('ElBezQoestions-quest', $gantti);
            }
 * 
 */
            $btnDefectColor=((Yii::app()->db->createCommand(                    //цвет кнопки Журнал дефектов
                'SELECT((SELECT count(id) FROM defects_book db WHERE db.laststate=0 AND db.projectid='.$id.')/(SELECT count(id) FROM defects_book db WHERE db.projectid='.$id.')) as "col";'
            )->queryRow()['col']));
            $btnDefectColor=(isset($btnDefectColor) && $btnDefectColor<1)?'red':'';
            if(Yii::app()->request->isAjaxRequest){
                echo $value=$this->renderPartial('view',array(                      //отрендерим и запишем в переменную $value
                    'model'=>$model,
                    //'gantti'=>$gantti,
                    'btnDefectColor'=>$btnDefectColor
                    ),
                    true,
                    true
                );
                Yii::app()->cache->delete('SmkProjectSectionValue');                //Запишем в кеш, предварительно очистив его от старого содержимого
                Yii::app()->cache->set('SmkProjectSectionValue',$value);
            }
            else{
                $this->render('view',array(                      //отрендерим и запишем в переменную $value
                    'model'=>$model,
                    //'gantti'=>$gantti,
                    'btnDefectColor'=>$btnDefectColor
                    )
                );
            }
        }
       
	public function actionCreate($id=0)                                     //создание нового проекта
	{
                if($id<>0){                                                     //если id не равно нулю - значит менеджер хочет утвердить план
                    $model=$this->loadModel($id);
                    $model->signaturemanager=Yii::app()->user->id;
                    $model->lastcorrection+=1;
                    $model->date_make=date("Y-m-d H:i:s", time());
                    $model->update();
                    $this->redirect(array('view','id'=>$id));
                }
		$model=new SmkProjects;
		if(isset($_POST['SmkProjects']))                                //если форма заполнена - приступим к обработке
		{
			$model->attributes=$_POST['SmkProjects'];               //записать все атрибуты из формы в модель
                        //$model->managerid=Yii::app()->user->id;                 //записать текущего пользователя в менеджеры проекта (спорное утверждение надо подумать)
                        $model->signaturecreator=$a=Yii::app()->user->id;       //подпись создателя записи
                        if($model->date_make==0)                                //если проект создается вновь, то
                            $model->date_make=date("Y-m-d H:i:s", time());      //записать время создания проекта
                        $model->datecreaterecord=$model->date_make;             //время создания записи
                        
			if($model->save()) {                                     //если сохранение проекта прошло успешно, то
                            $modelcurator=new ServUsersRole;                    //запишем в таблицу ролей новоиспеченного куратора
                            $modelcurator->userid=$model->kuratorid;
                            $modelcurator->projectid=$model->id;
                            $modelcurator->category=1024;
                            $modelcurator->signaturecreator=$model->signaturecreator;
                            $modelcurator->datecreaterecord=$model->datecreaterecord;
                            if($modelcurator->save())                            //при удачной записи в таблицу ролей
                                $modelmanager=new ServUsersRole;                    //запишем в таблицу ролей новоиспеченного куратора
                                $modelmanager->userid=$model->managerid;
                                $modelmanager->projectid=$model->id;
                                $modelmanager->category=512;
                                $modelmanager->signaturecreator=$model->signaturecreator;
                                $modelmanager->datecreaterecord=$model->datecreaterecord;
                                if($modelmanager->save())                            //при удачной записи в таблицу ролей
                                    $this->redirect(array('view','id'=>$model->id));//перейти на страницу проекта
                        }
                        //иначе - показать форму ошибки формирования проекта
                        $this->render('_form',array(
                            'model'=>$model,
                        ));
                        //Yii::app()->end();
		}
		$this->renderPartial('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id=0)                                     // обновление данных по проекту
	{
            $a=Yii::app()->user->getState('activeproject');
            if($id==0 && !isset($a)) return;                                    //если номера пректа нету или у пользователя не выбран активный проект, то выходим
            else if($id==0 && isset($a)) $id=$a;                                //если номера пректа нету, но у пользователя есть активный проект, то присвоим активный проект номеру проекта
            $model=$this->loadModel($id);                                       //загрузим иодель проектов с текущим проектом
            $kurator_old=$model->kuratorid;                                     //на всякий случай запомним старого куратора

            if(isset($_POST['SmkProjects'])){                                   //если форма заполнена - то приступим к обработке
                $model->attributes=$_POST['SmkProjects'];                       //запишем все доступные атрибуты из формы в модель
                $model->signaturecreator=Yii::app()->user->id;                  //запишем подпись создателя
                $model->datecreaterecord=date("Y-m-d H:i:s", time());           //и дату создания записи
                if($model->save()){                                             //если модель успешно сохранилась, то необходимо проверить есть ли у этого проекта уже куратор
                    $modelRole=ServUsersRole::model()                           //для этого - создадим новую модель ролей пользователей
                        ->find(array('condition'=>
                            'projectid='.$model->id                             // для проекта из модели проекта
                            .' and userid='.$kurator_old                        //для старого куратора
                            //.' and projectstepid='
                            //.' and datestop<>01012100000000'                    //чтобы у него были открыты права на данную
                            .' and category=1024')                              //категорию - куратор проекта                
                        );
                    if(!isset($modelRole->userid)){                             //если нет - то в таблице ролей зделать запись о назначении куратора
                        $modelRole = new ServUsersRole();
                        $modelRole->userid=$model->kuratorid;
                        $modelRole->projectid=$model->id;
                        $modelRole->category=1024;
                        $modelRole->datestart=date("Y-m-d H:i:s", time());
                        $modelRole->signaturecreator=Yii::app()->user->id;
                        $modelRole->datecreaterecord=$modelRole->datestart;
                        $modelRole->save();
                    }
                    else{                                                       //если есть, но это тотже самый, что и был до модификации формы - то ничего не делать
                        if($kurator_old<>$model->kuratorid){                    //если это другой человек, то нужно зделать следующие шаги
                            $modelRole = new ServUsersRole();                   //1. зделать запись в таблице о назначении нового куратора
                            $modelRole->userid=$model->kuratorid;
                            $modelRole->projectid=$model->id;
                            $modelRole->category=1024;
                            //$modelRole->datestart=date("Y-m-d H:i:s", time());
                            $modelRole->signaturecreator=Yii::app()->user->id;
                            $modelRole->datecreaterecord=date("Y-m-d H:i:s", time());
                            $modelRole->save();
                        }
                                                                                //2. закрыть роль старому куратору
                        $modelRole=ServUsersRole::model()                       //для этого - создадим новую модель ролей пользователей
                            ->find(array('condition'=>
                                'projectid='.$model->id                         // для проекта из модели проекта
                                .' and userid='.$kurator_old                    //для старого куратора
                                //.' and projectstepid='
                                //.' and datestop<>01012100000000'                //чтобы у него были открыты права на данную
                                .' and category=1024')                          //категорию - куратор проекта
                            );
                        //$modelRole->datestop=date("Y-m-d H:i:s", time());       //запишем дату окончания роли
                        $modelRole->signaturecreator=Yii::app()->user->id;      //подпись создателя
                        $modelRole->datecreaterecord=date("Y-m-d H:i:s", time());      //и дату создания записи
                        $modelRole->save();                        
                    }
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
            //секция согласования проекта
            elseif (isset($_GET['par']) && isset($_GET['ok'])){
                $par=($_GET['ok']==0)?0:$_GET['par'];
                $query='call smkProjectSignatureUpdate('.$_GET['id'].',\''.$_GET['par'].'\','.$_GET['ok'].');';
                Yii::app()->db->createCommand($query)->query();
                $model=$this->loadModel($id);
                $this->redirect(array('view','id'=>$model->id));
            }
            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_form',array(
                        'model'=>$model,
                ));
            }
            else{
                $this->render('update',array(
                        'model'=>$model,
                ));
            }
	}

	public function actionDelete($id)
	{
            $this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
        public function actionIndex(){
            $model=new SmkProjects('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['SmkProjects']))
                $model->attributes=$_GET['SmkProjects'];
            $this->render(
                    'index',array(
                    'model'=>$model,
                )
            );
	}
        
    public function actionOtchets($id=0,$ncorrection=0){                        //модуль создания отчетов по внутренним испытаниям отдела испытаний
        if(isset($_GET['sw'])){                                                 //обработка кнопок (селектируются по параметру sw)
            switch($_GET['sw']){
                case 'pgvr':                                                    //если требуется вывести отчет по плану ПГВР
                    //начальные присвоения переменным
                    $row=$rightbuttom=$leftup=$first_week=$last_week=0;

                    $project = SmkProjects::model()->findByPk($id);             //модель проекта
                    $steps = SmkProjectStep::model()
                        ->findAll(array(
                            'condition'=>
                                'projectid='.$id//.' AND ncorrect='.$ncorrection
                        )
                    );                                                         //список этапов проекта
                                                
                    $objPHPExcel = new PHPExcel();                              //создаем объект Excel
                    $objPHPExcel = PHPExcel_IOFactory::load(
                        "XLSTemplates/PGVR/Template_PGVR_otchet.xlsx"
                    );                                                          //загружаем шаблон
                    $objPHPExcel->setActiveSheetIndex(0);                       //активируем первый лист
                    $AktSheet = $objPHPExcel->getActiveSheet();                 //формируем объект листа

                    $AktSheet
                        ->setCellValue('A7', 'План-график №'.$project->Npgvr)
                        ->setCellValue('C8', Yii::app()->dateFormatter->format('d MMMM yyyy г.', time()))
                        ->setCellValue('C9', $project->Works)
                        ->setCellValue('C10', $project->customer)
                        ->setCellValue('C11', $project->dogovor)
                        ->setCellValue('C12', $project->object)
                        ->setCellValue('C13', $project->path)
                        ->setCellValue('C14', $project->manager->FIO2)
                        ->setCellValue('C15', $project->kurator->FIO2)
                        ->setCellValue('C16', $ncorrection)
                    ;
                    foreach($steps as $row=>$value){
                        if($row==0){
                            $n_start_week_in_year = (date ("W",strtotime($value->datestart)));//расчет недели начала этапа в году
                            $first_week=$n_start_week_in_year;
                        }
                        $n_start_week_in_year_step = (date ("W",strtotime($value->datestart)))-$n_start_week_in_year;//расчет сдвига по неделям начала этапа относительно начала проекта
                        $n_stop_week_in_year_step = (date ("W",strtotime($value->datestop)))-$n_start_week_in_year;//расчет сдвига конца этапа относительно начала проекта
                        $AktSheet
                           // ->setCellValue($this->Convert(8,18), $n_start_week_in_year) //вывод номера недели
                            ->setCellValue($this->Convert(0,$row+19), $row+1)
                            ->setCellValue($this->Convert(1,$row+19), $value->SmkProjectStepName->name)
                            ->setCellValue($this->Convert(2,$row+19), $project->kurator->FIO2)
                            ->setCellValue($this->Convert(3,$row+19), $value->ServUsersStepCurator->FIO2)
                            ->setCellValue($this->Convert(4,$row+19), Yii::app()->dateFormatter->format('d-MM-yy', $value->datestart))
                            ->setCellValue($this->Convert(5,$row+19), Yii::app()->dateFormatter->format('d-MM-yy', $value->datestop))
                            ->setCellValue($this->Convert(6,$row+19),
                                ($value->current_persent<100)
                                ? ceil($this->GetDaysBetween(date('Y-m-d'),$value->datestop)/$this->GetDaysBetween($value->datestart , $value->datestop)*100)
                                : 100
                            )
                        ;
                        $current_persent=($value->current_persent<100)          //обработка ячейки - сроки выполнения 
                                ? ceil($this->GetDaysBetween(date('Y-m-d'),$value->datestop)/$this->GetDaysBetween($value->datestart , $value->datestop)*100)
                                : 100;
                        $coord=$this->Convert(6,$row+19);
                        $AktSheet
                            ->setCellValue($coord, $current_persent);
                        $color='FF0000';
                        if($current_persent<=0) $color='FF0000';                //если 0 или меньше - красный
                        if($current_persent>=50) $color='FFCC33';               //больше 50% но меньше 90% - желтый
                        if($current_persent>=90) $color='00FF00';               //больше 90% - зеленый                        
                        $AktSheet
                            ->getStyle($coord)               
                                ->applyFromArray(
                                    array(
                                        'fill'=>array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb'=>$color),
                                        ),
                                    )
                                );                        
                        
                        $current_persent=ceil($value->current_persent);         //обработка ячейки - процент выполнения 
                        $coord=$this->Convert(7,$row+19);
                        $AktSheet
                            ->setCellValue($coord, $current_persent);
                        if($current_persent<=0) $color='FF0000';                //если 0 или меньше - красный
                        if($current_persent>=50) $color='FFCC33';               //больше 50% но меньше 90% - желтый
                        if($current_persent>=90) $color='00FF00';               //больше 90% - зеленый
                        $AktSheet
                            ->getStyle($coord)               
                                ->applyFromArray(
                                    array(
                                        'fill'=>array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb'=>$color),
                                        ),
                                    )
                                );

                        for($i=$n_start_week_in_year_step; $i<=$n_stop_week_in_year_step; $i++){
                            $default_border = array(                            //Закраска ячейки цветом:
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                                ,'color' => array('rgb'=>'1006A3')
                            );
                            $style_header = array(
                                'borders' => array(
                                    'bottom' => $default_border,
                                    'left' => $default_border,
                                    'top' => $default_border,
                                    'right' => $default_border,
                                ),
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb'=>'FFCC33'),
                                ),
                            );
                            $AktSheet->getStyle($this->Convert(8+$i,$row+19))   //Закраска ячейки цветом:
                                ->applyFromArray($style_header);
                        }

                        $start=$this->Convert(8+$n_start_week_in_year_step,$row+19);
                        $stop=$this->Convert(8+$n_stop_week_in_year_step,$row+19);
                        $AktSheet
                            ->setCellValue($start, Yii::app()
                                ->dateFormatter
                                    ->format('d-MM-yy', $value->datestart))
                            ->setCellValue($stop, Yii::app()->
                                dateFormatter
                                    ->format('d-MM-yy', $value->datestop));
                        if($row==0) $leftup=$start;//запомнить первую ячейку первого этапа
                        $rightbuttom=$stop;//запомнить последнюю ячейку последнего этапа
                        $last_week=$n_stop_week_in_year_step;
                        
                        $AktSheet->insertNewRowBefore($row+20);                 //вставить новую строчку
                        $AktSheet->getStyle('A'.($row+20).':'.'IV'.($row+20))->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array(
                                        'rgb'=>'FFFFFF'
                                    ),
                                ),
                            )
                        );
                    }//конец цикла
                    
                    for($i=8;$i<=8+$last_week;$i++){
                        $AktSheet->setCellValue($this->Convert($i,18),$first_week+$i-8);
                    }
                    
                    
                    
                    $default_border = array(                            //Закраска ячейки цветом:
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                        ,'color' => array('rgb'=>'0')
                    );
                    $AktSheet->getStyle($leftup.':'.$rightbuttom)->applyFromArray(
                        array(
                            'borders' => array(
                                'bottom' => $default_border,
                                'left' => $default_border,
                                'top' => $default_border,
                                'right' => $default_border,
                            ),
                        )
                    );
                    $AktSheet->setCellValue($this->Convert(17,$row+20+6), $project->kurator->FIO2);//подпись составил специалист ОУП
                    
                    ob_end_clean();
                    ob_start();
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="PGVR"'.$project->Npgvr.'.xls"');
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
                    $objWriter->save('php://output');
                break;
                case 'akt_in_test':                                             //если требуется вывести акт в ексел - то выводим

                break;
            }
        }
    }

        

	public function loadModel($id)
	{
		$model=SmkProjects::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

        public function loadModelSteps($id){
            $model=SmkProjectStep::model(
                    //array(
                    //'select'=>'name',
                    //'condition'=>'t.visible=1',
                    //'order'=>'t.name'
                    //)
                    )->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            else{
                $listKorrection = SmkProjectStep::model()
                        ->findAll(array(
                            'select'=>'DISTINCT ncorrect',
                            'condition'=>'projectid='.$id,
                            'order'=>'ncorrect'
                            )
                        );
                foreach($listKorrection as $row=>$value){
                    $model->listKorrection[$row]=$value->ncorrect;
                }
            }
            return $model;
	}
        
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smk-projects-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    private function Convert($row,$col){
        $min = ord("A");
        $max = ord("Z");
        if(($row+$min)<=$max) $out=chr($row+$min).$col;
        else {
            $iLo=$row%($max-$min);
            $iHi=$row/($max-$min);
            $out=chr($iHi+$min-1).chr($iLo+$min-1).$col;
        }
        return $out;
    }
 
}
