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
use interfaces\StoryInterface;
use interfaces\FileModelInterface;
use interfaces\ImagedEntityInterface;
use yii\db\Query;
use admin\listeners\UserListener;
use events\UserEvent;
use yii\helpers\Json;

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
 * @property string $role
 * @property string $status
 * @property string $info
 * @property string $dateRegister
 * @property string $dateLastLogin
 * @property boolean $mailDeliveryAllowed
 * @property integer $mailDeliveryToken
 *
 * @property string $passwordRepeat
 * @property string $fullName
 * @property string $avatarUrl
 * @property string $avatarAlt
 * @property string $roleName
 * @property string $statusName
 *
 * @property Image $mainImage
 */
class User extends ModelAbstract implements IdentityInterface, StoryInterface, FileModelInterface, ImagedEntityInterface
{
    const EVENT_CHANGED = 'event_changed';

    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_TRAINER = 'trainer';

    const STATUS_ACTIVE = 'active';
    const STATUS_FROZEN = 'frozen';
    const STATUS_BANNED = 'banned';
    const STATUS_DELETED = 'deleted';

    const STORY_ACTION_REGISTRATION = 'Registration';
    const STORY_ACTION_CREATED = 'Created';
    const STORY_ACTION_CREATED_BY_EVENT_RECORD = 'Created by event record';
    const STORY_ACTION_LOGIN = 'Login';
    const STORY_ACTION_LOGOUT = 'Logout';
    const STORY_ACTION_ACTIVATED = 'Activated';
    const STORY_ACTION_FROZEN = 'Frozen';
    const STORY_ACTION_BANNED = 'Banned';
    const STORY_ACTION_DELETED = 'Deleted';
    const STORY_ACTION_UPDATED = 'Updated';
    const STORY_ACTION_CHANGE_ROLE = 'Change role';
    const STORY_ACTION_MAIL_DELIVERY_UNFOLLOW = 'Mail delivery unfollow';
    const STORY_ACTION_MAIL_DELIVERY_SUBSCRIBED = 'Mail delivery subscribed';

    public $password;
    public $rememberMe = true;
    public $isRegistered = false;
    public $avatar;
    public $cropInfo;
    public $imgWidth = 400;
    public $imgHeight = 350;

