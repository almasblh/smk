<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'СМК',
    'sourceLanguage'=>'ru',    
    'preload'=>array('log'),
    'import'=>array(
            'application.models.*',
            'application.extensions.*',
            'application.components.*',
          ),
    'components'=>array(
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
        'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=smk',
                'emulatePrepare' => true,
                'enableProfiling' => true,
                'enableParamLogging' => true,
                'username' => 'smk',
                'password' => 'Smk12345',
                'charset' => 'utf8',
             //   'schemaCacheID'=>'cache',
             //   'schemaCachingDuration'=>3600,
        ),
    ),
);