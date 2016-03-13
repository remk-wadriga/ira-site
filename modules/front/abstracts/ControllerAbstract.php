<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 21:25
 */

namespace front\abstracts;

use Yii;
use abstracts\ControllerAbstract as BaseController;

abstract class ControllerAbstract extends BaseController
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }
}