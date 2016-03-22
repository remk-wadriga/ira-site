<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:50
 */

namespace components;

use Yii;
use yii\base\ErrorException;
use yii\web\User;
use models\User as Identity;
use yii\web\UserEvent;

/**
 * Class UserService
 * @package components
 *
 * @property string $role
 * @property bool $isAdmin
 * @property \interfaces\IdentityInterface $identity
 * @property string $fullName
 * @property string $email
 * @property string $phone
 * @property string $ipAddress
 */
class UserService extends User
{
    const EVENT_AFTER_REGISTER = 'afterRegister';

    // Getters

    // role
    public function getRole()
    {
        return $this->identity !== null ? $this->identity->getRole() : Identity::ROLE_GUEST;
    }
    // isAdmin
    public function getIsAdmin()
    {
        return $this->getRole() == Identity::ROLE_ADMIN;
    }
    // fullName
    public function getFullName()
    {
        if ($this->identity === null) {
            return 'Guest';
        }
        return $this->identity->getFirstName() . ' ' . $this->identity->getLastName();
    }
    // email
    public function getEmail()
    {
        return $this->identity !== null ? $this->identity->getEmail() : null;
    }
    // phone
    public function getPhone()
    {
        return $this->identity !== null ? $this->identity->getPhone() : null;
    }
    // ipAddress
    public function getIpAddress()
    {
        return Yii::$app->request->getUserIP();
    }

    // END Getters

    public function register(Identity $user)
    {
        if (!$user->save()) {
            throw new ErrorException(Yii::$app->view->t('Can not register the user'));
        }
        $user->setStoryAction($user::STORY_ACTION_REGISTRATION);

        $this->identity = $user;

        // Create "user register" event
        $event = new UserEvent();
        $this->trigger(self::EVENT_AFTER_REGISTER, $event);

        $user->setStoryAction($user::STORY_ACTION_LOGIN);
        if (!$this->login($user, $user->getSessionTime())) {
            throw new ErrorException(Yii::$app->view->t('Can not login the user'));
        }
    }
}