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
 * @property string $fullName
 */
class UserService extends User
{
    const EVENT_AFTER_REGISTER = 'afterRegister';

    // Getters
    public function getRole()
    {
        return 'guest';
    }
    public function getIsAdmin()
    {
        return $this->getRole() == 'admin';
    }
    public function getFullName()
    {
        if ($this->identity === null) {
            return 'Guest';
        }

        return $this->identity->getFirstName() . ' ' . $this->identity->getLastName();
    }
    // END Getters
}