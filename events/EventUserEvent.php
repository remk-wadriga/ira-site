<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 23:11
 */

namespace events;

use abstracts\ModelEventAbstract;

class EventUserEvent extends ModelEventAbstract
{
    /**
     * @var \models\EventUser
     */
    public $sender;
}