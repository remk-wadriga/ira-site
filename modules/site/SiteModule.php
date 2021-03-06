<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:39
 */

namespace site;

use Yii;
use abstracts\ModuleAbstract;

class SiteModule extends ModuleAbstract
{
    public $controllerNamespace = 'site\controllers';
    public $layout = 'front';

    public function init()
    {
        parent::init();

        Yii::setAlias('@common', '@app/themes/front/views/common');
    }
}