<?php

namespace models;

use admin\listeners\SlideListener;
use events\SlideEvent;
use Yii;
use abstracts\ModelAbstract;
use interfaces\FileModelInterface;
use interfaces\ImagedEntityInterface;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "slider".
 *
 * @property string $id
 * @property string $title
 * @property string $subTitle
 * @property string $text
 * @property string $linkUrl
 * @property string $linkText
 * @property string $linkTitle
 * @property string $imgUrl
 * @property string $imgAlt
 * @property string $status
 *
 * @property Image[] $images
 * @property Image $mainImage
 */
class Slide extends ModelAbstract implements FileModelInterface, ImagedEntityInterface
{
    const STATUS_ACTIVE = 'active';
    const STATUS_NOT_ACTIVE = 'not_active';

    const EVENT_SAVED = 'event_saved';

    public $img;
    public $cropInfo;
    public $imgMinimalHeight = 100;
    public $imgWidth = 1280;
    public $imgHeight = 847;
    public $addUrl = false;

    private static $_statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_NOT_ACTIVE,
    ];

    private static $_statusesNames = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_NOT_ACTIVE => 'Not active',
    ];

    public static function tableName()
    {
        return 'slide';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif']],
            ['status', 'in', 'range' => self::$_statuses],
            [['title', 'subTitle'], 'string', 'max' => 255],
            [['linkUrl', 'linkText', 'linkTitle'], 'string', 'max' => 126],
            [['cropInfo', 'addUrl'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => $this->t('Title'),
            'subTitle' => $this->t('Subtitle'),
            'img' => $this->t('Image'),
            'imgUrl' => $this->t('Image url'),
            'linkUrl' => $this->t('Link url'),
            'linkText' => $this->t('Link text'),
            'linkTitle' => $this->t('Link title'),
            'imgAlt' => $this->t('Image alt'),
            'text' => $this->t('Text'),
            'status' => $this->t('Status'),
            'addUrl' => $this->t('Add url'),
        ];
    }

    // Behaviors

    // END Behaviors


    // Depending

    /**
     * @return ActiveQuery
     */
    public function getMainImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id'])->viaTable(Image::entityImageTableName(), [
            'entity_id' => 'id',
        ], function (ActiveQuery $query) {
            $query
                ->select(['entity_id', 'image_id'])
                ->andWhere([
                    'entity_class' => Slide::className(),
                    'is_main' => 1,
                ]);
        });
    }

    /**
     * @return ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable(Image::entityImageTableName(), [
            'entity_id' => 'id',
        ], function (ActiveQuery $query) {
            $query
                ->select(['entity_id', 'image_id'])
                ->andWhere([
                    'entity_class' => Slide::className(),
                ]);
        });
    }

    // END Depending


    // Event handlers

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        if (!$this->status) {
            $this->status = self::STATUS_ACTIVE;
        }

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (!$this->linkTitle) {
            $this->linkTitle = $this->linkText;
        }

        if ($this->linkUrl && strpos($this->linkUrl, 'http') === false) {
            $this->createLinkUrl();
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->setRTC('oldImgUrl', $this->imgUrl);
        $this->addUrl = (bool)$this->linkUrl;
    }

    // END Event handlers


    // Getters and setters

    // linkUrl
    public function getLinkUrl()
    {
        return $this->link_url;
    }
    public function setLinkUrl($link_url)
    {
        $this->link_url = $link_url;
    }

    // linkText
    public function getLinkText()
    {
        return $this->link_text;
    }
    public function setLinkText($link_text)
    {
        $this->link_text = $link_text;
    }

    // linkTitle
    public function getLinkTitle()
    {
        return $this->link_title;
    }
    public function setLinkTitle($link_title)
    {
        $this->link_title = $link_title;
    }

    // imgUrl
    public function getImgUrl()
    {
        return $this->getRTCItem('image_url', function () {
            return $this->mainImage !== null ? $this->mainImage->url : null;
        }, null);
    }
    public function setImgUrl($img_url)
    {
        $this->setRTC('image_url', $img_url);
    }

    // imgAlt
    public function getImgAlt()
    {
        return $this->getRTCItem('image_alt', function () {
            return $this->mainImage !== null ? $this->mainImage->alt : null;
        }, null);
    }
    public function setImgAlt($img_alt)
    {
        $this->setRTC('image_alt', $img_alt);
    }

    // subTitle
    public function getSubTitle()
    {
        return $this->sub_title;
    }
    public function setSubTitle($sub_title)
    {
        $this->sub_title = $sub_title;
    }

    // END Getters and setters


    // Public methods

    public function init()
    {
        parent::init();

        if ($this->status === null) {
            $this->status = self::STATUS_ACTIVE;
        }

        $this->on(self::EVENT_SAVED, [SlideListener::className(), 'handleSlideSaved']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $db = Yii::$app->getDb();
        //$isNew = $this->getIsNewRecord();
        $transaction = $db->beginTransaction();

        if (!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        // Create "Slide saved" event
        $event = new SlideEvent();
        $this->trigger(self::EVENT_SAVED, $event);

        if (!$event->isValid) {
            $transaction->rollBack();
            $this->addError('img', $event->message);
            return false;
        }

        $this->cropInfo = null;
        $transaction->commit();
        return true;
    }

    public function getStatusItems()
    {
        return $this->getEnumNames(self::$_statusesNames, 'statusesItems');
    }

    public function getStatusName($status = null)
    {
        if ($status === null) {
            $status = $this->status;
        }
        return isset(self::$_statusesNames[$status]) ? $this->t(self::$_statusesNames[$status]) : $this->t(self::$_statusesNames[self::STATUS_NOT_ACTIVE]);
    }

    public function getIsActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function setIsMainImage($val)
    {
        $this->setRTC('isMainImage', (bool)$val);
    }

    public function isImageChanged()
    {
        return $this->imgUrl != $this->getOldFileName();
    }

    // END Public methods


    // Public static methods

    // END Public static methods


    // Protected methods

    // END Protected methods


    // Protected static methods

    // END Protected static methods


    // Private methods

    private function createLinkUrl()
    {
        $url = $this->linkUrl;
        $parts = explode(' ', $url);
        $url = array_shift($parts);

        $modulePos = strpos($url, 'front/');
        if ($modulePos === false) {
            $url = '/front/' . $url;
        } elseif ($modulePos === 0) {
            $url = '/' . $url;
        }

        $url = [str_replace('//', '/', $url)];

        foreach ($parts as $part) {
            $param = explode('=', $part);
            if (count($param) == 2) {
                $url[$param[0]] = $param[1];
            } elseif (count($param) == 1) {
                $url['ids'] = $param[0];
            }
        }

        $this->linkUrl = Url::to($url);
    }

    // END Private methods


    // Private static methods

    // END Private static methods


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
        return $this->getRTC('oldImgUrl');
    }

    public function setFileName($fileName)
    {
        $this->imgUrl = $fileName;
    }

    public function getCropInfo()
    {
        if ($this->cropInfo !== null) {
            $this->cropInfo = Json::decode($this->cropInfo);
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

    public function isMainImage()
    {
        return $this->getRTC('isMainImage');
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
