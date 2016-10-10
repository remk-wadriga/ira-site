<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use yii\db\ActiveQuery;
use interfaces\StoryInterface;
use interfaces\FileModelInterface;
use interfaces\ImagedEntityInterface;
use interfaces\UserClickInterface;
use interfaces\CpuUrlsInterface;
use admin\listeners\EventListener;
use events\EventEvent;
use yii\db\Query;
use yii\helpers\Json;
use behaviors\CpuUrls;
use yii\helpers\Url;

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
 * @property string $citation
 * @property string $url
 *
 * @property string $defaultAddress
 * @property string $statusName
 * @property string $typeName
 * @property array $imagesUrls
 * @property string $mainImageUrl
 * @property integer $actualUsersCount
 * @property integer $recordedUsersCount
 * @property integer $comeUsersCount
 * @property integer $notComeUsersCount
 * @property integer $allUsersCount
 * @property string[] $tags
 * @property Comment[] $lastComments
 * @property integer $interestedUsersCount
 * @property array $interestedUsersNames
 * @property array $trainersItems
 * @property User[] $interestedUsers
 * @property string $cpuUrl
 *
 * @property User $owner
 * @property User[] $users
 * @property EventUser[] $usersAllRecords
 * @property EventUser[] $usersActiveRecords
 * @property EventUser[] $usersComeRecords
 * @property EventUser[] $usersNotComeRecords
 * @property User[] $recordedUsers
 * @property User[] $comeUsers
 * @property User[] $notComeUsers
 * @property Image[] $images
 * @property Image[] $allImages
 * @property Image $mainImage
 * @property Comment[] $comments
 * @property User[] $trainers
 */
class Event extends ModelAbstract implements StoryInterface, FileModelInterface, ImagedEntityInterface, UserClickInterface, CpuUrlsInterface
{
    const EVENT_STORY_CHANGED = 'story_changed';
    const EVENT_EVENT_DELETED = 'event_event_deleted';

    const TYPE_TRAINING = 'training';
    const TYPE_THERAPEUTIC_GROUP = 'therapeutic_group';
    const TYPE_WORKSHOP = 'workshop';
    const TYPE_PSYCHOLOGICAL_GAME = 'psychological_game';
    const TYPE_LECTURE = 'lecture';
    const TYPE_STUDY_GROUP = 'study_group';

    const STATUS_NEW = 'new';
    const STATUS_CURRENT = 'current';
    const STATUS_PAST = 'past';
    const STATUS_CANCELED = 'canceled';


    const STORY_ACTION_CREATED = 'Created';
    const STORY_ACTION_UPDATED = 'Updated';
    const STORY_ACTION_STARTED = 'Started';
    const STORY_ACTION_STOPPED = 'Stopped';
    const STORY_ACTION_CANCELED = 'Canceled';
    const STORY_ACTION_DELETED = 'Deleted';

    protected static $_types = [
        self::TYPE_TRAINING,
        self::TYPE_THERAPEUTIC_GROUP,
        self::TYPE_WORKSHOP,
        self::TYPE_PSYCHOLOGICAL_GAME,
        self::TYPE_LECTURE,
        self::TYPE_STUDY_GROUP,
    ];

    protected static $_statuses = [
        self::STATUS_NEW,
        self::STATUS_CURRENT,
        self::STATUS_PAST,
        self::STATUS_CANCELED,
    ];

    protected static $_typesNames = [
        self::TYPE_TRAINING => 'Training',
        self::TYPE_THERAPEUTIC_GROUP => 'Therapeutic group',
        self::TYPE_WORKSHOP => 'Workshop',
        self::TYPE_PSYCHOLOGICAL_GAME => 'Psychological game',
        self::TYPE_LECTURE => 'Lecture',
        self::TYPE_STUDY_GROUP => 'Study group',
    ];

    protected static $_statusesNames = [
        self::STATUS_NEW => 'New',
        self::STATUS_CURRENT => 'Current',
        self::STATUS_PAST => 'Past',
        self::STATUS_CANCELED => 'Canceled',
    ];

