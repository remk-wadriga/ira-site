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
use models\Event;

class IndexController extends ControllerAbstract
{
    public function actionIndex()
    {
        return $this->render([
            'events' => Event::getRandomList(8),
        ]);
    }
}