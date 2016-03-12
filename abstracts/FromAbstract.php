<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 20:32
 */

namespace abstracts;

use Yii;
use yii\base\Model;

abstract class FromAbstract extends Model
{
    public function t($message, $params = [], $direction = 'app')
    {
        return Yii::$app->view->t($message, $params, $direction);
    }
}