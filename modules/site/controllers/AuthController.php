<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:46
 */

namespace site\controllers;

use Yii;
use site\abstracts\ControllerAbstract;
use models\User;

class AuthController extends ControllerAbstract
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->layout = 'minimal';

        return true;
    }

    public function actionLogin()
    {
        return $this->render();
    }

    public function actionRegister()
    {
        $user = new User();
        if ($user->load($this->post()) && $user->save()) {
            return $this->redirect(['/front/index/index']);
        }

        return $this->render([
            'user' => $user,
        ]);
    }
}