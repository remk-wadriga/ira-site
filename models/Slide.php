<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;
use interfaces\FileModelInterface;
use yii\helpers\Json;
use yii\helpers\Url;

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
 */
class Slide extends ModelAbstract implements FileModelInterface
{
    const STATUS_ACTIVE = 'active';
    const STATUS_NOT_ACTIVE = 'not_active';

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
            [['title', 'imgUrl'], 'required'],
            [['text'], 'string'],
            ['img', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'], 'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif']],
            ['status', 'in', 'range' => self::$_statuses],
            [['title', 'subTitle'], 'string', 'max' => 255],
            [['linkUrl', 'linkText', 'linkTitle', 'imgAlt'], 'string', 'max' => 126],
            [['imgUrl'], 'string', 'max' => 512],
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

        if (!Yii::$app->file->loadFile($this)) {
            return false;
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
        return $this->img_url;
    }
    public function setImgUrl($img_url)
    {
        $this->img_url = $img_url;
    }

    // imgAlt
    public function getImgAlt()
    {
        return $this->img_alt;
    }
    public function setImgAlt($img_alt)
    {
        $this->img_alt = $img_alt;
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
}
