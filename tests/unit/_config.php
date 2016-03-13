<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 16:06
 */

return [
    'id' => 'app-console',
    'class' => 'yii\console\Application',
    'basePath' => \Yii::getAlias('@tests'),
    'runtimePath' => \Yii::getAlias('@tests/_output'),
    'bootstrap' => [],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ira_site_test',
            'username' => 'web',
            'password' => 'web',
        ]
    ]
];