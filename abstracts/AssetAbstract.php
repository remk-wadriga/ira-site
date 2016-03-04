<?php
/**
 * Created by Rem.
 * Author: Dmitry Kushneriv
 * Email: remkwadriga@yandex.ua
 * Date: 12-08-2015
 * Time: 17:34 PM
 */

namespace abstracts;

use Yii;
use yii\web\AssetBundle;

/**
 * Class AssetAbstract
 * @package abstracts
 */
class AssetAbstract extends AssetBundle
{
    protected $scriptName;

    protected static $_scripts = [];

    public $theme;
    public $path;

    public function init()
    {
        parent::init();

        $path = '@webroot';

        if ($this->theme !== null) {
            $path = '@app/themes/' . $this->theme;
        } else {
            $classItems = explode('\\', get_class($this));
            $moduleID = strtolower(str_replace('Asset', '', end($classItems)));
            $module = Yii::$app->getModule($moduleID);
            if (!empty($module)) {
                $path = $module->getStaticPath();
            }
        }

        if ($this->path !== null) {
            foreach ($this->css as $index => $css) {
                $this->css[$index] = $this->path . $css;
            }
            foreach ($this->js as $index => $js) {
                $this->js[$index] = $this->path . $js;
            }
        }

        self::$_scripts[] = static::scriptName();

        $this->sourcePath = $path;
    }

    public static function getScriptsString($params = [])
    {
        $params = array_merge(static::getScriptParams(), $params);

        $paramsString = '';
        foreach ($params as $name => $value) {
            $paramsString .= "    {$name}: '{$value}',\n";
        }
        $strLen = strlen($paramsString);
        if ($strLen > 0) {
            $paramsString = substr($paramsString, 0, $strLen - 1);
        }

        $scriptString = '';
        $scripts = array_reverse(static::getScripts());
        foreach ($scripts as $script) {
            if ($script !== null) {
                $scriptString .= "{$script}.init({\n{$paramsString}\n});\n";
            }
        }
        return $scriptString;
    }

    public static function getScripts()
    {
        return static::$_scripts;
    }

    public static function getScriptParams()
    {
        return [];
    }

    public static function scriptName()
    {
        return null;
    }
}