    protected static $_storyActions = [
        self::STORY_ACTION_CREATED,
        self::STORY_ACTION_UPDATED,
        self::STORY_ACTION_STARTED,
        self::STORY_ACTION_STOPPED,
        self::STORY_ACTION_CANCELED,
        self::STORY_ACTION_DELETED,
    ];

    private $_trainersChanged = false;

    public $hasOwner = false;
    public $hasFiles = false;
    public $img;
    public $cropInfo;
    public $imgWidth = 540;
    public $imgHeight = 320;
    public $userID;
    public $tag;

    public static function tableName()
    {
        return 'event';
    }

    public static function eventUserTableName()
    {
        return 'event_user';
    }

    public static function eventTrainerTableName()
    {
        return 'event_trainer';
    }

    public function rules()
    {
        return [
            [['name', 'price', 'type', 'status'], 'required'],
            [['ownerID', 'membersCount', 'inMainSlider'], 'integer'],
            [['description', 'citation', 'img'], 'string'],
            [['price', 'profit', 'cost'], 'number'],
            [['dateStart', 'dateEnd', 'hasOwner', 'cropInfo', 'userID', 'tag', 'trainersIDs'], 'safe'],
            [['name', 'ownerName'], 'string', 'max' => 255],
            [['address', 'url'], 'string', 'max' => 512],
            ['type', 'in', 'range' => self::$_types],
            ['status', 'in', 'range' => self::$_statuses],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif']],
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
            'mainImageUrl' => $this->t('Image'),
            'actualUsersCount' => $this->getActualUsersCountLabel(),
            'userID' => $this->t('User'),
            'citation' => $this->t('Citation'),
            'interestedUsersCount' => $this->t('Interested users'),
            'url' => $this->t('Url'),
            'dateStart' => $this->t('Start date'),
            'trainersIDs' => $this->t('Trainers'),
        ];
    }

    // Behaviors

