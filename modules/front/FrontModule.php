<?php

namespace front;

use abstracts\ModuleAbstract;

class FrontModule extends ModuleAbstract
{
    public $controllerNamespace = 'front\controllers';

    public function init()
    {
        parent::init();
    }
}
