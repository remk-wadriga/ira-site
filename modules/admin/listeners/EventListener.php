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
use models\Image;

class EventListener extends ListenerAbstract
{
    public static function handleEventStoryChanged(EventEvent $event)
    {
        $eventModel = $event->sender;
        if ($eventModel->isImageChanged()) {
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
        }
        
        if ($event->isValid && $eventModel->isTrainersChanged() && !$eventModel->saveTrainers()) {
            $event->isValid = false;
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

    public static function handleEventDeleted(EventEvent $event)
    {
        $eventModel = $event->sender;
        $eventModel->setStoryAction($eventModel::STORY_ACTION_DELETED);

        $transaction = Yii::$app->db->beginTransaction();

        foreach ($eventModel->allImages as $image) {
            if (!$image->delete()) {
                $transaction->rollBack();
                $event->isValid = false;
                $event->message = 'can not delete the image';
                break;
            }
        }

        if ($event->isValid) {
            // Write the story
            Story::write($eventModel);
            $transaction->commit();
        }
    }
}