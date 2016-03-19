<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 20:12
 */

namespace front\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\CommentEvent;
use models\Story;

class CommentListener extends ListenerAbstract
{
    public static function handleCommentCreated(CommentEvent $event)
    {
        Story::write($event->sender);
    }
}