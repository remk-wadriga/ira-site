<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:30
 */

namespace assets;

use abstracts\AssetAbstract;

class AdminAsset extends AssetAbstract
{
    public $css = [
        'css/admin.css',
    ];

    public $js = [
        'js/admin.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'assets\MainAsset',
        'assets\BootstrapSwitchAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];

    public static function scriptName()
    {
        return 'Admin';
    }
}