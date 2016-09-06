<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 06.09.2016
 * Time: 21:47
 */

namespace admin\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\MailDeliveryEvent;
use models\Story;
use models\Image;

class MailDeliveryListener extends ListenerAbstract
{
    public static function handleEventStoryChanged(MailDeliveryEvent $event)
    {
        $model = $event->sender;
        if ($model->isImageChanged()) {
            if (!Yii::$app->file->loadFile($model)) {
                $event->isValid = false;
                $event->message = Yii::$app->view->t('Can not upload image');
            }
            if (!Image::createImage($model)) {
                $event->isValid = false;
                $event->message = Yii::$app->view->t('Can not save image');
            }
        }

        if ($event->isValid) {
            // Write the story
            Story::write($model);
        }
    }

    public static function handleEventDeleted(MailDeliveryEvent $event)
    {
        $model = $event->sender;
        $model->setStoryAction($model::STORY_ACTION_DELETED);

        $transaction = Yii::$app->db->beginTransaction();
        
        if ($model->image !== null && !$model->image->delete()) {
            $transaction->rollBack();
            $event->isValid = false;
            $event->message = 'can not delete the image';
        }

        if ($event->isValid) {
            // Write the story
            Story::write($model);
            $transaction->commit();
        }
    }

    public static function handleEventStarted(MailDeliveryEvent $event)
    {
        
    }
}