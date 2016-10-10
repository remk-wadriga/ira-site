<?php

$params = require(__DIR__ . '/params.php');
$components = require(__DIR__ . '/components.php');
$modules = require(__DIR__ . '/modules.php');

// Set aliases for namespaces
$namespaces = require(__DIR__ . '/namespaces.php');
foreach($namespaces as $alias => $path){
    Yii::setAlias('@' . $alias, __DIR__ . '/../' . $path);
}

foreach (array_keys($modules) as $module) {
    Yii::setAlias('@' . $module . 'Views', __DIR__ . '/../themes/' . $module . '/views');
}

Yii::setAlias('@themes', __DIR__ . '/../themes');

$config = [
    'id' => $params['appID'],
    'name' => 'Альтернатива',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => $components,
    'params' => $params,
    'modules' => $modules,
    'language' => 'ru',
    'sourceLanguage' => 'en',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['192.168.0.*', '127.0.0.1', '::1', 'localhost']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.0.*', '127.0.0.1', '::1', 'localhost']
    ];
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

return $config;
