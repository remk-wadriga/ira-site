<?php

namespace models;

use Yii;

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
class Slider extends \abstracts\ModelAbstract
{
    public static function tableName()
    {
        return 'slider';
    }

    public function rules()
    {
        return [
            [['title', 'imgUrl'], 'required'],
            [['text', 'status'], 'string'],
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
