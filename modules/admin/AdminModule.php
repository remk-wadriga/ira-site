<?php

namespace admin;

use Yii;
use abstracts\ModuleAbstract;

class AdminModule extends ModuleAbstract
{
    public $controllerNamespace = 'admin\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
