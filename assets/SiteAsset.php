<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:41
 */

namespace assets;

use abstracts\AssetAbstract;

class SiteAsset extends AssetAbstract
{
    public $css = [
        'css/site.css',
    ];

    public $js = [
        'js/site.js',
    ];

    public $depends = [
        'assets\FrontAsset',
        //'assets\MainAsset',
    ];

    public static function scriptName()
    {
        return 'Site';
    }
}