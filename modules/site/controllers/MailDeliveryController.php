<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 08.09.2016
 * Time: 16:45
 */

namespace site\controllers;

use Yii;
use site\abstracts\ControllerAbstract;
use yii\web\NotFoundHttpException;
use models\User;

class MailDeliveryController extends ControllerAbstract
{
    public function actionUnfollow($token)
    {
        // Try to find the user by mail delivery token
        if (($user = User::findOne(['mail_delivery_token' => base64_decode($token)])) === null) {
            throw new NotFoundHttpException($this->t('Incorrect token'));
        }

        // Login the user
        $user->setStoryAction(User::STORY_ACTION_LOGIN);
        Yii::$app->user->login($user, $user->getSessionTime());

        // Unfollow user from mail deliveries
        $user->mailDeliveryAllowed = false;
        $user->mailDeliveryToken = null;
        $user->setStoryAction(User::STORY_ACTION_MAIL_DELIVERY_UNFOLLOW);

        if (!$user->save()) {
            $this->setError($this->t('Can not unfollow from mail deliveries'));
        } else {
            $this->setFlash($this->t('You are unfollow from the mail deliveries'));
        }

        return $this->redirect(['/site/account/update']);
    }
}