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

    ];

    public $js = [

    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function scriptName()
    {
        return 'Front';
    }
}