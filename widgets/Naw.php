<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 0:39
 */

namespace widgets;

use yii\bootstrap\Nav as BootstrapNaw;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class Naw extends BootstrapNaw
{
    public function init()
    {
        parent::init();

        Html::removeCssClass($this->options, ['widget' => 'nav']);
        $this->dropDownCaret = null;
    }

    public function run()
    {
        return $this->renderItems();
    }

    protected function renderDropdown($items, $parentItem)
    {
        return Dropdown::widget([
            'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
            'items' => $items,
            'encodeLabels' => $this->encodeLabels,
            'clientOptions' => false,
            'view' => $this->getView(),
        ]);
    }

    protected function registerPlugin($name)
    {

    }

    protected function registerClientEvents()
    {

    }
}