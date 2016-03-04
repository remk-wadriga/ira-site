<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 17:08
 */

namespace components;

use Yii;
use yii\i18n\Formatter;

class FormatterService extends Formatter
{
    public function asDatetime($value = 'NOW', $format = null)
    {
        return parent::asDatetime($value, $format);
    }
}