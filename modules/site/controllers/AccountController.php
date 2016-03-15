<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 16.03.2016
 * Time: 1:02
 */

namespace site\controllers;

use Yii;
use site\abstracts\ControllerAbstract;
use yii\web\ForbiddenHttpException;

class AccountController extends ControllerAbstract
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException();
        }

        return true;
    }

    public function actionUpdate()
    {
        $user = Yii::$app->user->identity;

        if ($user->load($this->post())) {
            $user->save();
        }

        return $this->render([
            'user' => $user,
        ]);
    }
}