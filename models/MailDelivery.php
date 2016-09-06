<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use interfaces\StoryInterface;
use interfaces\FileModelInterface;
use interfaces\ImagedEntityInterface;
use events\MailDeliveryEvent;
use admin\listeners\MailDeliveryListener;
use yii\db\ActiveQuery;
use yii\helpers\Json;

/**
 * This is the model class for table "mail_delivery".
 *
 * @property integer $id
 * @property integer $authorID
 * @property string $name
 * @property string $title
 * @property string $message
 * @property string $dateCreate
 * @property string $dateSend
 * @property string $status
 *
 * @property string $statusName
 * @property string $imgUrl
 * @property bool $canStarted
 *
 * @property User $author
 * @property Image $image
 */
class MailDelivery extends ModelAbstract implements StoryInterface, FileModelInterface, ImagedEntityInterface
{
    const EVENT_STORY_CHANGED = 'mail_delivery_event_story_changed';
    const EVENT_DELETED = 'mail_delivery_deleted';
    const EVENT_STARTED = 'mail_delivery_started';

    const STORY_ACTION_CREATED = 'Created';
    const STORY_ACTION_ACTIVATED = 'Activated';
    const STORY_ACTION_UPDATED = 'Updated';
    const STORY_ACTION_STARTED = 'Started';
    const STORY_ACTION_FINISHED = 'Finished';
    const STORY_ACTION_CANCELED = 'Canceled';
    const STORY_ACTION_DELETED = 'Deleted';

    const STATUS_NEW = 'new';
    const STATUS_CURRENT = 'current';
    const STATUS_PAST = 'past';
    const STATUS_CANCELLED = 'cancelled';

    protected static $_statuses = [
        self::STATUS_NEW,
        self::STATUS_CURRENT,
        self::STATUS_PAST,
        self::STATUS_CANCELLED,
    ];

    protected static $_statusesNames = [
        self::STATUS_NEW => 'New',
        self::STATUS_CURRENT => 'Current',
        self::STATUS_PAST => 'Past',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    protected static $_storyActions = [
        self::STORY_ACTION_CREATED,
        self::STORY_ACTION_UPDATED,
        self::STORY_ACTION_STARTED,
        self::STORY_ACTION_FINISHED,
        self::STORY_ACTION_CANCELED,
        self::STORY_ACTION_DELETED,
    ];

    public $img;
    public $cropInfo;
    public $imgWidth = 400;
    public $imgHeight = 230;

    public static function tableName()
    {
        return 'mail_delivery';
    }

    public function rules()
    {
        return [
            [['name', 'message'], 'required'],
            [['authorID'], 'integer'],
            [['message'], 'string'],
            [['dateCreate', 'dateSend', 'cropInfo'], 'safe'],
            [['name', 'title'], 'string', 'max' => 255],
            ['status', 'in', 'range' => self::$_statuses],
            [['authorID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'authorID' => $this->t('Author'),
            'name' => $this->t('Name'),
            'title' => $this->t('Title'),
            'message' => $this->t('Message'),
            'dateCreate' => $this->t('Date create'),
            'dateSend' => $this->t('Date send'),
            'status' => $this->t('Status'),
            'authorName' => $this->t('Author'),
            'imgUrl' => $this->t('Image'),
            'statusName' => $this->t('Status'),
        ];
    }

    // Behaviors

    // END Behaviors


    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id'])->from(['author' => User::tableName()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id'])->viaTable(Image::entityImageTableName(), ['entity_id' => 'id'], function (ActiveQuery $query) {
            $query->andWhere([
                'entity_class' => self::className(),
                'is_main' => 1,
            ]);
        });
    }

    // END Depending


    // Event handlers

    public function afterFind()
    {
        parent::afterFind();

        $this->setRTC('oldImg', $this->getImgUrl());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->authorID === null) {
            $this->authorID = Yii::$app->user->id;
        }
        if (!$this->title && $this->name !== null) {
            $this->title = $this->name;
        }
        if ($this->status === null) {
            $this->status = self::STATUS_NEW;
        }

        if ($this->isNewRecord) {
            $this->setStoryAction(self::STORY_ACTION_CREATED);
        } elseif (!$this->getStoryAction()) {
            $this->setStoryAction(self::STORY_ACTION_UPDATED);
        }

        if ($this->message !== null) {
            $this->message = str_replace('&nbsp;', ' ', $this->message);
        }

        return true;
    }

    // END Event handlers


    // Getters and setters

    // authorID
    public function getAuthorID()
    {
        return $this->author_id;
    }
    public function setAuthorID($author_id)
    {
        $this->author_id = $author_id;
    }
    // dateCreate
    public function getDateCreate()
    {
        return $this->date_create;
    }
    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
    }
    // dateSend
    public function getDateSend()
    {
        return $this->date_send;
    }
    public function setDateSend($date_send)
    {
        $this->date_send = $date_send;
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_STORY_CHANGED, [MailDeliveryListener::className(), 'handleEventStoryChanged']);
        $this->on(self::EVENT_DELETED, [MailDeliveryListener::className(), 'handleEventDeleted']);
        $this->on(self::EVENT_STARTED, [MailDeliveryListener::className(), 'handleEventStarted']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = Yii::$app->getDb();
        $transaction = $db->beginTransaction();
        $isNew = $this->getIsNewRecord();

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        // Create "Mail delivery story changed" event
        $event = new MailDeliveryEvent();
        $this->trigger(self::EVENT_STORY_CHANGED, $event);

        if ($event->isValid && !$isNew) {
            switch ($this->getStoryAction()) {
                case self::STORY_ACTION_STARTED:
                    // Create "Mail delivery started" event
                    $this->trigger(self::EVENT_STARTED, $event);
                    break;
            }
        }

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
        // Create "Mail delivery deleted" event
        $event = new MailDeliveryEvent();
        $this->trigger(self::EVENT_DELETED, $event);
        if (!$event->isValid) {
            $this->addError(null, $event->message);
            return false;
        }

        return parent::delete();
    }

    public function getStatusesItems($firstElement = null)
    {
        if ($this->status === null) {
            $this->status = self::STATUS_NEW;
        }
        return parent::getEnumNames(self::$_statusesNames, 'statusesItems', $firstElement);
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

    public function isImageChanged()
    {
        return !empty($this->cropInfo) || $this->getRTC('oldImg') != $this->getImgUrl();
    }

    public function getAuthorName()
    {
        return $this->getRTCItem('authorName', function () {
            return $this->author !== null ? $this->author->fullName : '';
        }, '');
    }

    public function getCanStarted()
    {
        return $this->status == self::STATUS_NEW;
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
            'dWidth' => $this->imgWidth,
            'dHeight' => $this->imgHeight,
        ];
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
        if (!$this->img) {
            $this->img = $this->image !== null ? $this->image->url : null;
        }
        return $this->img;
    }
    public function getImgAlt()
    {
        return null;
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


    // Implements <some interface>

    // END Implements <some interface>
}
