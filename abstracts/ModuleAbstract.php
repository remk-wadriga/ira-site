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
    public $layout = 'main';
    public $themeBasePath = '@app/themes';

    public function init()
    {
        if ($this->theme === null) {
            $this->theme = $this->id;
        }
        $this->setLayoutPath($this->themeBasePath . '/' . $this->id . '/' . 'layouts');
        $this->setViewPath($this->themeBasePath . '/' . $this->id . '/' . 'views');

        parent::init();
    }

    public function getStaticPath()
    {
        return $this->themeBasePath . '/' . $this->id . '/static';
    }
}