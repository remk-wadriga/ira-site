<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 14:22
 */

namespace abstracts;

use Yii;
use yii\db\ActiveRecord;

class ModelAbstract extends ActiveRecord
{
    public function modelName()
    {
        $classParts = explode('\\', self::className());
        return end($classParts);
    }

    public function t($message, $params = [], $direction = 'app')
    {
        return Yii::$app->view->t($message, $params, $direction);
    }
}