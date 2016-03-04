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
    ],

    'view' => [
        'class' => 'components\View',
    ],
    'user' => [
        'class' => 'components\UserService',
        'identityClass' => 'models\User',
        'enableAutoLogin' => true,
    ],
];