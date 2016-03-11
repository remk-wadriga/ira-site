<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 11.03.2016
 * Time: 17:44
 */

namespace events;

use abstracts\ModelEventAbstract;

class ImageEvent extends ModelEventAbstract
{
    /**
     * @var \models\Image
     */
    public $sender;
}