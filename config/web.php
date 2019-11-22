<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [

        'view' => [
            'theme' => [
                'pathMap' => [
                     // '@dektrium/user/views' => '@vendor/cinghie/yii2-user-extended/views',
                    '@dektrium/user/views/settings/show' => '@app/views/settings/show',
                    '@dektrium/user/views/settings' => '@app/views/settings',

                   // '@dektrium/user/settings/show' => '@app/views/settings/account',

//                    '@dektrium/user/views' => '@app/views/',
//                    '@cinghie/userextended/views/admin' => '@app/views/userextended/admin',
//                    '@dektrium/rbac/views/permission' => '@vendor/cinghie/yii2-user-extended/views/permission',
//                    '@dektrium/rbac/views/role' => '@vendor/cinghie/yii2-user-extended/views/role',
//                    '@dektrium/rbac/views/rule' => '@vendor/cinghie/yii2-user-extended/views/rule',
//                    '@dektrium/user/views/admin' => '@vendor/cinghie/yii2-user-extended/views/admin',
//
//                    '@dektrium/user/views/role' => '@vendor/cinghie/yii2-user-extended/views/role',
//                    '@dektrium/user/views/security' => '@vendor/cinghie/yii2-user-extended/views/adminlte/security',
//                    '@dektrium/user/views/settings' => '@vendor/cinghie/yii2-user-extended/views/settings',
                ],
            ],
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'YFij0j9qkun9TVTQCzCpX5X20dGrQoqb',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
/*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
*/
    ],
    'modules' => [

        'rbac' => 'dektrium\rbac\RbacWebModule',
        // Yii2 User
        'user' => [
            'class' => 'dektrium\user\Module',
            // Yii2 User Controllers Overrides
            'controllerMap' => [
                'admin' => 'app\controllers\user\AdminController',
                'security' => 'cinghie\userextended\controllers\SecurityController',
                'settings' => 'app\controllers\user\SettingsController'
            ],

            // Yii2 User Models Overrides
            'modelMap' => [
                'RegistrationForm' => 'app\models\RegistrationForm',
                'Profile' => 'app\models\Profile',
                'SettingsForm' => 'app\models\SettingsForm',
                'User' => 'app\models\User',
            ],
        ],
        // Yii2 User Extended
        'userextended' => [
            'class' => 'cinghie\userextended\Module',
//            'controllerMap' => [
//                'items' => 'app\controllers\AdminController',
//                'items' => 'app\controllers\SecurityController',
//                'items' => 'app\controllers\SettingsController',
//            ],
//            'modelMap' => [
//                'Account' => 'app\models\Account',
//                'Assignment' => 'app\models\Assignment',
//                'LoginForm' => 'app\models\LoginForm',
//                'Permission' => 'app\models\Permission',
//                'Profile' => 'app\models\Profile',
//                'RegistrationForm' => 'app\models\RegistrationForm',
//                'SettingsForm' => 'app\models\SettingsForm',
//                'User' => 'app\models\User',
//            ],
            'avatarPath' => '@webroot/img/users/', // Path to your avatar files
            'avatarURL' => '@web/img/users/', // Url to your avatar files
            'defaultRole' => '', // example 'registered'
            'avatar' => true,
            'bio' => false,
            'captcha' => true,
            'birthday' => true,
            'firstname' => true,
            'gravatarEmail' => false,
            'lastname' => true,
            'location' => false,
            'onlyEmail' => false,
            'publicEmail' => false,
            'signature' => true,
            'templateLogin' => 'login_prestashop', // login or login_prestashop
            'templateLogoURL' => '@web/logo.png', // Url to logo
            'templateRegister' => '_two_column', // _one_column or _two_column
            'terms' => true,
            'website' => false,
            'showTitles' => true, // Set false in adminLTE
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
