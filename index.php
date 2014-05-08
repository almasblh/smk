<?php
//ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'/sessions/');

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);                      // specify how many levels of call stack should be shown in each log message
defined('YII_DEBUG') or define('YII_DEBUG',true);                               //включили Debug режим


//$yii=dirname(__DIR__).'/yii/framework/yii.php';
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
