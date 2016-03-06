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
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => $this->t('Login'), 'url' => ['/site/auth/login']];
    $menuItems[] = ['label' => $this->t('Register'), 'url' => ['/site/auth/register']];
} else {
    $menuItems[] = ['label' => $this->t('Account'), 'items' => [
        [
            'label' => $this->t('Logout ({name})', ['name' => Yii::$app->user->fullName]),
            'url' => ['/site/auth/logout'], 'linkOptions' => [
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

            <?= $this->render('partials-front/header', ['menuItems' => $menuItems]) ?>

            <?= $this->render('partials-front/content', ['content' => $content]) ?>

            <?= $this->render('partials-front/footer.php') ?>

            <?php $this->registerJs('ddsmoothmenu.init({
                mainmenuid: "templatemo_menu", //menu DIV id
                orientation: \'h\', //Horizontal or vertical menu: Set to "h" or "v"
                classname: \'ddsmoothmenu\', //class added to menu\'s outer DIV
                //customtheme: ["#1c5a80", "#18374a"],
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
            });') ?>

            <?php $this->registerJs('$("#carousel").dualSlider({
                auto:true,
                autoDelay: 6000,
                easingCarousel: "swing",
                easingDetails: "easeOutBack",
                durationCarousel: 1000,
                durationDetails: 600
            });') ?>
        <?php $this->endBody() ?>
    </body>

</html>

<?php $this->endPage() ?>