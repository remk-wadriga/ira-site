<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 19:03
 */

namespace admin\listeners;

use models\Image;
use Yii;
use abstracts\ListenerAbstract;
use events\UserEvent;
use models\Story;
use models\EventUser;

class UserListener extends ListenerAbstract
{
    public static function handleUserChanged(UserEvent $event)
    {
        $sender = $event->sender;

        if ($sender->getStoryAction() == $sender::STORY_ACTION_CREATED_BY_EVENT_RECORD) {
            $params = ['user_id' => $sender->getID()];
            $conditions = ['email' => $sender->email];
            $result = Yii::$app->db->createCommand()->update(EventUser::tableName(), $params, $conditions)->execute();
            if (!$result) {
                $event->isValid = false;
                $event->message = Yii::$app->view->t('Can not save the record');
            }
        }

        if ($event->isValid) {
            if (!Yii::$app->file->loadFile($sender)) {
                $event->isValid = false;
                $event->message = Yii::$app->view->t('Can not upload image');
            } elseif ($sender->isAvatarChanged()) {
                // Save the user avatar
                $event->isValid = Image::createImage($sender);
                $event->message = Yii::$app->view->t('Can not save image');
            }
        }

        if ($event->isValid) {
            Story::write($sender);
        }
    }
}