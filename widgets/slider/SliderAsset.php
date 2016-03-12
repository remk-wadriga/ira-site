<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 21:12
 */

namespace widgets\slider;

use abstracts\AssetAbstract;

class SliderAsset extends AssetAbstract
{
    public $theme = 'main';
    public $path = 'plugins/masterslider/';

    public $scc = [
        'css/masterslider.css',
        'css/skins/black-1/style.css',
    ];

    public $js = [
        'js/masterslider.min.js',
        'js/masterslider.staff.carousel.dev.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}