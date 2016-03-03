<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 21:41
 */

namespace abstracts;

use Yii;
use yii\base\Module;

class ModuleAbstract extends Module
{
    public $theme;
    public $layout;
    public $themeBasePath = '@app/themes';

    public function init()
    {
        if ($this->theme === null) {
            $this->theme = $this->id;
        }
        if ($this->layout === null) {
            $this->layout = $this->id;
        }
        $this->setLayoutPath($this->themeBasePath . '/main/layouts');
        $this->setViewPath($this->themeBasePath . '/' . $this->id .  '/views');

        parent::init();
    }

    public function getStaticPath()
    {
        return $this->themeBasePath . '/' . $this->id . '/static';
    }

    /**
     * @return \abstracts\AssetAbstract | \abstracts\AssetAbstract[]
     */
    public function getAssets()
    {
        return 'assets\\' . ucfirst($this->id) . 'Asset';
    }
}