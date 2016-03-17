<?php

namespace front;

use Yii;
use abstracts\ModuleAbstract;

class FrontModule extends ModuleAbstract
{
    public $controllerNamespace = 'front\controllers';

    public function init()
    {
        parent::init();

        Yii::setAlias('@common', '@app/themes/front/views/common');
    }
}
