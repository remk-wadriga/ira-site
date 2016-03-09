<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 1:15
 */

namespace widgets\slider;

use Yii;
use yii\bootstrap\Widget;

class Slider extends Widget
{
    /**
     * @var \abstracts\ModelAbstract
     */
    public $modelClass;

    public $conditions = [];

    public $with = [];

    public $orderBy;

    public $backgroundImage = '@web/img/design/transparent.png';

    public function getId($autoGenerate = false)
    {
        return parent::getId($autoGenerate);
    }

    public function run()
    {
        parent::run();

        if ($this->modelClass === null) {
            return null;
        }

        $model = $this->modelClass;
        $query = $model::find();
        if (!empty($this->with)) {
            $query->with($this->with);
        }
        if (!empty($this->conditions)) {
            $query->where($this->conditions);
        }
        if (!empty($this->orderBy)) {
            $query->orderBy($this->orderBy);
        }

        $items = $query->all();
        if (empty($items)) {
            return null;
        }

        $slides = [];
        foreach ($items as $item) {
            $backgroundImage = $item->getAttribute('backgroundImage');
            if ($backgroundImage == null) {
                $backgroundImage = $this->backgroundImage;
            }
            $slides[] = [
                'backgroundImage' => $backgroundImage,
                'imgAlt' => $item->getAttribute('imgAlt'),
                'imgUrl' => $item->getAttribute('imgUrl'),
                'title' => $item->getAttribute('title'),
                'subTitle' => $item->getAttribute('subTitle'),
                'text' => $item->getAttribute('text'),
                'linkUrl' => $item->getAttribute('linkUrl'),
                'linkText' => $item->getAttribute('linkText'),
            ];
        }

        return $this->render('slider-view', [
            'slides' => $slides,
            'id' => isset($this->options['id']) ? $this->options['id'] : 'masterslider',
            'class' => isset($this->options['class']) ? $this->options['class'] : 'master-slider',
            'dataHeight' => isset($this->options['dataHeight']) ? $this->options['dataHeight'] : 'fullscreen',
            'slideClass' => isset($this->options['slideClass']) ? $this->options['slideClass'] : 'ms-slide',
        ]);
    }
}