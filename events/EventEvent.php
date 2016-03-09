<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 18:11
 */

namespace events;

use abstracts\ModelEventAbstract;

class EventEvent extends ModelEventAbstract
{
    /**
     * @var \models\Event
     */
    public $sender;
}