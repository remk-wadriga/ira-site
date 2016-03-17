<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace assets;

use abstracts\AssetAbstract;

class MainAsset extends AssetAbstract
{
    public $theme = 'main';
    public $path = 'static/';

    public $css = [
        'css/main.css',
    ];

    public $js = [
        'js/main.js',
        'js/api.js',
        'js/helper.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\YiiAsset',
        'assets\BootstrapSwitchAsset',
    ];

    public static function scriptName()
    {
        return 'Main';
    }
}
