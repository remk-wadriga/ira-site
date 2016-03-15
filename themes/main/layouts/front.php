<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:33
 *
 * @var \components\View $this
 * @var string $content
 * @var array $leftMenuItems
 */

use yii\helpers\Html;

// Register module assets
if (Yii::$app->controller->module !== null) {
    $scriptParams = array_merge($this->scriptParams, [
        'dateFormat' => Yii::$app->params['dateScriptsFormat'],
        'timeFormat' => Yii::$app->params['timeScriptsFormat'],
        'dateTimeFormat' => Yii::$app->params['dateTimeScriptsFormat'],
    ]);

    $assetClass = Yii::$app->controller->module->getAssets();
    if (is_array($assetClass)) {
        foreach ($assetClass as $asset) {
            $asset::register($this);
            $this->registerJs($asset::getScriptsString($scriptParams));
        }
    } else {
        $assetClass::register($this);
        $this->registerJs($assetClass::getScriptsString($scriptParams));
    }
}

$menuItems = [
    ['label' => $this->t('Home'), 'url' => ['/front/index/index']],
    ['label' => $this->t('Events'), 'url' => ['/front/event/list']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => $this->t('Login'), 'url' => ['/site/auth/login']];
    $menuItems[] = ['label' => $this->t('Register'), 'url' => ['/site/auth/register']];
} else {
    $menuItems[] = ['label' => $this->t('Account'), 'items' => [
        ['label' => $this->t('My profile'), 'url' => ['/site/account/update']],
        [
            'label' => $this->t('Logout ({name})', ['name' => Yii::$app->user->fullName]),
            'url' => ['/site/auth/logout'],
            'linkOptions' => [
                'data' => [
                    'type' => 'POST',
                    'confirm' => $this->t('Are you sure you want to leave the system') . '?',
                ],
            ],
        ],
    ]];
}
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta id="wixMobileViewport" name="viewport" content="minimum-scale=0.25, maximum-scale=1.2"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>

            <!-- Header -->
            <?= $this->render('partials-front/header', [
                'menuItems' => $menuItems,
            ]) ?>

            <!-- Content -->
            <?= $this->render('partials-front/content', [
                'content' => $content,
            ]) ?>

            <!-- Footer -->
            <?= $this->render('partials-front/footer') ?>

        <?php $this->endBody() ?>

        <?php if (isset($this->params['showMainSlider']) && $this->params['showMainSlider']) : ?>
            <?php $this->registerJs('jQuery(document).ready(function($) {
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
            });') ?>
        <?php endif ?>
    </body>

</html>

<?php $this->endPage() ?>