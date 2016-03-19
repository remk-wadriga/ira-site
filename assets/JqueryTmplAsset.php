<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 19:14
 */

namespace assets;

use abstracts\AssetAbstract;

class JqueryTmplAsset extends AssetAbstract
{
    public $theme = 'main';
    public $path = 'plugins/jquery-tmpl/';

    public $js = [
        'jquery.tmpl.min.js',
    ];

    public $css = [

    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}