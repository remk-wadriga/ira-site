<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 23:01
 */

namespace events;

use yii\base\ModelEvent;

class SlideEvent extends ModelEvent
{
    /**
     * @var \models\Slide
     */
    public $sender;

    public $message;
}