<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 18:14
 */

namespace admin\listeners;

use models\Image;
use Yii;
use abstracts\ListenerAbstract;
use events\EventEvent;
use models\Story;

class EventListener extends ListenerAbstract
{
    public static function handleEventStoryChanged(EventEvent $event)
    {
        $eventModel = $event->sender;

        if (!Yii::$app->file->loadFile($eventModel)) {
            $event->isValid = false;
            $event->message = Yii::$app->view->t('Can not upload image');
        } elseif ($eventModel->isImageChanged()) {
            $eventModel->setIsMainImage(true);
            // Save the event image
            $event->isValid = Image::createImage($eventModel);
            $event->message = Yii::$app->view->t('Can not save image');
            $eventModel->setIsMainImage(false);
        }

        if ($event->isValid) {
            // Write the story
            Story::write($eventModel);

            // Save model images
            foreach ($eventModel->getImagesUrls() as $imgUrl) {
                $eventModel->img = $imgUrl;
                Image::createImage($eventModel);
            }
        }
    }
}