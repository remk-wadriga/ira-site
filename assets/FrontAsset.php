<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:29
 */

namespace assets;

use abstracts\AssetAbstract;

class FrontAsset extends AssetAbstract
{
    public $css = [
        //'css/bootstrap.css',
        'css/style.css',
        'css/masterslider/masterslider.css',
        'css/masterslider/skins/black-1/style.css',
        'css/font-awesome.min.css',
        'css/animate.css',
        'css/nivo-slider.css',
        'css/isotope.css',
        'css/owl.carousel.css',
        'css/owl.transitions.css',
        'css/lightbox.css',
        'css/front.css',
    ];

    public $js = [
        //'js/jquery-1.11.0.min.js',
        'js/jquery.easing.1.3.js',
        //'js/bootstrap.min.js',
        'js/masterslider.min.js',
        'js/masterslider.staff.carousel.dev.js',
        'js/wow.min.js',
        'js/waypoints.min.js',
        'js/underscore-min.js',
        'js/jquery.backstretch.min.js',
        'js/jquery.animation.js',
        'js/jquery.isotope.min.js',
        'js/jquery.stellar.min.js',
        'js/jquery.contact.min.js',
        'js/jquery.nicescroll.min.js',
        'js/retina-1.1.0.min.js',
        'js/jquery.nivo.slider.pack.js',
        'js/video.js',
        'js/owl.carousel.min.js',
        'js/lightbox.min.js',
        'js/custom.js',
        'js/front.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public static function scriptName()
    {
        return 'Front';
    }
}