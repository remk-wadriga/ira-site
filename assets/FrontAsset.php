<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:29
 */

namespace assets;

use abstracts\AssetAbstract;

class FrontAsset extends AssetAbstract
{
    public $css = [
        'css/main-styles.css',
        'css/ddsmoothmenu.css',
        'css/jquery.dualSlider.0.2.css',
        'css/front.css',
    ];

    public $js = [
        'js/ddsmoothmenu.js',
        'js/jquery.easing.1.3.js',
        'js/jquery.timers-1.2.js',
        'js/jquery.dualSlider.0.3.min.js',
        'js/slimbox2.js',
        'js/front.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function scriptName()
    {
        return 'Front';
    }
}