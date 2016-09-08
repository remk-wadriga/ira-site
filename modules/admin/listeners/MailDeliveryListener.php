<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 06.09.2016
 * Time: 21:47
 */

namespace admin\listeners;

use models\MailDelivery;
use models\User;
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

    public static function handleEventFinished(MailDeliveryEvent $event)
    {
        // Set mail delivery send date to 'now'
        Yii::$app->db->createCommand()->update(MailDelivery::tableName(), ['date_send' => Yii::$app->time->getCurrentDateTime()], ['id' => $event->sender->id])->execute();
        // Remove delivery records from user_mail_delivery table
        $event->isValid = (bool)Yii::$app->db->createCommand()->delete(User::userMailDeliveryTableName(), ['mail_delivery_id' => $event->sender->id])->execute();
    }

    public static function handleEventCancelled(MailDeliveryEvent $event)
    {
        // Set mail delivery send date to null
        Yii::$app->db->createCommand()->update(MailDelivery::tableName(), ['date_send' => null], ['id' => $event->sender->id])->execute();
        // Remove delivery records from user_mail_delivery table
        Yii::$app->db->createCommand()->delete(User::userMailDeliveryTableName(), ['mail_delivery_id' => $event->sender->id])->execute();
    }
}