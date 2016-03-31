<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 21:25
 */

namespace admin\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\PostEvent;
use models\Story;
use models\Image;

class PostListener extends ListenerAbstract
{
    public static function handlePostChanged(PostEvent $event)
    {
        $post = $event->sender;
        if ($post->isImageChanged()) {
            if (!Yii::$app->file->loadFile($post)) {
                $event->isValid = false;
                $event->message = Yii::$app->view->t('Can not upload image');
            }
            if (!Image::createImage($post)) {
                $event->isValid = false;
                $event->message = Yii::$app->view->t('Can not save image');
            }
        }

        if ($event->isValid) {
            // Write the story
            Story::write($post);
        }
    }
}