<?php

namespace models;

use Yii;
use abstracts\ModelAbstract;

/**
 * This is the model class for table "slider".
 *
 * @property string $id
 * @property string $title
 * @property string $text
 * @property string $linkUrl
 * @property string $linkText
 * @property string $linkTitle
 * @property string $imgUrl
 * @property string $imgFile
 * @property string $imgAlt
 * @property string $status
 */
class Slide extends ModelAbstract
{
    const STATUS_ACTIVE = 'active';
    const STATUS_NOT_ACTIVE = 'not_active';

    public $img;

    private static $_statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_NOT_ACTIVE,
    ];

    public static function tableName()
    {
        return 'slide';
    }

    public function rules()
    {
        return [
            [['title', 'imgUrl'], 'required'],
            ['img', 'required', 'when' => function (Slide $model) {
                return $model->getIsNewRecord();
            }],
            [['text'], 'string'],
            ['img', 'file'],
            ['status', 'in', 'range' => self::$_statuses],
            [['title'], 'string', 'max' => 255],
            [['linkUrl', 'linkText', 'linkTitle', 'imgAlt'], 'string', 'max' => 126],
            [['imgUrl', 'imgFile'], 'string', 'max' => 512]
        ];
    }

    public function attributeLabels()
    {
        return [

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

        return true;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        echo '<pre>'; var_dump($this->img); exit('</pre>');

        return true;
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

    // imgFile
    public function getImgFile()
    {
        return $this->img_file;
    }
    public function setImgFile($img_file)
    {
        $this->img_file = $img_file;
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

    // END Getters and setters


    // Public methods

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
