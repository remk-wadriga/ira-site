<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use interfaces\StoryInterface;
use interfaces\FileModelInterface;
use interfaces\ImagedEntityInterface;
use interfaces\UserClickInterface;
use interfaces\CpuUrlsInterface;
use yii\helpers\Json;
use yii\db\ActiveQuery;
use events\PostEvent;
use admin\listeners\PostListener;
use behaviors\CpuUrls;
use yii\helpers\Url;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property integer $ownerID
 * @property string $title
 * @property string $text
 * @property string $citation
 * @property string $video
 * @property string $dateCreate
 * @property string $dateUpdate
 * @property string $status
 * @property string $url
 *
 * @property string $ownerName
 * @property string $imgUrl
 * @property string $cpuUrl
 *
 * @property User $owner
 * @property Image $image
 * @property Tag[] $tags
 * @property Comment[] $comments
 */
class Post extends ModelAbstract implements StoryInterface, FileModelInterface, ImagedEntityInterface, UserClickInterface, CpuUrlsInterface
{
    const STATUS_PRIVATE = 'private';
    const STATUS_FOR_REGISTERED_USERS = 'for_registered';
    const STATUS_PUBLIC = 'public';
    const STATUS_DISABLED = 'disabled';
    const STATUS_DELETED = 'deleted';

    const STORY_ACTION_CREATED = 'Created';
    const STORY_ACTION_UPDATED = 'Updated';
    const STORY_ACTION_STATUS_CHANGED = 'Status Changed';

    const EVENT_POST_CREATED = 'event_created';
    const EVENT_POST_UPDATED = 'event_updated';

    public static $statusesNames = [
        self::STATUS_PRIVATE => 'Private',
        self::STATUS_FOR_REGISTERED_USERS => 'For registered users',
        self::STATUS_PUBLIC => 'Public',
        self::STATUS_DISABLED => 'Disabled',
        self::STATUS_DELETED => 'Deleted',
    ];

    private static $_storyActions = [
        self::STORY_ACTION_CREATED,
        self::STORY_ACTION_UPDATED,
        self::STORY_ACTION_STATUS_CHANGED,
    ];

    public $img;
    public $cropInfo;
    public $imgWidth = 540;
    public $imgHeight = 320;

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['ownerID', 'title', 'text'], 'required'],
            [['ownerID'], 'integer'],
            [['text', 'citation'], 'string'],
            [['dateCreate', 'dateUpdate', 'cropInfo'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['video', 'url'], 'string', 'max' => 512],
            ['status', 'in', 'range' => array_keys(self::$statusesNames)],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'img' => $this->t('Image'),
            'title' => $this->t('Title'),
            'text' => $this->t('Text'),
            'citation' => $this->t('Citation'),
            'statusName' => $this->t('Status'),
            'dateCreate' => $this->t('Date'),
            'url' => $this->t('Ссылка'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
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

    // END Depending


    // Event handlers

    public function afterFind()
    {
        parent::afterFind();

        if ($this->url === null) {
            $this->url = $this->createCpuUrl($this->title, $this->dateCreate);
            $this->update(false, ['url']);
        }

        $this->setRTC('oldImg', $this->getImgUrl());
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->ownerID) {
            $this->ownerID = Yii::$app->user->id;
        }
        if (!$this->dateCreate) {
            $this->dateCreate = Yii::$app->time->getCurrentDateTime();
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if (!$this->getStoryAction()) {
            if ($this->getIsNewRecord()) {
                $this->setStoryAction(self::STORY_ACTION_CREATED);
            } else {
                $this->setStoryAction(self::STORY_ACTION_UPDATED);
                $this->setStoryFields(['title', 'text', 'citation', 'video', 'status']);
            }
        }
        if ($this->url === null) {
            $this->url = $this->createCpuUrl($this->title, $this->dateCreate);
        }
        return true;
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

    // dateCreate
    public function getDateCreate()
    {
        return $this->date_create;
    }
    public function setDateCreate($date_create)
    {
        $this->date_create = Yii::$app->time->formatDateTime($date_create);
    }

    // dateUpdate
    public function getDateUpdate()
    {
        return $this->date_update;
    }
    public function setDateUpdate($date_update)
    {
        $this->date_update = Yii::$app->time->formatDateTime($date_update);
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();

        if ($this->status === null) {
            $this->status = self::STATUS_PUBLIC;
        }

        $this->on(self::EVENT_POST_CREATED, [PostListener::className(), 'handlePostChanged']);
        $this->on(self::EVENT_POST_UPDATED, [PostListener::className(), 'handlePostChanged']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $isNew = $this->getIsNewRecord();
        $transaction = Yii::$app->db->beginTransaction();

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        // Create "Post changed" event
        $event = new PostEvent();
        if ($isNew) {
            $this->trigger(self::EVENT_POST_CREATED, $event);
        } else {
            $this->trigger(self::EVENT_POST_UPDATED, $event);
        }
        if (!$event->isValid) {
            $transaction->rollBack();
            $this->addError(null, $event->message);
            return false;
        }

        $transaction->commit();
        return true;
    }

    public function getStatusesItems()
    {
        return $this->getEnumNames(self::$statusesNames, 'statusesItems');
    }

    public function isImageChanged()
    {
        return !empty($this->cropInfo) || $this->getRTC('oldImg') != $this->getImgUrl();
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


    // GETTERS

    // statusName
    public function getStatusName($status = null)
    {
        if ($status === null) {
            $status = $this->status;
        }
        if (!array_key_exists($status, self::$statusesNames)) {
            $status = self::STATUS_PUBLIC;
        }
        return $this->t(self::$statusesNames[$status]);
    }
    // ownerName
    public function getOwnerName()
    {
        return $this->owner !== null ? $this->owner->fullName : null;
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
    // cpuUrl
    public function getCpuUrl()
    {
        $id = $this->url !== null ? $this->url : $this->id;
        return Url::to(['/front/post/view', 'id' => $id]);
    }

    // END GETTERS

    // END Public methods


    // Public static methods

    public static function getAttributesNames()
    {
        $dateFormat = Yii::$app->time->dbDateTimeFormat;
        return [
            'id',
            'ownerID' => 'owner_id',
            'title',
            'text',
            'citation',
            'video',
            'dateCreate' => "DATE_FORMAT(date_create, '{$dateFormat}')",
            'dateUpdate' => "DATE_FORMAT(date_update, '{$dateFormat}')",
            'status',
        ];
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
