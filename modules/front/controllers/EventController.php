<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 20:54
 */

namespace front\controllers;

use Yii;
use front\abstracts\ControllerAbstract;

class EventController extends ControllerAbstract
{
    public function actionList()
    {
        return $this->render();
    }
}