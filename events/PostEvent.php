<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 21:25
 */

namespace events;

use abstracts\ModelEventAbstract;

class PostEvent extends ModelEventAbstract
{
    /**
     * @var \models\Post
     */
    public $sender;
}