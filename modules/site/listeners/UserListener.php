<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 05.03.2016
 * Time: 17:13
 */

namespace site\listeners;

use Yii;
use abstracts\ListenerAbstract;
use yii\web\UserEvent;
use models\Story;

class UserListener extends ListenerAbstract
{
    public static function handleUserRegister(UserEvent $event)
    {
        // Write the story
        Story::write($event->sender->getIdentity());
    }

    public static function handleUserLogin(UserEvent $event)
    {
        // Write the story
        Story::write($event->sender->getIdentity());
    }

    public static function handleUserLogout(UserEvent $event)
    {
        // Write the story
        Story::write($event->sender->getIdentity());
    }
}