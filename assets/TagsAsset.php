<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 17.03.2016
 * Time: 18:13
 */

namespace assets;

use abstracts\AssetAbstract;

class TagsAsset extends AssetAbstract
{
    public $theme = 'front';
    public $path = 'static/';

    public $js = [
        'js/tags.js',
    ];

    public $css = [

    ];

    public $depends = [
        'assets\FrontAsset',
        'assets\MainAsset',
    ];

    public static function scriptName()
    {
        return 'Tags';
    }
}