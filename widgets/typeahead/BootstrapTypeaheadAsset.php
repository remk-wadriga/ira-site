<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 15.03.2016
 * Time: 1:19
 */

namespace widgets\typeahead;

use abstracts\AssetAbstract;

class BootstrapTypeaheadAsset extends AssetAbstract
{
    public $theme = 'main';
    public $path = 'plugins/bootstrap-typeahead/';

    public $js = [
        'bootstrap3-typeahead.js',
    ];

    public $css = [

    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}