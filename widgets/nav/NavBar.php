<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 17:51
 */

namespace widgets\nav;

use Yii;
use yii\bootstrap\Widget;
use yii\bootstrap\Html;
use yii\helpers\Url;

class NavBar extends Widget
{
    public $items = [];

    public function getId($autoGenerate = false)
    {
        return parent::getId($autoGenerate);
    }

    public function run()
    {
        parent::run();
        if (empty($this->items)) {
            return false;
        }

        foreach ($this->items as $index => $item) {
            $this->items[$index] = $this->renderItem($item);
        }

        return $this->render('navbar-view', [
            'id' => isset($this->options['id']) ? $this->options['id'] : 'nav-begins',
            'class' => isset($this->options['class']) ? $this->options['class'] : 'container-wrapper navigation',
            'navbarClass' => isset($this->options['navbarClass']) ? $this->options['navbarClass'] : 'navbar navbar-default',
            'logo' => '@web/img/logo.jpg',
            'items' => $this->items,
        ]);
    }

    protected function renderItem($item)
    {
        $t = Yii::$app->view;
        $linkOptions = [];
        $class = '';

        if (isset($item['linkOptions'])) {
            $linkOptions = $item['linkOptions'];
        }
        if (!isset($item['url'])) {
            $item['url'] = '#';
        }
        if ($this->isElementActive($item['url'])) {
            $class .= 'active';
        }

        $content = Html::a($t->t($item['label']), $item['url'], $linkOptions);

        if (isset($item['items']) && !empty($item['items'])) {
            $subMenu = '';

            foreach ($item['items'] as $subItem) {
                if (!isset($subItem['url'])) {
                    $subItem['url'] = '#';
                }
                if (strpos($class, 'active') === false && $this->isElementActive($subItem['url'])) {
                    $class .= 'active';
                }
                $subMenu .= $this->renderItem($subItem);
            }

            $content .= Html::tag('ul', $subMenu, ['class' => 'dropdown-menu']);
            $class .= ' dropdown h';
        }

        return Html::tag('li', $content, ['class' => $class]);
    }

    protected function isElementActive($url)
    {
        $prevUrl = is_array($url) ? $url[0] : $url;
        $url = Url::to($url);
        $pageUrl = Yii::$app->request->getUrl();

        return in_array($pageUrl, [$prevUrl, $url]);
    }
}