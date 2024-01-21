<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$config = array(
    //'timeZone' => 'Africa/Lagos',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Giveyourbit',
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
        'application.extensions.fancybox.*',
        'application.extensions.',
        'zii.widgets.*',
        'zii.widgets.grid.*',
        'zii.widgets.CDetailView',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
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
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array( // You can change the providers and their classes.
                'facebook' => array(
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'FacebookOAuthService',
                    'client_id' => '434473023607515',
                    'client_secret' => '4dd6a6625d6f7864f27c9557da6785c6',
                ),
            ),
        ),

        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),

        'frontUser' => array(
            'class' => 'CWebUser',
            'stateKeyPrefix' => 'front_',
            'loginUrl' => array("site/login"),
            'allowAutoLogin' => true,
        ),
        'admin' => array(
            'class' => 'CWebUser',
            'stateKeyPrefix' => 'backend_',
            'loginUrl' => array("admin/default"),
        ),

        'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
        /*
        'cache' => array(
            //'class' => 'CApcCache',
            'class' => 'CFileCache',
        ),
        */
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => true,
            // 'caseSensitive' => false,
            'rules' => array(
                /*
                refrence for the custome url
                $a->url =  Yii::app()->createUrl('view/profile',array('uid'=>$a->userid,'type'=>$a->type,'specialty'=>$specialty,'locality'=>$locality)) ;
                'profile<uid:\w+>_<type:\w+>/'=>'view/profile,
                http://localhost/dev/profile122_doctor?specialty=Cardiology&locality=Times+Square
                http://localhost/dev/profile122_doctor/specialty-Cardiology-near-Times-Square
                */
//                'fundraiser/'=>'fundraiser/index',
                'fundraiser/fbshare'=>'fundraiser/fbshare',
                'fundraiser/category/<id:\w+>/<category_name:\w+>'=>'fundraiser/category',
                'fundraiser/<id:\w+>/<fundraiser_name:\w+>/<user_name:\w+>'=>'fundraiser/index',
                'fundraiser/<id:\w+>/<fundraiser_name:\w+>'=>'fundraiser/index',
                'fundraiser/donations'=>'fundraiser/donations',
                'fundraiser/caseupdates'=>'fundraiser/caseupdates',
                'fundraiser/sendreport'=>'fundraiser/sendreport',
                'fundraiser/sendreportxml'=>'fundraiser/sendreportxml',
                'fundraiser/responsemessagepayment'=>'fundraiser/responsemessagepayment',
                'fundraiser/user_messaging'=>'fundraiser/user_messaging',
                'fundraiser/become_supporter'=>'fundraiser/become_supporter',
                'fundraiser/supporter_message'=>'fundraiser/supporter_message',
                'fundraiser/FundraiserComment'=>'fundraiser/FundraiserComment',
//                'fundraiser/donations/<fundraiser_name:\w+>_<id:\w+>'=>'fundraiser/donations',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '' => 'site/index',
                'login/<service:(google|google-oauth|yandex|yandex-oauth|twitter|linkedin|vkontakte|facebook|steam|yahoo|mailru|moikrug|github|live|odnoklassniki)>' => 'site/login',
                'logout' => 'site/logout',
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
        'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"giveyourbit.com",
            'Username'=>'information@giveyourbit.com',
            'Password'=>'MPrRhUC2ORB4',
            'Mailer'=>'smtp',
            'Port'=>465,
            'SMTPAuth'=>true, 
        ),
        'mailer' => [
            'class' => 'bashkarev\swiftmailer\swift\Mailer',
            //'viewPath' => 'application.mail' //default path to views
            'transport' => [
                'host' => 'giveyourbit.com',
                'username' => 'donotreply@giveyourbit.com',
                'password' => 'b7pqzaX9nUNg',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig' => [
                'from' => ['donotreply@giveyourbit.com' => 'Giveyourbit']
            ]
        ],

        /*
        MAIL_DRIVER=smtp
        MAIL_HOST=rayantransports.com
        MAIL_PORT=465
        MAIL_USERNAME=booking@rayantransports.com
        MAIL_PASSWORD="pass_123$$$234"
        MAIL_ENCRYPTION=SSL
        MAIL_FROM_ADDRESS=booking@rayantransports.com
        MAIL_FROM_NAME="Rayan Transports"
        */

    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',    
        'timeZone' => 'Africa/Lagos',    
        'default_password' => 'abcdef1234xzy',
        'request_min_amount' => 10000, //allow creation of transferr request if fundraiser has this much amount. 
        /*
        'fb_config' => [
            'app_id' => '1874544942749468',
            'app_secret' => 'f91cff37f31f273dbe7e8191efa73961',
            'default_graph_version' => 'v2.10'
        ],
        */
        'fb_config' => [
            'app_id' => '1516737235423924',
            //'app_secret' => 'c66f86841371a4a52afb96356e5a1786',
            'app_secret' =>   '9411e0cf836a1aa8a26b2043e824b86c',
            'default_graph_version' => 'v2.10'
        ], 
        /*
        'interswitch_settings' => [
            'mode' => 'test', // set it to live or test.
            'live' =>[
                'payment_url' => 'https://newwebpay.interswitchng.com/collections/w/pay',
                'merchant_code' => 'MX7283',
                'pay_item_id'=>'Default_Payable_MX7283',
                'currency' => '566',
            ],
            'test' =>[
                'payment_url' => 'https://webpay-ui.k8.isw.la/collections/w/pay',
                'merchant_code' => 'MX70046',
                'pay_item_id'=>'Default_Payable_MX70046',
                'currency' => '566',
            ] 
        ],
        */
        'flutterwave_settings' => [
            'mode' => 'live', // set it to live or test.
            'live' =>[
                'payment_url' => 'https://checkout.flutterwave.com/v3/hosted/pay',
                'public_key' => 'FLWPUBK-45d41493ad8d610d4a9d5723c5e68ac5-X',
                'secret_key'=>'FLWSECK-cf46b1f3c511a1857842ac0887169b40-X',
                'encryption_key'=>'cf46b1f3c51198acc15bb2cb',
                'currency' => 'NGN',
                'sub_account_id' => 'RS_72C036E0E351FAE9A1FCD33D4B824F21'
            ],
            'test' =>[
                'payment_url' => 'https://checkout.flutterwave.com/v3/hosted/pay',
                'public_key' => 'FLWPUBK_TEST-911e03d106813d28f555216fc30d7db1-X',
                'secret_key' => 'FLWSECK_TEST-10746a23657e5d8195df2728419287c4-X',
                'encryption_key' => 'FLWSECK_TEST2be68251efad',
                'currency' => 'NGN',
                'sub_account_id' => 'RS_821FBA91809C7A752A13C88D81218465'
            ] 
        ]  


    ),
);

if ($_SERVER['SERVER_NAME'] == 'gabit.local') { //localhost -dev setting
    $config['components']['db'] = array(
        'connectionString' => 'mysql:host=localhost;dbname=giveyourbit',
        'emulatePrepare' => true,
        'username' => 'phpmyadmin',
        'password' => 'phpmy_pass',
        'charset' => 'utf8',
    );
} else { // demo server setting
    $config['components']['db'] = array(
        'connectionString' => 'mysql:host=localhost;dbname=givercrw_giveyourbit',
        'emulatePrepare' => true,
        'username' => 'givercrw_giveyb',
        'password' => 'Somedev123',
        'charset' => 'utf8',
    );
}


return $config;

