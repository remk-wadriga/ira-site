<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use yii\db\ActiveQuery;
use interfaces\StoryInterface;
use admin\listeners\EventListener;
use events\EventEvent;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $ownerID
 * @property string $ownerName
 * @property string $description
 * @property string $membersCount
 * @property string $address
 * @property double $price
 * @property double $profit
 * @property double $cost
 * @property string $type
 * @property string $status
 * @property string $dateStart
 * @property string $dateEnd
 * @property bool $inMainSlider
 *
 * @property string $defaultAddress
 * @property string $statusName
 * @property string $typeName
 *
 * @property User $owner
 * @property User[] $users
 * @property User[] $recordedUsers
 * @property User[] $comeUsers
 * @property User[] $notComeUsers
 */
class Event extends ModelAbstract implements StoryInterface
{
    const EVENT_STORY_CHANGED = 'story_changed';

    const TYPE_TRAINING = 'training';
    const TYPE_THERAPEUTIC_GROUP = 'therapeutic_group';
    const TYPE_WORKSHOP = 'workshop';
    const TYPE_PSYCHOLOGICAL_GAME = 'psychological_game';
    const TYPE_LECTURE = 'lecture';
    const TYPE_GROUP = 'study_group';

    const STATUS_NEW = 'new';
    const STATUS_CURRENT = 'current';
    const STATUS_PAST = 'past';
    const STATUS_CANCELED = 'canceled';

    const USER_RECORDED_STATUS = 'recorded';
    const USER_COME_STATUS = 'come';
    const USER_NOT_COME_STATUS = 'not_come';

    const STORY_ACTION_CREATED = 'Created';
    const STORY_ACTION_UPDATED = 'Updated';
    const STORY_ACTION_STARTED = 'Started';
    const STORY_ACTION_STOPPED = 'Stopped';
    const STORY_ACTION_CANCELED = 'Canceled';
    const STORY_ACTION_DELETED = 'Deleted';

    private static $_types = [
        self::TYPE_TRAINING,
        self::TYPE_THERAPEUTIC_GROUP,
        self::TYPE_WORKSHOP,
        self::TYPE_PSYCHOLOGICAL_GAME,
        self::TYPE_LECTURE,
        self::TYPE_GROUP,
    ];

    private static $_statuses = [
        self::STATUS_NEW,
        self::STATUS_CURRENT,
        self::STATUS_PAST,
        self::STATUS_CANCELED,
    ];

    private static $_userComeStatuses = [
        self::USER_RECORDED_STATUS,
        self::USER_COME_STATUS,
        self::USER_NOT_COME_STATUS,
    ];

    private static $_typesNames = [
        self::TYPE_TRAINING => 'Training',
        self::TYPE_THERAPEUTIC_GROUP => 'Therapeutic group',
        self::TYPE_WORKSHOP => 'Workshop',
        self::TYPE_PSYCHOLOGICAL_GAME => 'Psychological game',
        self::TYPE_LECTURE => 'Lecture',
        self::TYPE_GROUP => 'Study group',
    ];

    private static $_statusesNames = [
        self::STATUS_NEW => 'New',
        self::STATUS_CURRENT => 'Current',
        self::STATUS_PAST => 'Past',
        self::STATUS_CANCELED => 'Canceled',
    ];

    private static $_userComeStatusesNames = [
        self::USER_RECORDED_STATUS => 'Recorded',
        self::USER_COME_STATUS => 'Come',
        self::USER_NOT_COME_STATUS => 'Not come',
    ];

    private static $_storyActions = [
        self::STORY_ACTION_CREATED,
        self::STORY_ACTION_UPDATED,
        self::STORY_ACTION_STARTED,
        self::STORY_ACTION_STOPPED,
        self::STORY_ACTION_CANCELED,
        self::STORY_ACTION_DELETED,
    ];

    public $hasOwner = false;

    public static function tableName()
    {
        return 'event';
    }

    public static function eventUserTableName()
    {
        return 'event_user';
    }

    public function rules()
    {
        return [
            [['name', 'price', 'type', 'status', 'dateStart'], 'required'],
            [['ownerID', 'membersCount', 'inMainSlider'], 'integer'],
            [['description', 'type'], 'string'],
            [['price', 'profit', 'cost'], 'number'],
            [['dateStart', 'dateEnd', 'hasOwner'], 'safe'],
            [['name', 'ownerName'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 512],
            ['type', 'in', 'range' => self::$_types],
            ['status', 'in', 'range' => self::$_statuses],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => $this->t('Name'),
            'description' => $this->t('Description'),
            'address' => $this->t('Address'),
            'price' => $this->t('Price'),
            'cost' => $this->t('Cost'),
            'type' => $this->t('Type'),
            'status' => $this->t('Status'),
            'profit' => $this->t('Profit'),
            'ownerID' => $this->t('Owner'),
            'ownerName' => $this->t('Owner name'),
            'membersCount' => $this->t('Members count'),
            'hasOwner' => $this->t('Registered user'),
        ];
    }

    // Behaviors

    // END Behaviors


    // Depending

    /**
     * @return ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable(self::eventUserTableName(), ['event_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRecordedUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable(self::eventUserTableName(), ['event_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere(['status' => self::USER_RECORDED_STATUS]);
        });
    }

    /**
     * @return ActiveQuery
     */
    public function getComeUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable(self::eventUserTableName(), ['event_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere(['status' => self::USER_COME_STATUS]);
        });
    }