    private static $_roles = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
        self::ROLE_TRAINER,
    ];

    private static $_statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_FROZEN,
        self::STATUS_BANNED,
        self::STATUS_DELETED,
    ];

    private static $_storyActions = [
        self::STORY_ACTION_REGISTRATION,
        self::STORY_ACTION_CREATED,
        self::STORY_ACTION_CREATED_BY_EVENT_RECORD,
        self::STORY_ACTION_LOGIN,
        self::STORY_ACTION_LOGOUT,
        self::STORY_ACTION_ACTIVATED,
        self::STORY_ACTION_FROZEN,
        self::STORY_ACTION_BANNED,
        self::STORY_ACTION_DELETED,
        self::STORY_ACTION_UPDATED,
        self::STORY_ACTION_CHANGE_ROLE,
        self::STORY_ACTION_MAIL_DELIVERY_UNFOLLOW,
        self::STORY_ACTION_MAIL_DELIVERY_SUBSCRIBED,
    ];

    private static $_rolesNames = [
        self::ROLE_USER => 'User',
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_TRAINER => 'Trainer',
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

    public static function userMailDeliveryTableName()
    {
        return 'user_mail_delivery';
    }

    public function rules()
    {
        $rules = [
            [['email', 'firstName', 'dateRegister', 'passwordHash'], 'required'],
            ['email', 'unique'],
            ['avatar', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif']],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords don`t match'],
            ['role', 'in', 'range' => self::$_roles],
            ['status', 'in', 'range' => self::$_statuses],
            [['email', 'avatar', 'password', 'passwordHash'], 'string', 'max' => 255],
            [['firstName', 'lastName'], 'string', 'max' => 126],
            [['phone'], 'string', 'max' => 24],
            [['mailDeliveryToken'], 'string', 'max' => 64],
            ['info', 'string'],
            [['dateRegister', 'rememberMe', 'isRegistered', 'cropInfo'], 'safe'],
            ['mailDeliveryAllowed', 'boolean'],
        ];

        if ($this->isNewRecord) {
            $rules[] = [['password', 'passwordRepeat'], 'required'];
        }

        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'email' => $this->t('Email'),
            'password' => $this->t('Password'),
            'passwordRepeat' => $this->t('Repeat password'),
            'firstName' => $this->t('First name'),
            'lastName' => $this->t('Last name'),
            'fullName' => $this->t('Name'),
            'phone' => $this->t('Phone'),
            'info' => $this->t('Info'),
            'isRegistered' => $this->t('Registered user'),
            'avatar' => $this->t('Avatar'),
            'roleName' => $this->t('Role'),
            'statusName' => $this->t('Status'),
            'dateRegister' => $this->t('Registration date'),
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
        if ($this->password) {
            $this->passwordHash = $this->generatePasswordHash();
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->setRTC('oldRole', $this->role);
        $this->setRTC('oldStatus', $this->status);
        $this->setRTC('oldAvatarUrl', $this->avatarUrl);
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
    // fullName
    public function getFullName()
    {
        return $this->getRTCItem('fullName', function () {
            $name = $this->firstName;
            if ($this->lastName) {
                $name .= ' ' . $this->lastName;
            }
            return $name;
        }, null);
    }
    public function setFullName($full_name)
    {
        $this->setRTC('fullName', $full_name);
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
        return $this->getRTCItem('date_last_login', function () {
            return (new Query())
                ->from(Story::tableName())
                ->where([
                    'target_id' => $this->id,
                    'target_class' => self::className(),
                    'action' => self::STORY_ACTION_LOGIN,
                ])
                ->max('date');
        }, null);
    }
    public function setDateLastLogin($date_last_login)
    {
        $this->setRTC('date_last_login', Yii::$app->time->formatDateTime($date_last_login));
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
    // passwordRepeat
    public function getPasswordRepeat()
    {
        return $this->getRTC('passwordRepeat');
    }
    public function setPasswordRepeat($passwordRepeat)
    {
        $this->setRTC('passwordRepeat', $passwordRepeat);
    }
    // avatarUrl
    public function getAvatarUrl()
    {
        return $this->getRTCItem('avatarUrl', function () {
            return $this->getMainImage() !== null ? $this->getMainImage()->url : '';
        }, null);
    }
    public function setAvatarUrl($avatar_url)
    {
        $this->setRTC('avatarUrl', $avatar_url);
    }
    // avatarAlt
    public function getAvatarAlt()
    {
        return $this->getRTCItem('avatarAlt', function () {
            return $this->getMainImage() !== null ? $this->getMainImage()->alt : '';
        }, null);
    }
    public function setAvatarAlt($avatar_alt)
    {
        $this->setRTC('avatarAlt', $avatar_alt);
    }
    // mailDeliveryAllowed
    public function getMailDeliveryAllowed()
    {
        return (bool)$this->mail_delivery_allowed;
    }
    public function setMailDeliveryAllowed($mail_delivery_allowed)
    {
        $this->mail_delivery_allowed = (int)$mail_delivery_allowed;
    }
    // mailDeliveryToken
    public function getMailDeliveryToken()
    {
        return $this->mail_delivery_token;
    }
    public function setMailDeliveryToken($mail_delivery_token)
    {
        $this->mail_delivery_token = $mail_delivery_token;
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_CHANGED, [UserListener::className(), 'handleUserChanged']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = Yii::$app->getDb();
        $transaction = $db->beginTransaction();

        $action = $this->getStoryAction();
        if ($action === null) {
            $action = self::STORY_ACTION_UPDATED;
            $this->setStoryAction($action);
        }

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        if (!in_array($action, [self::STORY_ACTION_LOGIN, self::STORY_ACTION_LOGOUT, self::STORY_ACTION_REGISTRATION])) {
            // Create "User changed" event
            $event = new UserEvent();
            $this->trigger(self::EVENT_CHANGED, $event);
            if (!$event->isValid) {
                $transaction->rollBack();
                $this->addError(null, $event->message);
                return false;
            }
        }

        $this->cropInfo = null;
        $transaction->commit();
        return true;
    }

    public function getRoleName($role = null)
    {
        if ($role === null) {
            $role = $this->role;
        }
        $name = isset(self::$_rolesNames[$role]) ? self::$_rolesNames[$role] : self::$_rolesNames[self::ROLE_USER];
        return $this->t($name);
    }

    public function getStatusName($status = null)
    {
        if ($status === null) {
            $status = $this->status;
        }
        $name = isset(self::$_statusesNames[$status]) ? self::$_statusesNames[$status] : self::$_statusesNames[self::STATUS_ACTIVE];
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

    public function setStoryAction($action)
    {
        if (in_array($action, self::$_storyActions)) {
            $this->setRTC('storyAction', $action);
        }
    }

    public function getRolesItems($firstElement = null)
    {
        if ($this->role === null) {
            $this->role = self::ROLE_USER;
        }
        return $this->getEnumNames(self::$_rolesNames, 'rolesItems', $firstElement);
    }

    public function getStatusesItems($firstElement = null)
    {
        if ($this->status === null) {
            $this->status = self::STATUS_ACTIVE;
        }
        return $this->getEnumNames(self::$_statusesNames, 'statusesItems', $firstElement);
    }

    public function isAvatarChanged()
    {
        return $this->getOldFileName() != $this->getAvatarUrl();
    }

    /**
     * @return Image|null
     */
    public function getMainImage()
    {
        return $this->getRTCItem('mainImage', function () {
            return Image::findEntityMainImage($this);
        }, null);
    }

    // END Public methods


    // Public static methods

    // END Public static methods


    // Protected methods

    // END Protected methods


    // Protected static methods

    protected static function getItemsNames()
    {
        return [
            'id',
            'name' => 'CONCAT_WS(\' \', `first_name`, `last_name`)',
        ];
    }

    // END Protected static methods


    // Private methods

    private function generatePasswordHash($password = null)
    {
        if ($password === null) {
            $password = $this->password;
        }
        if (!$password) {
            return null;
        }

        return md5('123' . trim($password) . ':' . trim($this->email) . Yii::$app->params['salt']);
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

    public function getRole()
    {
        return $this->role;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    
   public function setIsSubscribed($var)
   {
       $var = (bool)$var;
       if ($var === true) {
           $this->setStoryAction(self::STORY_ACTION_MAIL_DELIVERY_SUBSCRIBED);
       } else {
            $this->setStoryAction(self::STORY_ACTION_MAIL_DELIVERY_UNFOLLOW);
       }

       $this->mailDeliveryAllowed = $var;
       return $this->save();
   }

    public function getIsSubscribed()
    {
        return $this->getRTCItem('isSubscribed', function () {
            return (bool)(new Query())
                ->select('mail_delivery_allowed')
                ->from(self::tableName())
                ->where(['id' => $this->id])
                ->scalar();
        }, false);
    }

    // END Implements IdentityInterface


    // Implements StoryInterface

    public function getStoryAction()
    {
        $action = $this->getRTC('storyAction');

        if ($action == self::STORY_ACTION_UPDATED) {
            if ($this->getRTC('oldStatus') != $this->status) {
                switch ($this->status) {
                    case self::STATUS_ACTIVE:
                        $action = self::STORY_ACTION_ACTIVATED;
                        break;
                    case self::STATUS_BANNED:
                        $action = self::STORY_ACTION_BANNED;
                        break;
                    case self::STATUS_FROZEN:
                        $action = self::STORY_ACTION_FROZEN;
                        break;
                    case self::STATUS_DELETED:
                        $action = self::STORY_ACTION_DELETED;
                        break;
                }
            } elseif ($this->getRTC('oldRole') != $this->role) {
                $action = self::STORY_ACTION_CHANGE_ROLE;
            }
        }
        $this->setStoryAction($action);
        return $action;
    }

    public function getStoryFields()
    {
        if (in_array($this->getStoryAction(), [self::STORY_ACTION_LOGIN, self::STORY_ACTION_LOGOUT, self::STORY_ACTION_REGISTRATION])) {
            return null;
        }

        if ($this->getStoryAction() == self::STORY_ACTION_MAIL_DELIVERY_UNFOLLOW) {
            return ['mail_delivery_allowed', 'mail_delivery_token'];
        } elseif ($this->getStoryAction() == self::STORY_ACTION_MAIL_DELIVERY_SUBSCRIBED) {
            return ['mail_delivery_allowed'];
        }

        $attributes = [];
        if ($this->getRTC('oldStatus') != $this->status) {
            $attributes[] = 'status';
        }
        if ($this->getRTC('oldRole') != $this->role) {
            $attributes[] = 'role';
        }
        if (empty($attributes)) {
            $attributes = $this->attributes();
        }
        return $attributes;
    }

    public function getStoryOldValues()
    {
        if (empty($fields = $this->getStoryFields())) {
            return null;
        }
        return $this->getOldAttributes($fields);
    }

    public function getStoryNewValues()
    {
        if (empty($fields = $this->getStoryFields())) {
            return null;
        }
        return $this->getAttributes($fields);
    }

    // END Implements StoryInterface


    // Implements FileModelInterface

    public function getFileAttributeName()
    {
        return 'avatar';
    }

    public function getModelInstance()
    {
        return $this;
    }

    public function getOldFileName()
    {
        return $this->getRTC('oldAvatarUrl');
    }

    public function setFileName($fileName)
    {
        $this->avatarUrl = $fileName;
    }

    public function getCropInfo()
    {
        if ($this->cropInfo !== null) {
            $this->cropInfo = Json::decode($this->cropInfo)[0];
        }
        return $this->cropInfo;
    }

    public function getImgWidth()
    {
        return $this->imgWidth;
    }

    public function getImgHeight()
    {
        return $this->imgHeight;
    }

    // END Implements FileModelInterface


    // Implements ImagedEntityInterface

    public function getImgUrl()
    {
        return $this->avatarUrl;
    }

    public function getImgAlt()
    {
        return $this->fullName;
    }

    public function isMainImage()
    {
        return true;
    }

    public function getImgID()
    {
        return $this->getRTC('imgID');
    }
    
    public function setImgID($ID)
    {
        $this->setRTC('imgID', $ID);
    }

    // END Implements ImagedEntityInterface
}