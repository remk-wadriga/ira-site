<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 11.03.2016
 * Time: 17:41
 */

namespace admin\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\ImageEvent;
use models\Image;

class ImageListener extends ListenerAbstract
{
    public static function handleImageDeleted(ImageEvent $event)
    {
        if (!Image::removeEntityImage($event->sender->id)) {
            $event->isValid = false;
            $event->message = Yii::$app->view->t('Can not delete {name} records', ['name' => Image::entityImageTableName()]);
        } else {
            Yii::$app->file->removeFile($event->sender->url);
        }
    }
}