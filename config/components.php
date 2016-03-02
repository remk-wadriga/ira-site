<?php

$routes = require(__DIR__ . '/routes.php');

return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'B80odsmVGpOTb5Z2rR2kPEsHHTOUfYtQ',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'models\User',
        'enableAutoLogin' => true,
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
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
    'db' => require(__DIR__ . '/db.php'),
    'urlManager' => [
        //'class' => 'components\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => $routes,
        'enableStrictParsing' => true,
    ],

    'view' => [
        'class' => 'components\View',
    ],
];