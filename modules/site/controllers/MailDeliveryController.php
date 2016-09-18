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
use yii\web\BadRequestHttpException;
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
    
    public function actionSubscribe()
    {
        // Check the request method
        if (!$this->isPost()) {
            throw new BadRequestHttpException($this->t('Bad request'));
        }
        // Check is user not subscribed
        if (Yii::$app->user->getIsSubscribed()) {
            throw new BadRequestHttpException($this->t('You are already subscribed to our newsletter'));
        }

        // Try to subscribe user to mail delivery
        if (Yii::$app->user->setIsSubscribed(true)) {
            $this->setSuccess($this->t('You are subscribed to our newsletter'));
        } else {
            $this->setError($this->t('Could not subscribe you to our newsletter'));
        }

        return $this->redirect(['/site/account/update']);
    }
}