    public function behaviors()
    {
        return [
            'cpuUrls' => CpuUrls::className(),
        ];
    }

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
    public function getUsersActiveRecords()
    {
        return $this->hasMany(EventUser::className(), ['event_id' => 'id'])->andWhere(['status' => EventUser::STATUS_RECORDED]);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsersComeRecords()
    {
        return $this->hasMany(EventUser::className(), ['event_id' => 'id'])->andWhere(['status' => EventUser::STATUS_CAME]);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsersNotComeRecords()
    {
        return $this->hasMany(EventUser::className(), ['event_id' => 'id'])->andWhere(['status' => EventUser::STATUS_NOT_CAME]);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsersAllRecords()
    {
        return $this->hasMany(EventUser::className(), ['event_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->via('usersAllRecords');
    }

    /**
     * @return ActiveQuery
     */
    public function getRecordedUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->via('usersActiveRecords');
    }

    /**
     * @return ActiveQuery
     */
    public function getComeUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->via('usersComeRecords');
    }

    /**
     * @return ActiveQuery
     */
    public function getNotComeUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->via('usersNotComeRecords');
    }

    /**
     * @return ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable(Image::entityImageTableName(), ['entity_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere([
                'entity_class' => self::className(),
                'is_main' => 0,
            ]);
        });
    }

    /**
     * @return ActiveQuery
     */
    public function getAllImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable(Image::entityImageTableName(), ['entity_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere([
                'entity_class' => self::className(),
            ]);
        });
    }

    /**
     * @return ActiveQuery
     */
    public function getMainImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id'])->viaTable(Image::entityImageTableName(), ['entity_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere([
                'entity_class' => self::className(),
                'is_main' => 1,
            ]);
        });
    }

    /**
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['entity_id' => 'id'])
            ->andWhere([
                'entity_class' => self::className(),
                'parent_id' => null,
            ]);
    }


    /**
     * @return ActiveQuery
     */
    public function getTrainers()
    {
        return $this->hasMany(User::className(), ['id' => 'trainer_id'])->viaTable(self::eventTrainerTableName(), ['event_id' => 'id'])
            ->andWhere(['role' => [User::ROLE_ADMIN, User::ROLE_TRAINER]]);
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
        if ($this->url === null) {
            $this->url = $this->createCpuUrl($this->name, $this->dateStart);
            $this->update(false, ['url']);
        }
        $this->setRTC('oldImg', $this->img);
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
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
        if (!$this->dateStart) {
            $this->dateStart = Yii::$app->time->getCurrentDateTime();
        }
        if (!$this->url) {
            $this->url = $this->createCpuUrl($this->name, $this->dateStart);
        }

        if ($this->isNewRecord) {
            $this->setStoryAction(self::STORY_ACTION_CREATED);
        } elseif (!$this->getStoryAction()) {
            $this->setStoryAction(self::STORY_ACTION_UPDATED);
        }

        if ($this->description) {
            $this->description = str_replace('&nbsp;', ' ', $this->description);
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
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
    // imagesUrls
    public function getImagesUrls()
    {
        return (array)$this->getRTC('imagesUrls');
    }
    public function setImagesUrls($images_urls)
    {
        $this->setRTC('imagesUrls', (array)$images_urls);
    }
    // trainersItems
    public function getTrainersItems()
    {
        return $this->getRTCItem('trainersItems', function () {
            $items = [];
            $trainers = $this->getTrainers()->select(['id', 'name' => 'CONCAT(first_name, " ", last_name, " (", email, ")")'])->asArray()->all();
            foreach ($trainers as $trainer) {
                $items[$trainer['id']] = $trainer['name'];
            }
            return $items;
        }, []);
    }
    public function setTrainersItems($items)
    {
        $this->_trainersChanged = $this->getTrainers() != $items;
        $this->setRTC('trainersItems', $items);
    }
    // trainersIDs
    public function getTrainersIDs()
    {
        return $this->getRTCItem('trainersIDs', function () {
            return array_keys($this->getTrainersItems());
        }, []);
    }
    public function setTrainersIDs($ids)
    {
        $this->setTrainersItems($ids);
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
        $this->on(self::EVENT_EVENT_DELETED, [EventListener::className(), 'handleEventDeleted']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = Yii::$app->getDb();
        $transaction = $db->beginTransaction();

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        // Create "Event story changed" event
        $event = new EventEvent();
        $this->trigger(self::EVENT_STORY_CHANGED, $event);

        if (!$event->isValid) {
            $transaction->rollBack();
            $this->addError('img', $event->message);
            return false;
        }

        $this->cropInfo = null;
        $transaction->commit();
        return true;
    }

    public function delete()
    {
        // Create "Event deleted" event
        $event = new EventEvent();
        $this->trigger(self::EVENT_EVENT_DELETED, $event);
        if (!$event->isValid) {
            $this->addError(null, $event->message);
            return false;
        }

        return parent::delete();
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

    public function isImageChanged()
    {
        return !empty($this->cropInfo) || $this->getRTC('oldImg') != $this->img;
    }

    public function isTrainersChanged()
    {
        return $this->_trainersChanged;
    }

    public function setIsMainImage($isMain)
    {
        $this->setRTC('isMainImg', $isMain);
    }

    public function getMainIMageUrl()
    {
        return $this->getRTCItem('mainImageUrl', function () {
            return $this->mainImage !== null ? $this->mainImage->url : false;
        }, false);
    }

    public function canUserRegister($userID = null)
    {
        if ($userID === null) {
            $userID = Yii::$app->user->id;
        }

        if (in_array($this->status, [self::STATUS_PAST, self::STATUS_CANCELED])) {
            return false;
        }
        if ($this->status == self::STATUS_CURRENT && !in_array($this->type, [self::TYPE_STUDY_GROUP, self::TYPE_LECTURE])) {
            return false;
        }

        $conditions = [
            'event_id' => $this->id,
            'user_id' => $userID,
        ];

        return EventUser::getCount($conditions) == 0;
    }

    public function setStoryAction($story_action)
    {
        if (in_array($story_action, self::$_storyActions)) {
            $this->setRTC('storyAction', $story_action);
        }
    }

    public function setStoryFields($fields)
    {
        $this->setRTC('storyFields', (array)$fields);
    }

    public function setStoryOldValues($values)
    {
        $this->setRTC('storyOldValues', (array)$values);
    }

    public function setStoryNewValues($values)
    {
        $this->setRTC('storyNewValues', (array)$values);
    }

    // actualUsersCount
    public function getActualUsersCount()
    {
        return $this->getRTCItem('actualUsersCount', function () {
            if ($this->status == self::STATUS_PAST) {
                return $this->getComeUsersCount();
            } else {
                return $this->getRecordedUsersCount();
            }
        }, 0);
    }
    // recordedUsersCount
    public function getRecordedUsersCount()
    {
        return $this->getRTCItem('recordedUsersCount', function () {
            return $this->getUsersActiveRecords()->count();
        }, 0);
    }
    // comeUsersCount
    public function getComeUsersCount()
    {
        return $this->getRTCItem('comeUsersCount', function () {
            return $this->getUsersComeRecords()->count();
        }, 0);
    }
    // notComeUsersCount
    public function getNotComeUsersCount()
    {
        return $this->getRTCItem('notComeUsersCount', function () {
            return $this->getUsersNotComeRecords()->count();
        }, 0);
    }
    // allUsersCount
    public function getAllUsersCount()
    {
        return $this->getRTCItem('allUsersCount', function () {
            return $this->getUsersAllRecords()->count();
        }, 0);
    }
    // actualUsersCountLabel
    public function getActualUsersCountLabel()
    {
        $label = 'Recorded users';
        if ($this->status == self::STATUS_PAST) {
            $label = 'Came users';
        }
        return $this->t($label);
    }
    // notRegisteredUsersItems
    public function getNotRegisteredUsersItems($firstElement = null)
    {
        return $this->getRTCItem('notRegisteredUsersItems', function () use ($firstElement) {
            $items = [];
            if ($firstElement !== null) {
                $items[] = $firstElement;
            }
            foreach ($this->getNotRecordedUsers() as $user) {
                $items[$user->id] = $user->fullName;
            }
            return $items;
        }, []);
    }
    // tags
    public function getTags()
    {
        return $this->getRTCItem('tags', function () {
            return Tag::getEntityTags(self::className(), $this->id);
        }, []);
    }
    // lastComments
    public function getLastComments($count = 5)
    {
        return $this->getRTCItem("lastComments{$count}", function () use ($count) {
            return Comment::find()
                ->where([
                    'entity_id' => $this->id,
                    'entity_class' => self::className(),
                ])
                ->limit($count)
                ->orderBy(['date' => SORT_DESC])
                ->all();
        }, []);
    }
    // notRecordedUsers
    /**
     * @return User[]
     */
    public function getNotRecordedUsers()
    {
        return $this->getRTCItem('notRecordedUsers', function () {
            $recordsCommand = (new Query())
                ->select('user_id')
                ->from(EventUser::tableName())
                ->where(['event_id' => $this->id])
                ->createCommand();

            $recordsSql = $recordsCommand->sql;
            $recordsParams = $recordsCommand->params;

            return User::find()
                ->where("id NOT IN($recordsSql)")
                ->addParams($recordsParams)
                ->all();
        }, []);
    }
    // interestedUsers
    /**
     * @return User[]
     */
    public function getInterestedUsers()
    {
        return UserClick::getUsers(UserClick::TYPE_INTEREST, self::className(), $this->id);
    }
    // interestedUsersCount
    public function getInterestedUsersCount()
    {
        return $this->getClicksCount(UserClick::TYPE_INTEREST, null);
    }
    // interestedUsersNames
    public function getInterestedUsersNames()
    {
        return $this->getRTCItem('interestedUsersNames', function () {
            $names = [];
            foreach ($this->getInterestedUsers() as $user) {
                $names[] = $user->fullName;
            }
            return $names;
        }, []);
    }
    // cpuUrl
    public function getCpuUrl()
    {
        $id = $this->url ? $this->url : $this->id;
        return Url::to(['/front/event/view', 'id' => $id]);
    }

    public function saveTrainers()
    {
        $result = true;

        // Get DB connection instance and begin transaction
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        // Remove old trainers
        $db->createCommand()->delete(self::eventTrainerTableName(), ['event_id' => $this->id])->execute();

        // Write new trainers (if exist)
        if (!empty($this->getTrainersItems())) {
            // Create insert data array
            $insertData = array_map(function ($id) {
                return [
                    $this->id,
                    $id,
                ];
            }, $this->getTrainersItems());

            // Try to write changes in "event_trainers" table
            $result = $db->createCommand()->batchInsert(self::eventTrainerTableName(), ['event_id', 'trainer_id'], $insertData)->execute();
        }

        if (!$result) {
            $transaction->rollBack();
        }

        // Commit the transaction
        $transaction->commit();
        return $result;
    }

    // END Public methods


    // Public static methods

    public static function getAttributesNames()
    {
        $dateFormat = Yii::$app->time->dbDateTimeFormat;
        return [
            'id',
            'ownerID' => 'owner_id',
            'name',
            'ownerName' => 'ownerName',
            'description',
            'citation',
            'membersCount',
            'address',
            'price',
            'cost',
            'type',
            'status',
            'dateStart' => "DATE_FORMAT(date_start, '{$dateFormat}')",
            'dateEnd' => "DATE_FORMAT(date_end, '{$dateFormat}')",
            'inMainSlider' => 'in_main_slider',
        ];
    }

    public static function getRandomList($limit = 20)
    {
        return self::find()
            ->where(['!=', 'status', self::STATUS_CANCELED])
            ->orderBy('RAND()')
            ->limit($limit)
            ->all();
    }

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
        if (($action = $this->getRTC('storyAction')) === null) {
            $action = self::STORY_ACTION_UPDATED;
        }
        return $action;
    }
    public function getStoryFields()
    {
        if (empty($this->getRTC('storyFields')) && !$this->getIsNewRecord()) {
            $this->setStoryFields($this->getChangedAttributes());
        }
        return $this->getRTC('storyFields');
    }
    public function getStoryOldValues()
    {
        $values = $this->getRTC('storyOldValues');
        if (empty($values) && !empty($this->getStoryFields())) {
            $this->setStoryOldValues($this->getOldAttributes($this->getStoryFields()));
        }
        return $this->getRTC('storyOldValues');
    }
    public function getStoryNewValues()
    {
        $values = $this->getRTC('storyNewValues');
        if (empty($values) && !empty($this->getStoryFields())) {
            $this->setStoryNewValues($this->getAttributes($this->getStoryFields()));
        }
        return $this->getRTC('storyNewValues');
    }

    // END Implements StoryInterface


    // Implements FileModelInterface

    public function getFileAttributeName()
    {
        return 'img';
    }

    public function getModelInstance()
    {
        return $this;
    }

    public function getOldFileName()
    {
        return null;
    }

    public function setFileName($fileName)
    {
        $this->img = $fileName;
    }

    public function getCropInfo()
    {
        return $this->cropInfo ? Json::decode($this->cropInfo)[0] : [
            'dWidth' => 320,
            'dHeight' => 160,
        ];
    }

    public function getImgWidth()
    {
        return $this->cropInfo ? $this->imgWidth : 320;
    }

    public function getImgHeight()
    {
        return $this->cropInfo ? $this->imgHeight : 160;
    }

    // END Implements FileModelInterface


    // Implements ImagedEntityInterface

    public function getImgUrl()
    {
        return $this->img;
    }

    public function getImgAlt()
    {
        return null;
    }

    public function isMainImage()
    {
        return (bool)$this->getRTC('isMainImg');
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


    // Implements UserClickInterface

    public function getClicksCount($type, $userID = 0)
    {
        return $this->getRTCItem("userClicks_{$type}_{$userID}", function () use ($type, $userID) {
            return UserClick::count($type, self::className(), $this->id, $userID);
        }, 0);
    }

    // END Implements UserClickInterface

    // Implements CpuUrlsInterface

    public function getCountBySpuUrl($url)
    {
        return self::find()->where(['url' => $url])->count();
    }

    // END Implements CpuUrlsInterface
}
