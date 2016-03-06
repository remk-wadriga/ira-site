<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:50
 */

namespace components;

use yii\web\User;
use models\User as Identity;

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
        return $this->identity !== null ? $this->identity->getRole() : Identity::ROLE_GUEST;
    }
    public function getIsAdmin()
    {
        return $this->getRole() == Identity::ROLE_ADMIN;
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