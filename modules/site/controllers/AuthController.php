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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = new User();

        if ($user->load($this->post())) {
            $account = $user->getAccount();
            if ($account !== null && Yii::$app->user->login($account, $user->getSessionTime())) {
                return $this->goBack();
            }
        }

        return $this->render([
            'user' => $user,
        ]);
    }

    public function actionRegister()
    {
        $user = new User();
        if ($user->load($this->post()) && $user->save()) {
            Yii::$app->user->login($user, $user->getSessionTime());
            return $this->redirect(['/front/index/index']);
        }

        return $this->render([
            'user' => $user,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}