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
use yii\web\UserEvent;

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
        $user = new User();

        if ($user->load($this->post())) {
            $userService = Yii::$app->user;
            $account = $user->getAccount();
            $account->setStoryAction(User::STORY_ACTION_LOGIN);

            if ($account !== null && $userService->login($account, $user->getSessionTime())) {
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
        $user->load($this->post());

        if ($user->load($this->post()) && $user->save()) {
            $user->setStoryAction(User::STORY_ACTION_REGISTRATION);

            $userService = Yii::$app->user;
            $userService->identity = $user;

            // Create "user register" event
            $event = new UserEvent();
            $userService->trigger($userService::EVENT_AFTER_REGISTER, $event);

            $user->setStoryAction(User::STORY_ACTION_LOGIN);
            $userService->login($user, $user->getSessionTime());
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