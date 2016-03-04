<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:50
 */

namespace components;

use yii\web\User;

/**
 * Class UserService
 * @package components
 *
 * @property string $role
 * @property bool $isAdmin
 * @property \interfaces\IdentityInterface $identity
 */
class UserService extends User
{
    // Getters
    public function getRole()
    {
        return 'guest';
    }
    public function getIsAdmin()
    {
        return $this->getRole() == 'admin';
    }
    // END Getters
}