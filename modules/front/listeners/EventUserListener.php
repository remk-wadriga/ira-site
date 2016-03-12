<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 23:10
 */

namespace front\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\EventUserEvent;
use yii\web\UserEvent;
use yii\base\ErrorException;
use models\User;
use models\Story;

class EventUserListener extends ListenerAbstract
{
    public static function handleUserRegister(EventUserEvent $event)
    {
        $sender = $event->sender;
        if ($sender->registerInSite && Yii::$app->user->isGuest) {
            try {
                $nameParts = explode(' ', $sender->name);

                $user = new User();
                $user->email = $sender->email;
                $user->firstName = $nameParts[0];
                if (isset($nameParts[1])) {
                    $user->lastName = $nameParts[1];
                }
                $user->phone = $sender->phone;
                $user->password = $sender->password;
                $user->passwordRepeat = $sender->passwordRepeat;

                if (!$user->save()) {
                    throw new ErrorException($sender->t('Can not register the user'));
                }

                $user->setStoryAction(User::STORY_ACTION_REGISTRATION);

                $userService = Yii::$app->user;
                $userService->identity = $user;

                // Create "user register" event
                $event = new UserEvent();
                $userService->trigger($userService::EVENT_AFTER_REGISTER, $event);

                $user->setStoryAction(User::STORY_ACTION_LOGIN);
                if (!$userService->login($user, $user->getSessionTime())) {
                    throw new ErrorException($sender->t('Can not login the user'));
                }
            } catch (ErrorException $e) {
                $event->isValid = false;
                $event->message = $e->getMessage();
            }
        }

        if ($event->isValid) {
            $user = Yii::$app->user;
            if (!$user->isGuest) {
                $sender->userID = $user->id;
                $sender->email = $user->email;
                $sender->name = $user->fullName;
                $sender->phone = $user->phone;
            }
        }
    }

    public static function handleUserAfterRegister(EventUserEvent $event)
    {
        Story::write($event->sender);
    }
}