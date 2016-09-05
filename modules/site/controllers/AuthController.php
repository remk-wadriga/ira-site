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
use yii\base\ErrorException;

class AuthController extends ControllerAbstract
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->layout = 'site';

        return true;
    }

    public function actionLogin()
    {
        $user = new User();

        if ($user->load($this->post())) {
            $userService = Yii::$app->user;
            $account = $user->getAccount();
            if ($account !== null) {
                $account->setStoryAction(User::STORY_ACTION_LOGIN);
                if ($userService->login($account, $user->getSessionTime())) {
                    return $this->goBack(['/site/account/update']);
                }
            }
        }

        return $this->render([
            'user' => $user,
        ]);
    }

    public function actionRegister()
    {
        $user = new User();

        if ($user->load($this->post())) {
            Yii::$app->user->register($user);
            return $this->redirect(['/front/index/index']);
        }

        return $this->render([
            'user' => $user,
        ]);
    }

    public function actionLogout()
    {
        $userService = Yii::$app->user;
        $userService->identity->setStoryAction(User::STORY_ACTION_LOGOUT);

        $userService->logout();

        return $this->goHome();
    }
}