<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 21:23
 */

namespace front\controllers;

use Yii;
use front\abstracts\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function actionIndex()
    {
        return $this->render();
    }
}