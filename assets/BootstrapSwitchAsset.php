<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 21:43
 */

namespace assets;

use abstracts\AssetAbstract;

class BootstrapSwitchAsset extends AssetAbstract
{
    public $theme = 'main';
    public $path = 'static/plugins/bootstrap-switch/';

    public $js = [
        'js/bootstrap-switch.js',
    ];

    public $css = [
        'css/bootstrap3/bootstrap-switch.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}