    /**
     * @return ActiveQuery
     */
    public function getNotComeUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable(self::eventUserTableName(), ['event_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere(['status' => self::USER_NOT_COME_STATUS]);
        });
    }

    // END Depending


    // Event handlers

    public function afterFind()
    {
        parent::afterFind();
        $this->hasOwner = $this->ownerID > 0;

        if ($this->status == self::STATUS_PAST && $this->profit == 0) {
            $this->profit = ($this->membersCount * $this->price) - $this->cost;
        }
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->dateStart) {
            $this->dateStart = Yii::$app->time->getCurrentDateTime();
        }
        if (!$this->status) {
            $this->status = self::STATUS_NEW;
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->dateEnd) {
            $this->dateEnd = Yii::$app->time->formatDateTime($this->dateEnd);
        }
        if (!$this->ownerID) {
            $this->ownerID = Yii::$app->user->id;
        }
        if (!$this->hasOwner) {
            $this->ownerID = null;
        }
        if (!$this->ownerName) {
            if ($this->ownerID) {
                $user = User::findOne($this->ownerID);
                if ($user !== null) {
                    $this->ownerName = $user->fullName;
                }
            } else {
                $this->ownerName = Yii::$app->user->fullName;
            }
        }

        if ($this->isNewRecord) {
            $this->setStoryAction(self::STORY_ACTION_CREATED);
        } elseif (!$this->getStoryAction()) {
            $this->setStoryAction(self::STORY_ACTION_UPDATED);
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Create "event story changed" event
        $event = new EventEvent();
        $this->trigger(self::EVENT_STORY_CHANGED, $event);
    }

    // END Event handlers


    // Getters and setters

    // ownerID
    public function getOwnerID()
    {
        return $this->owner_id;
    }
    public function setOwnerID($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    // ownerName
    public function getOwnerName()
    {
        if ($this->owner_name === null && $this->owner !== null) {
            $this->owner_name = $this->owner->fullName;
        }
        return $this->owner_name;
    }
    public function setOwnerName($owner_name)
    {
        $this->owner_name = $owner_name;
    }

    // membersCount
    public function getMembersCount()
    {
        return $this->members_count;
    }
    public function setMembersCount($members_count)
    {
        $this->members_count = $members_count;
    }

    // dateStart
    public function getDateStart()
    {
        return $this->date_start;
    }
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
    }

    // dateEnd
    public function getDateEnd()
    {
        return $this->date_end;
    }
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }

    // inMainSlider
    public function getInMainSlider()
    {
        return $this->in_main_slider;
    }
    public function setInMainSlider($in_main_slider)
    {
        $this->in_main_slider = $in_main_slider;
    }

    // defaultAddress
    public function getDefaultAddress()
    {
        $address = $this->getRTC('defaultAddress');
        if ($address === null) {
            $address = Yii::$app->params['mainAddress'];
            $this->setRTC('defaultAddress', $address);
        }
        return $address;
    }
    public function setDefaultAddress($default_address)
    {
        $this->setRTC('defaultAddress', $default_address);
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();

        if ($this->address === null) {
            $this->address = $this->getDefaultAddress();
        }

        $this->on(self::EVENT_STORY_CHANGED, [EventListener::className(), 'handleEventStoryChanged']);
    }

    public function getTypesItems($firstElement = null)
    {
        return parent::getEnumNames(self::$_typesNames, 'typesItems', $firstElement);
    }

    public function getStatusesItems($firstElement = null)
    {
        if ($this->status === null) {
            $this->status = self::STATUS_NEW;
        }
        return parent::getEnumNames(self::$_statusesNames, 'statusesItems', $firstElement);
    }

    public function getUserComeStatusesItems($firstElement = null)
    {
        return parent::getEnumNames(self::$_userComeStatusesNames, 'userComeStatusesItems', $firstElement);
    }

    public function setStoryAction($action = null)
    {
        if ($action === null) {
            switch ($this->status) {
                case self::STATUS_CURRENT:
                    $action = self::STORY_ACTION_STARTED;
                    break;
                case self::STATUS_PAST:
                    $action = self::STORY_ACTION_STOPPED;
                    break;
                case self::STATUS_CANCELED:
                    $action = self::STORY_ACTION_CANCELED;
                    break;
            }
        }

        if (in_array($action, self::$_storyActions)) {
            $this->setRTC('storyAction', $action);
        }
    }

    public function setStoryFields($fields)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }
        $this->setRTC('storyFields', $fields);
        $this->setRTC('storyOldValues', $this->getOldAttributes($fields));
        $this->setRTC('storyNewValues', $this->getAttributes($fields));
    }

    public function getStatusName($status = null)
    {
        if ($status === null) {
            $status = $this->status;
        }
        if (!isset(self::$_statusesNames[$status])) {
            $status = self::STATUS_NEW;
        }
        return $this->t(self::$_statusesNames[$status]);
    }

    public function getTypeName($type = null)
    {
        if ($type === null) {
            $type = $this->type;
        }
        if (!isset(self::$_typesNames[$type])) {
            $type = self::TYPE_TRAINING;
        }
        return $this->t(self::$_typesNames[$type]);
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
        return $this->getRTC('storyAction');
    }

    public function getStoryFields()
    {
        if ($this->getStoryAction() == self::STORY_ACTION_UPDATED) {
            return $this->attributes();
        } else {
            return $this->getRTC('storyFields');
        }
    }

    public function getStoryOldValues()
    {
        if ($this->getStoryAction() == self::STORY_ACTION_UPDATED) {
            return $this->getOldAttributes();
        } else {
            return $this->getRTC('storyOldValues');
        }
    }

    public function getStoryNewValues()
    {
        if ($this->getStoryAction() == self::STORY_ACTION_UPDATED) {
            return $this->getAttributes();
        } else {
            return $this->getRTC('storyNewValues');
        }
    }

    // END Implements StoryInterface
}
