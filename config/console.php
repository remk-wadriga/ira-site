<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

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
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => array_merge($components, [
        'request' => null,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
            'scriptUrl' => '/index.php',
            'hostInfo' => $params['hostInfo'],
        ],
    ]),
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
