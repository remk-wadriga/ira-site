<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 23:07
 */

namespace admin\listeners;

use Yii;
use abstracts\ListenerAbstract;
use events\SlideEvent;
use models\Image;

class SlideListener extends ListenerAbstract
{
    public static function handleSlideSaved(SlideEvent $event)
    {
        $slider = $event->sender;

        if (!Yii::$app->file->loadFile($slider)) {
            $event->isValid = false;
            $event->message = Yii::$app->view->t('Can not upload image');
        } elseif ($slider->isImageChanged()) {
            $slider->setIsMainImage(true);
            // Save the slider image
            $event->isValid = Image::createImage($slider);
            $event->message = Yii::$app->view->t('Can not save image');

            $slider->setIsMainImage(false);
        }
    }
}