<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 05.03.2016
 * Time: 15:10
 */

namespace interfaces;

use yii\db\ActiveRecordInterface;

interface ModelInterface extends ActiveRecordInterface
{
    /**
     * @return integer
     */
    public function getID();
}