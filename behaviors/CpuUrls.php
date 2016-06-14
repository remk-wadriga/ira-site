<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.06.2016
 * Time: 2:29
 */

namespace behaviors;

use Yii;
use abstracts\BehaviorAbstract;
use interfaces\CpuUrlsInterface;
use dosamigos\transliterator\TransliteratorHelper;

class CpuUrls extends BehaviorAbstract
{
    /**
     * @var CpuUrlsInterface
     */
    public $owner;

    public function createCpuUrl($name, $date = null)
    {
        $url = strtolower(str_replace(' ', '-', TransliteratorHelper::process($name, '', 'en')));
        $url = str_replace('"', '', $url);
        if ($this->owner->getCountBySpuUrl($url) > 0) {
            if ($date === null) {
                $date = Yii::$app->time->getCurrentDateTime();
            }
            // If model with some url already exist - add date to url
            $url .= '-' . Yii::$app->time->formatDate($date);
            if ($this->owner->getCountBySpuUrl($url) > 0) {
                // If model with some url already exist - add time to url
                $url .= '-' . Yii::$app->time->formatTime($date);
            }
            if ($this->owner->getCountBySpuUrl($url) > 0) {
                // If model with some url already exist - add recursive index to url
                $url = $this->addIndexRecursive($url);
            }
        }
        return $url;
    }

    private function addIndexRecursive($url, $index = 0)
    {
        $index++;
        if ($this->owner->getCountBySpuUrl($url . '-' . $index) > 0) {
            return $this->addIndexRecursive($url, $index);
        } else {
            return $url . '-' . $index;
        }
    }
}