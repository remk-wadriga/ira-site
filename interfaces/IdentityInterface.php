<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 14:34
 */

namespace interfaces;

use yii\web\IdentityInterface as BaseIdentityInterface;

interface IdentityInterface extends BaseIdentityInterface
{
    /**
     * @param int|string $id
     * @return IdentityInterface
     */
    public static function findIdentity($id);

    /**
     * @param string $token
     * @param string $type
     * @return IdentityInterface
     */
    public static function findIdentityByAccessToken($token, $type = null);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @return integer
     */
    public function getID();

    /**
     * @return string
     */
    public function getRole();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param array $params
     * @return bool
     */
    public function load($params);

    /**
     * @return bool
     */
    public function save();

    /**
     * @param boolean $var
     * @return boolean
     */
    public function setIsSubscribed($var);

    /**
     * @return boolean
     */
    public function getIsSubscribed();
}