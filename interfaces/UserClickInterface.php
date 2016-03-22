<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 22.03.2016
 * Time: 18:42
 */

namespace interfaces;


interface UserClickInterface extends ModelInterface
{
    /**
     * @param string $type
     * @param integer $userID
     * @return integer
     */
    public function getClicksCount($type, $userID = 0);
}