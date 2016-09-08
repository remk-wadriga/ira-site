<?php

$routes = require(__DIR__ . '/routes.php');
$params = require(__DIR__ . '/params.php');

return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'B80odsmVGpOTb5Z2rR2kPEsHHTOUfYtQ',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'errorHandler' => [
        //'errorAction' => 'site/error',
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
    'db' => require(__DIR__ . '/db_local.php'),
    'urlManager' => [
        //'class' => 'components\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => $routes,
        'enableStrictParsing' => true,
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
            ],
        ],
    ],
    'assetManager' => [
        'appendTimestamp' => true,
        'forceCopy' => true,
        'bundles' => [
            'yii\web\JqueryAsset' => [
                //'sourcePath' => null,   // do not publish the bundle
                'js' => [
                    '//code.jquery.com/jquery-1.11.1.min.js',  // use custom jquery
                ]
            ],
        ],
    ],
    'formatter' => [
        'class' => 'components\FormatterService',
        'dateFormat' => 'php:' . $params['dateFormat'],
        'datetimeFormat' => 'php:' . $params['dateTimeFormat'],
        'timeFormat' => 'php:' . $params['timeFormat'],
        'timeZone' => $params['timeZone'],
    ],

    'view' => [
        'class' => 'components\View',
    ],
    'user' => [
        'class' => 'components\UserService',
        'identityClass' => 'models\User',
        'enableAutoLogin' => true,
        'on afterRegister' => ['site\listeners\UserListener', 'handleUserRegister'],
        'on afterLogin' => ['site\listeners\UserListener', 'handleUserLogin'],
        'on beforeLogout' => ['site\listeners\UserListener', 'handleUserLogout'],
    ],
    'time' => [
        'class' => 'components\TimeService',
        'dateFormat' => $params['dateFormat'],
        'dateTimeFormat' => $params['dateTimeFormat'],
        'timeFormat' => $params['timeFormat'],
    ],
    'file' => [
        'class' => 'components\FileService',
    ],
    'mailer' => [
        'class' => 'components\Mailer',
        'dateTimeFormat' => $params['mailDateTimeFormat'],
        'systemEmail' => $params['systemEmail'],
        'enabled' => true,
        //'useFileTransport' => true,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => $params['smtpHost'],
            'username' => $params['smtpUsername'],
            'password' => $params['smtpPassword'],
            'port' => $params['smtpPort'],
            //'encryption' => $params['smtpEncryption'],
        ],
    ],
    'security' => [
        'class' => 'components\SecurityService',
    ],
];