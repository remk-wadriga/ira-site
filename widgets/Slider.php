<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 22:36
 */

namespace widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Slider extends Widget
{
    /**
     * @var \abstracts\ModelAbstract
     */
    public $model;
    public $conditions = [];

    private $itemNumber = 1;

    public function run()
    {
        if (!$model = $this->model) {
            return '';
        }
        if (!class_exists($model)) {
            return '';
        }

        $images = [];
        $details = [];

        $slides = $model::findAll($this->conditions);

        foreach ($slides as $slide) {
            list($image, $detail) = $this->renderItem($slide);
            $images[] = $image;
            $details[] = $detail;
        }
        if (empty($images)) {
            return '';
        }

        $t = Yii::$app->view;

        $html = Html::beginTag('div', ['id' => 'templatemo_slider_wrapper']);
        $html .= Html::beginTag('div', ['id' => 'templatemo_slider']);
        $html .= Html::beginTag('div', ['id' => 'carousel']);
            $html .= Html::beginTag('div', ['class' => 'panel']);

                $html .= Html::beginTag('div', ['class' => 'details_wrapper']);
                    $html .= Html::beginTag('div', ['class' => 'details']);
                        foreach ($details as $detail) {
                            $html .= $detail;
                        }
                    $html .= Html::endTag('div');
                $html .= Html::endTag('div');

                $html .= Html::beginTag('div', ['class' => 'paging']);
                    $html .= Html::tag('div', null, ['id' => 'numbers']);
                    $html .= Html::a($t->t('Previous'), 'javascript:void(0);', ['class' => 'previous', 'title' => $t->t('Previous')]);
                    $html .= Html::a($t->t('Next'), 'javascript:void(0);', ['class' => 'next', 'title' => $t->t('Next')]);
                $html .= Html::endTag('div');

                $html .= Html::a($t->t('Play'), 'javascript:void(0);', ['class' => 'play', 'title' => $t->t('Turn on autoplay')]);
                $html .= Html::a($t->t('Pause'), 'javascript:void(0);', ['class' => 'pause', 'title' => $t->t('Turn off autoplay')]);
            $html .= Html::endTag('div');

            $html .= Html::beginTag('div', ['id' => 'slider-image-frame']);
                $html .= Html::beginTag('div', ['class' => 'backgrounds']);
                    foreach ($images as $image) {
                        $html .= $image;
                    }
                $html .= Html::endTag('div');
            $html .= Html::endTag('div');
        $html .= Html::endTag('div');
        $html .= Html::endTag('div');
        $html .= Html::endTag('div');

        return $html;
    }

    protected function renderItem(\abstracts\ModelAbstract $slide)
    {
        $t = Yii::$app->view;
        $ID = $this->itemNumber++;

        $imgUrl = '@web/' . $slide->getAttribute('imgUrl');
        $imgUrl = str_replace('//', '/', $imgUrl);

        $image = Html::beginTag('div', ['class' => "item item_{$ID}"]);
            $image .= Html::img($imgUrl, ['alt' => $t->t($slide->getAttribute('imgAlt'))]);
        $image .= Html::endTag('div');

        $detail = Html::beginTag('div', ['class' =>'detail']);
            $detail .= Html::beginTag('h2');
                $detail .= Html::a($t->t($slide->getAttribute('title')), '#');
            $detail .= Html::endTag('h2');
            $detail .= Html::tag('p', $slide->getAttribute('text'));
            $detail .= Html::a($t->t($slide->getAttribute('linkText')), $slide->getAttribute('linkUrl'), ['title' => $slide->getAttribute('linkTitle')]);
        $detail .= Html::endTag('div');

        return [$image, $detail];
    }
}