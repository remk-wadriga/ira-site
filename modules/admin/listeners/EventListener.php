<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 18:14
 */

namespace admin\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\EventEvent;
use models\Story;

class EventListener extends ListenerAbstract
{
    public static function handleEventStoryChanged(EventEvent $event)
    {
        // Write the story
        Story::write($event->sender);
    }
}