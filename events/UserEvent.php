<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 19:04
 */

namespace events;

use abstracts\ModelEventAbstract;

class UserEvent extends ModelEventAbstract
{
    /**
     * @var \models\User
     */
    public $sender;
}