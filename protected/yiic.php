<?php
$yiic='/var/www/yii/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';
define('YII_DEBUG',true);
define('YII_ENABLE_ERROR_HANDLER', true);
define('YII_ENABLE_EXCEPTION_HANDLER', true);

require_once($yiic);
Yii::createConsoleApplication($config)->run(); 