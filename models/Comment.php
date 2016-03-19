<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use interfaces\StoryInterface;
use events\CommentEvent;
use front\listeners\CommentListener;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $parentID
 * @property integer $entityID
 * @property integer $userID
 * @property string $entityClass
 * @property string $title
 * @property string $text
 * @property string $date
 *
 * @property string $userAvatar
 * @property string $userName
 *
 * @property User $user
 * @property \abstracts\ModelAbstract $entity
 * @property Comment[] $children
 */
class Comment extends ModelAbstract implements StoryInterface
{
    const EVENT_CREATED = 'event_comment_created';

    public static function tableName()
    {
        return 'comment';
    }

    public function rules()
    {
        return [
            [['parentID', 'entityID', 'userID'], 'integer'],
            [['entityID', 'userID', 'entityClass', 'date'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['entityClass'], 'string', 'max' => 126],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => $this->t('Title'),
            'text' => $this->t('Text'),
        ];
    }



    // Behaviors

    // END Behaviors


    // Depending

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    // END Depending


    // Event handlers

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->userID) {
            $this->userID = Yii::$app->user->id;
        }
        if (!$this->date) {
            $this->date = Yii::$app->time->getCurrentDateTime();
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->date) {
            $this->date = Yii::$app->time->formatDateTime($this->date);
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Create "comment created" event
        $event = new CommentEvent();
        $this->trigger(self::EVENT_CREATED, $event);
    }

    // END Event handlers


    // Getters and setters

    // parentID
    public function getParentID()
    {
        return $this->parent_id;
    }
    public function setParentID($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    // entityID
    public function getEntityID()
    {
        return $this->entity_id;
    }
    public function setEntityID($entity_id)
    {
        $this->entity_id = $entity_id;
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

    // entityClass
    public function getEntityClass()
    {
        return $this->entity_class;
    }
    public function setEntityClass($entity_class)
    {
        $this->entity_class = $entity_class;
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CREATED, [CommentListener::className(), 'handleCommentCreated']);
    }


    public function getUserAvatar()
    {
        return $this->user != null ? $this->user->avatarUrl : null;
    }

    public function getUserName()
    {
        return $this->user != null ? $this->user->fullName : null;
    }

    public function getEntity()
    {
        return $this->getRTCItem('entity', function () {
            $class = $this->entityClass;
            return $class::findOne($this->entityID);
        }, null);
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
        return $this->t('Created');
    }

    public function getStoryFields()
    {
        return [
            'userID',
            'parentID',
            'title',
            'text',
            'date',
        ];
    }

    public function getStoryOldValues()
    {
        return null;
    }

    public function getStoryNewValues()
    {
        return $this->getAttributes($this->getStoryFields());
    }

    // END Implements StoryInterface
}
