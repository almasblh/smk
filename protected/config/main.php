<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'СМК',
    'preload'=>array('log'),
    'sourceLanguage'=>'ru',
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.extensions.PHPExcel.Classes.PHPExcel',                     //импорт библиотеки PHPExcel
        'application.extensions.gantti.gantti',                                 //импорт библиотеки gantti
        //'application.extensions.SimpleHTMLDOM.SimpleHTMLDOM'
    ),
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            'ipFilters'=>array('172.16.23.254','::1'),
        ),
    ),
    'components'=>array(
        'cache' => array(
//           'class' => 'system.caching.CApcCache',
            'class' => 'system.caching.CFileCache',
//            'class' => 'system.caching.CDummyCache',
        ),  
/*        'cache'=>array(
            'class'=>'system.caching.CMemCache',
           'servers'=>array(
                array('host'=>'localhost', 'port'=>11211, 'weight'=>60),
            ),
        ),
 * 
 */
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            //'pathLayouts' => 'application.views.email.layouts',
            'params'=>array(
                'smtp' => array(
                       "host" => 'smtp-nn.sintek-nn.ru',                        //smtp сервер
                       "debug" => 0,                                            //отображение информации дебаггера (0 - нет вообще)
                       "auth" => true,                                          //сервер требует авторизации
                       "port" => 25,                                            //порт (по-умолчанию - 25)
                       "username" => "",                                        //имя пользователя на сервере
                       "password" => "",                                        //пароль
                       "addreply" => "",                                        //ваш е-mail
                       "replyto" => "",                                         //e-mail ответа
                       "fromname" => "smk",                                     //имя
                       "from" => 'smk@sintek-nn.ru',                            //от кого
                       "charset" => "utf-8",                                    //от кого
                   ),
            ),
         ),
        'user'=>array(
            'allowAutoLogin'=>true,                                             // enable cookie-based authentication
        ),
        //'viewRenderer'=>array(
        //    'class'=>'application.extensions.Smarty.CSmartyViewRenderer',
        //    'fileExtension' => '.tpl',
            //'pluginsDir' => 'application.smartyPlugins',
            //'configDir' => 'application.smartyConfig',
        //),
        // uncomment the following to enable URLs in path-format
        /*
        'urlManager'=>array(
                //'urlFormat'=>'path',
                'rules'=>array(
                        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                ),
        ),
         * 
         */
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=smk',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'username' => 'smk',
            'password' => 'Smk12345',
            'charset' => 'utf8',
            'schemaCacheID'=>'cache',
            'schemaCachingDuration'=>360,
        ),
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),

/*        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                        'class'=>'CWebLogRoute',
                        'levels'=>'trace',
                ),
            ),
        ),
 * 
 */
        'widgetFactory'=>array(
            'widgets'=>array(
                'CDetailView'=>array(
                    'cssFile'=>'css/dview.css',
                ),
                'CGridView'=>array(
                    'cssFile'=>'css/cview.css',
                ),
/*                'CJuiDialog'=>array(
                    'cssFile'=>'css/uidialog.css',
                ),
 * 
 */
            ),
        ),
    ),
    'params'=>array(
        'adminEmail'=>'maslov.alexander@sintek-nn.ru',
        'postsPerPage' => 32,
        'charset' => 'utf-8',
        )
    /*
    // Handling Session
    'session' => array (
        'sessionName' => 'SMK Session',
        'class'=>'CHttpSession',
        'useTransparentSessionID'=>($_POST['PHPSESSID']) ? true : false,
        'autoStart' => 'true',
        'cookieMode' => 'only',
        'savePath' => $_SERVER['DOCUMENT_ROOT'] .'/sessions/',
        //'timeout' => 300
    )
     * 
     */
);