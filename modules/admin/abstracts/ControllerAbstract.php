<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 21:25
 */

namespace admin\abstracts;

use Yii;
use abstracts\ControllerAbstract as BaseController;

abstract class ControllerAbstract extends BaseController
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!Yii::$app->user->isAdmin) {
            return $this->redirect(['/site/auth/login']);
        }

        return true;
    }
}