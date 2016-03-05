<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 1:21
 */

namespace widgets;

use yii\bootstrap\Dropdown as BootstrapDropDown;

class Dropdown extends BootstrapDropDown
{
    public function run()
    {
        return $this->renderItems($this->items, $this->options);
    }
}