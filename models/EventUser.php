<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use front\listeners\EventUserListener;
use events\EventUserEvent;
use interfaces\StoryInterface;

/**
 * This is the model class for table "event_user".
 *
 * @property integer $id
 * @property integer $eventID
 * @property integer $userID
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $comment
 * @property string $status
 * @property string $dateRegistration
 *
 * @property Event $event
 * @property User $user
 */
class EventUser extends ModelAbstract implements StoryInterface
{
    const STATUS_RECORDED = 'recorded';
    const STATUS_COME = 'come';
    const STATUS_NOT_COME = 'not_come';

    const EVENT_USER_REGISTER = 'user_register';
    const EVENT_USER_AFTER_REGISTER = 'user_after_register';

    protected static $_statuses = [
        self::STATUS_RECORDED,
        self::STATUS_COME,
        self::STATUS_NOT_COME,
    ];

    protected static $_statusesNames = [
        self::STATUS_RECORDED => 'Recorded',
        self::STATUS_COME => 'Come',
        self::STATUS_NOT_COME => 'Not come',
    ];

    public $password;
    public $passwordRepeat;
    public $registerInSite = true;

    public static function tableName()
    {
        return 'event_user';
    }

    public function rules()
    {
        return [
            [['eventID', 'userID'], 'integer'],
            [['email', 'eventID', 'status', 'dateRegistration'], 'required'],
            [['email', 'name', 'password', 'passwordRepeat'], 'string', 'max' => 255],
            ['email', 'unique'],
            [['comment'], 'string'],
            [['email', 'name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 26],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords don`t match'],
            ['status', 'in', 'range' => self::$_statuses],
            [['registerInSite'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => $this->t('Email'),
            'password' => $this->t('Password'),
            'passwordRepeat' => $this->t('Repeat password'),
            'name' => $this->t('Name'),
            'phone' => $this->t('Phone'),
            'comment' => $this->t('Comment'),
            'registerInSite' => $this->t('Register in site'),
        ];
    }

    // Behaviors

    // END Behaviors


    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    // END Depending


    // Event handlers

    public function afterFind()
    {
        parent::afterFind();

        $this->setRTC('oldStatus', $this->status);
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->status) {
            $this->status = self::STATUS_RECORDED;
        }
        if (!$this->dateRegistration) {
            $this->dateRegistration = Yii::$app->time->getCurrentDateTime();
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->dateRegistration) {
            $this->dateRegistration = Yii::$app->time->formatDateTime($this->dateRegistration);
        }

        return true;
    }

    // END Event handlers


    // Getters and setters

    // eventID
    public function getEventID()
    {
        return $this->event_id;
    }
    public function setEventID($event_id)
    {
        $this->event_id = $event_id;
    }

    // userID
    public function getUserID()
    {
        return $this->user_id;
    }
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;
    }

    // dateRegistration
    public function getDateRegistration()
    {
        return $this->date_registration;
    }
    public function setDateRegistration($date_registration)
    {
        $this->date_registration = $date_registration;
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_USER_REGISTER, [EventUserListener::className(), 'handleUserRegister']);
        $this->on(self::EVENT_USER_AFTER_REGISTER, [EventUserListener::className(), 'handleUserAfterRegister']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = Yii::$app->getDb();
        $transaction = $db->beginTransaction();
        $isNew = $this->getIsNewRecord();
        $this->setRTC('isNewRecord', $isNew);

        if ($isNew) {
            // Create "User registered to event" event
            $event = new EventUserEvent();
            $this->trigger(self::EVENT_USER_REGISTER, $event);
            if (!$event->isValid) {
                $transaction->rollBack();
                $this->addError(null, $event->message);
                return false;
            }
        }

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        // Create "User registration to event change" event
        $event = new EventUserEvent();
        $this->trigger(self::EVENT_USER_AFTER_REGISTER, $event);
        if (!$event->isValid) {
            $transaction->rollBack();
            $this->addError(null, $event->message);
            return false;
        }

        $transaction->commit();
        return true;
    }

    // END Public methods


    // Public static methods

    // END Public static methods


    // Protected methods

    // END Protected methods


    // Protected static methods

    // END Protected static methods


    // Private methods

    // END Private methods


    // Private static methods

    // END Private static methods


    // Implements StoryInterface

    public function getStoryAction()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getStoryFields()
    {
        if (!$this->getRTC('isNewRecord')) {
            return ['status'];
        } else {
            return null;
        }
    }

    public function getStoryOldValues()
    {
        if (!$this->getRTC('isNewRecord')) {
            return ['status' => $this->getRTC('oldStatus')];
        } else {
            return null;
        }
    }

    public function getStoryNewValues()
    {
        if (!$this->getRTC('isNewRecord')) {
            return ['status' => $this->status];
        } else {
            return null;
        }
    }

    // END Implements StoryInterface
}
