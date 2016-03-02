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

class AssetAbstract extends AssetBundle
{
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

        $scripts = $this->getScripts();
        if (!empty($scripts)) {
            $view = Yii::$app->controller->view;
            foreach ($scripts as $script) {
                $view->registerJs($script);
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

        $this->sourcePath = $path;
    }

    public function getScripts()
    {
        return [];
    }
}