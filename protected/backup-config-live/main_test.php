<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'MobiTrust',
    'defaultController' => 'site/index',
    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.giix-components.*',
        'application.extensions.giix-core.*',
        'application.extensions.EWideImage.EWideImage',
        'application.extensions.jqueryte.Jqueryte',
        'zii.widgets.*',
        'zii.widgets.grid.*',
        'zii.widgets.CDetailView',
    ),

    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'ext.giix-core',
            ),
        ),
        'admin',
        'api',
    ),

    // application components
    'components' => array(

        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),

        'frontUser' => array(
            'class' => 'CWebUser',
            'stateKeyPrefix' => 'front_',
            'loginUrl' => array("site/login"),
            'allowAutoLogin'=>true,
        ),
        'admin' => array(
            'class' => 'CWebUser',
            'stateKeyPrefix' => 'backend_',
            'loginUrl' => array("admin/default"),
        ),


        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            // 'caseSensitive' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),

    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);


if ($_SERVER['SERVER_NAME'] == 'localhost') { //localhost -dev setting
    $config['components']['db'] = array(
        'connectionString' => 'mysql:host=localhost;dbname=Mobitrust_v1',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    );
} else { // demo server setting
    $config['components']['db'] = array(
        'connectionString' => 'mysql:host=192.168.1.88;dbname=Mobitrust_v1',
        'emulatePrepare' => true,
        'username' => 'siliconithub',
        'password' => 'it@adm123',
        'charset' => 'utf8',
    );
}


return $config;

