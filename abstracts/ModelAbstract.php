<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 14:22
 */

namespace abstracts;

use Yii;
use yii\db\ActiveRecord;
use interfaces\ModelInterface;

class ModelAbstract extends ActiveRecord implements ModelInterface
{
    private static $_items;

    protected $_rtcItems = [];

    public function getID()
    {
        return $this->getAttribute('id');
    }

    public static function modelName()
    {
        $classParts = explode('\\', static::className());
        return end($classParts);
    }

    /**
     * @return string
     */
    public static function shortName()
    {
        return lcfirst(static::modelName());
    }

    public function t($message, $params = [], $direction = 'app')
    {
        return Yii::$app->view->t($message, $params, $direction);
    }

    /**
     * Set the runtime cache value
     *
     * @param string $key
     * @param mixed $value
     */
    public function setRTC($key, $value)
    {
        $cacheTime = $this->cacheTime($key);
        $key = self::rtcKey($key);
        $this->_rtcItems[$key] = $value;
        if ($cacheTime !== null) {
            if (!$this->getIsNewRecord()) {
                $key .= '_' . $this->getID();
            }
            Yii::$app->cache->set($key, $value, $cacheTime);
        }
    }

    /**
     * Get the runtime cache value
     *
     * @param string $key
     * @return mixed|null
     */
    public function getRTC($key)
    {
        $cacheTime = $this->cacheTime($key);
        $key = self::rtcKey($key);
        if (isset($this->_rtcItems[$key])) {
            return $this->_rtcItems[$key];
        }
        if ($cacheTime === null) {
            return null;
        }
        $items = Yii::$app->cache->get($key);
        $this->_rtcItems[$key] = $items ? $items : null;

        return $this->_rtcItems[$key];
    }

    /**
     * @param string $key
     * @param \Closure $getter
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getRTCItem($key, $getter, $defaultValue = false)
    {
        $value = $this->getRTC($key);
        if ($value === null) {
            $value = $defaultValue;
            if (!$this->getIsNewRecord()) {
                $value = call_user_func($getter);
            }
            $this->setRTC($key, $value);
        }
        return $value;
    }

    public function getAttribute($name)
    {
        if ($this->hasAttribute($name)) {
            return parent::getAttribute($name);
        }
        $getter = 'get' . ucfirst($name);
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        return parent::getAttribute($name);
    }

    public function getOldAttributes($names = [])
    {
        if (empty($names)) {
            return parent::getOldAttributes();
        } else {
            $attributes = [];
            foreach ($names as $name) {
                $attributes[$name] = $this->getOldAttribute($name);
            }
            return $attributes;
        }
    }

    /**
     * Get the typical enum translated names array
     *
     * @param array $array
     * @param string $key
     * @param string $firstElement
     * @return array
     */
    protected function getEnumNames(array $array, $key = 'enum_list', $firstElement = null)
    {
        $names = $this->getRTC($key);
        if ($names === null) {
            $names = [];
            if ($firstElement !== null) {
                $names[] = $this->t($firstElement);
            }
            foreach ($array as $id => $name) {
                $names[$id] = $this->t($name);
            }
            $this->setRTC($key, $names);
        }
        return $names;
    }


    /**
     * @param array $where
     * @param string $firstElement
     * @return array
     */
    public static function getItems($where = [], $firstElement = null)
    {
        $class = static::className();
        $key = str_replace('\\', '_', strtolower($class) . '_items');
        if (!empty($where)) {
            $key .= '_' . md5(serialize($where));
        }
        if (isset(self::$_items[$key])) {
            return self::$_items[$key];
        }

        self::$_items[$key] = [];
        if ($firstElement !== null) {
            self::$_items[$key][] = $firstElement;
        }
        $items = static::getItemsNames();
        $itemsKeys = array_keys($items);
        $lastItemKey = end($itemsKeys);
        $orderBy = is_integer($lastItemKey) ? $items[$lastItemKey] : $lastItemKey;

        $itemsList = static::find()
            ->select($items)
            ->orderBy($orderBy)
            ->where($where)
            ->asArray()
            ->all();
        if (!empty($itemsList)) {
            foreach ($itemsList as $item) {
                self::$_items[$key][$item['id']] = trim($item[$lastItemKey]);
            }
        }

        return self::$_items[$key];
    }

    protected static function getItemsNames()
    {
        return ['id', 'name'];
    }

    protected function cacheTime($key)
    {
        return null;
    }

    protected static function rtcKey($key)
    {
        return strtolower(static::shortName()) . '_' . $key;
    }
}