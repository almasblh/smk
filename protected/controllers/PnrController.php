<?php

class PnrController extends CAssaController
{
    protected $dataProvider;
    public $layout='//layouts/column2';//использование второй колонки
    
    /*protected function getDataProvider(){
        $count=Yii::app()->db->createCommand("SELECT COUNT(*) FROM pnr_main;")->queryScalar();
        $sql="SELECT * FROM pnr_main;";
  
        $this->dataProvider=new CSqlDataProvider($sql, array(
                            'totalItemCount'=>$count,
                            'sort'=>array(
                                'attributes'=>array(
                                    'id', 'name', 'descr',
                                ),
                            ),
                            'pagination'=>array(
                            'pageSize'=>10,
                            ),
                    ));
    }
     * 
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
    
    public function actionAdd()
	{
		$this->render('add');
	}

	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
            $model=new PnrMain('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PnrMain']))
                    $model->attributes=$_GET['PnrMain'];

            $this->render('index',array(
                    'model'=>$model,
            ));
	}

	public function actionList()
	{
		$this->render('list');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}