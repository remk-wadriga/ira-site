<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

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
 *
 * @property User $author
 */
class MailDelivery extends ModelAbstract
{
    const STATUS_NEW = 'new';
    const STATUS_CURRENT = 'current';
    const STATUS_PAST = 'past';

    protected static $_statuses = [
        self::STATUS_NEW,
        self::STATUS_CURRENT,
        self::STATUS_PAST,
    ];

    protected static $_statusesNames = [
        self::STATUS_NEW => 'New',
        self::STATUS_CURRENT => 'Current',
        self::STATUS_PAST => 'Past',
    ];

    public static function tableName()
    {
        return 'mail_delivery';
    }

    public function rules()
    {
        return [
            [['name', 'title', 'message'], 'required'],
            [['authorID'], 'integer'],
            [['message'], 'string'],
            [['dateCreate', 'dateSend'], 'safe'],
            [['name', 'title'], 'string', 'max' => 255],
            ['status', 'in', 'range' => self::$_statuses],
            [['authorID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
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

    // END Depending


    // Event handlers

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->authorID === null) {
            $this->authorID = Yii::$app->user->id;
        }
        if ($this->title === null && $this->name !== null) {
            $this->title = $this->name;
        }
        if ($this->status === null) {
            $this->status = self::STATUS_NEW;
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


    // Implements <some interface>

    // END Implements <some interface>
}
