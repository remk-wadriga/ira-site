<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 14:30
 */

namespace models;

use Yii;
use abstracts\ModelAbstract;
use interfaces\IdentityInterface;
use DateTime;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $passwordHash
 * @property string $firstName
 * @property string $lastName
 * @property string $phone
 * @property string $avatar
 * @property string $role
 * @property string $status
 * @property string $info
 * @property string $dateRegister
 * @property string $dateLastLogin
 * @property string $passwordRepeat
 *
 * @property string $roleName
 * @property string $statusName
 */
class User extends ModelAbstract implements IdentityInterface
{
    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    const STATUS_ACTIVE = 'active';
    const STATUS_FROZEN = 'frozen';
    const STATUS_BANNED = 'banned';
    const STATUS_DELETED = 'deleted';

    public $rememberMe = true;

    private static $_roles = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
    ];

    private static $_statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_FROZEN,
        self::STATUS_BANNED,
        self::STATUS_DELETED,
    ];

    private static $_rolesNames = [
        self::ROLE_USER => 'User',
        self::ROLE_ADMIN => 'Admin',
    ];

    private static $_statusesNames = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_FROZEN => 'Frozen',
        self::STATUS_BANNED => 'Banned',
        self::STATUS_DELETED => 'Deleted',
    ];

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['email', 'firstName', 'dateRegister', 'passwordHash'], 'required'],
            ['email', 'unique'],
            [['password', 'passwordRepeat'], 'required', 'when' => function (User $model) {
                return $model->getIsNewRecord();
            }],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords don`t match'],
            ['role', 'in', 'range' => self::$_roles],
            ['status', 'in', 'range' => self::$_statuses],
            [['email', 'avatar', 'password', 'passwordHash'], 'string', 'max' => 255],
            [['firstName', 'lastName'], 'string', 'max' => 126],
            [['phone'], 'string', 'max' => 24],
            ['info', 'string'],
            [['dateRegister', 'dateLastLogin', 'rememberMe'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => $this->t('Email'),
            'password' => $this->t('Password'),
            'passwordRepeat' => $this->t('Repeat password'),
            'firstName' => $this->t('First name'),
            'lastName' => $this->t('Last name'),
            'phone' => $this->t('Phone'),
            'info' => $this->t('Info'),
        ];
    }

    // Behaviors

    // END Behaviors


    // Depending

    // END Depending


    // Event handlers

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->dateRegister) {
            $this->dateRegister = Yii::$app->time->getCurrentDateTime();
        }
        if (!$this->passwordHash) {
            $this->passwordHash = $this->generatePasswordHash();
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->dateRegister) {
            $this->dateRegister = Yii::$app->time->formatDateTime($this->dateRegister);
        }
        if ($this->dateLastLogin) {
            $this->dateLastLogin = Yii::$app->time->formatDateTime($this->dateLastLogin);
        }

        return true;
    }

    // END Event handlers


    // Getters and setters

    // firstName
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    // lastName
    public function getLastName()
    {
        return $this->last_name;
    }
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    // dateRegister
    public function getDateRegister()
    {
        return $this->date_register;
    }
    public function setDateRegister($date_register)
    {
        $this->date_register = $date_register;
    }

    // dateLastLogin
    public function getDateLastLogin()
    {
        return $this->date_last_login;
    }
    public function setDateLastLogin($date_last_login)
    {
        $this->date_last_login = $date_last_login;
    }

    // passwordHash
    public function getPasswordHash()
    {
        return $this->password_hash;
    }
    public function setPasswordHash($password_hash)
    {
        $this->password_hash = $password_hash;
    }

    // password
    public function getPassword()
    {
        return $this->getRTC('password');
    }
    public function setPassword($password)
    {
        $this->setRTC('password', $password);
    }

    // passwordRepeat
    public function getPasswordRepeat()
    {
        return $this->getRTC('passwordRepeat');
    }
    public function setPasswordRepeat($passwordRepeat)
    {
        $this->setRTC('passwordRepeat', $passwordRepeat);
    }

    // END Getters and setters


    // Public methods

    public function getRoleName($role = null)
    {
        if ($role === null) {
            $role = $this->role;
        }
        $name = isset(self::$_roles[$role]) ? self::$_roles[$role] : self::$_roles[self::ROLE_USER];
        return $this->t($name);
    }

    public function getStatusName($status = null)
    {
        if ($status === null) {
            $status = $this->status;
        }
        $name = isset(self::$_statuses[$status]) ? self::$_roles[$status] : self::$_statuses[self::STATUS_ACTIVE];
        return $this->t($name);
    }

    /**
     * @return null|User
     */
    public function getAccount()
    {
        if (!$this->email) {
            $this->addError('email', $this->t('Email can not be empty'));
            return null;
        }
        if (!$this->password) {
            $this->addError('password', $this->t('Password can not be empty'));
            return null;
        }

        $account = self::findOne(['email' => $this->email]);
        if ($account === null) {
            $this->addError('email', $this->t('Email or password is incorrect'));
            return null;
        }

        $this->dateRegister = $account->dateRegister;

        if ($account->passwordHash != $this->generatePasswordHash()) {
            $this->addError('email', $this->t('Email or password is incorrect'));
            return null;
        }

        return $account;
    }

    public function getSessionTime()
    {
        return $this->rememberMe ? 3600*24*7 : Yii::$app->params['userSessionTime'];
    }

    // END Public methods


    // Public static methods

    // END Public static methods


    // Protected methods

    // END Protected methods


    // Protected static methods

    // END Protected static methods


    // Private methods

    private function generatePasswordHash($password = null)
    {
        if ($password === null) {
            $password = $this->getPassword();
        }
        if (!$password) {
            return null;
        }

        $date = Yii::$app->time->formatDateTime($this->dateRegister);

        return md5($date . trim($password) . trim($this->email) . Yii::$app->params['salt']);
    }

    // END Private methods


    // Private static methods

    // END Private static methods


    // Implements IdentityInterface

    /**
     * @param int|string $id
     * @return null|User
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @param string $token
     * @param string $type
     * @return null|User
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    // END Implements IdentityInterface
}