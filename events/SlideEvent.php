<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 23:01
 */

namespace events;

use abstracts\ModelEventAbstract;

class SlideEvent extends ModelEventAbstract
{
    /**
     * @var \models\Slide
     */
    public $sender;
}