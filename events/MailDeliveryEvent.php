<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 06.09.2016
 * Time: 21:41
 */

namespace events;

use abstracts\ModelEventAbstract;

class MailDeliveryEvent extends ModelEventAbstract
{
    /**
     * @var \models\MailDelivery
     */
    public $sender;
}