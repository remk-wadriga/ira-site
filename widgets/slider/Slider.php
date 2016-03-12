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
        //$this->registerAsset();

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

    private function registerAsset()
    {
        SliderAsset::register(Yii::$app->view);

        Yii::$app->view->registerJs('jQuery(document).ready(function($) {
                /************************
                ****** MasterSlider *****
                *************************/
                // Calibrate slider\'s height
                var sliderHeight = 790; // Smallest hieght allowed (default height)
                if ( $(\'#masterslider\').data(\'height\') == \'fullscreen\' ) {
                    var winHeight = $(window).height();
                    sliderHeight = winHeight > sliderHeight ? winHeight : sliderHeight;
                }

                // Initialize the main slider
                var slider = new MasterSlider();
                slider.setup(\'masterslider\', {
                    space:0,
                    fullwidth:true,
                    autoplay:true,
                    overPause:false,
                    width:1024,
                    height:sliderHeight
                });
                // adds Arrows navigation control to the slider.
                slider.control(\'bullets\',{autohide:false  , dir:"h"});

                var teamslider = new MasterSlider();
                teamslider.setup(\'teamslider\' , {
                    loop:true,
                    width:300,
                    height:290,
                    speed:20,
                    view:\'stffade\',
                    grabCursor:false,
                    preload:0,
                    space:29
                });
                teamslider.control(\'slideinfo\',{insertTo:\'#staff-info\'});

                $(".team .ms-nav-next").click(function() {
                    teamslider.api.next();
                });

                $(".team .ms-nav-prev").click(function() {
                    teamslider.api.previous();
                });
            });');
    }
}