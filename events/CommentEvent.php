<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 20:10
 */

namespace events;

use abstracts\ModelEventAbstract;

class CommentEvent extends ModelEventAbstract
{
    /**
     * @var \models\Comment
     */
    public $sender;
}