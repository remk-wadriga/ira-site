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
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

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

$items = [
    ['label' => $this->t('Management'), 'items' => [
        ['label' => $this->t('Slides'), 'url' => ['/admin/slide/list']],
        ['label' => $this->t('Events'), 'url' => ['/admin/event/list']],
        ['label' => $this->t('Users'), 'url' => ['/admin/user/list']],
        ['label' => $this->t('Blog'), 'url' => ['/admin/post/list']],
    ]],
    ['label' => $this->t('Home'), 'url' => ['/admin/index/index']],
    ['label' => $this->t('Front'), 'url' => ['/front/index/index']],
    ['label' => $this->t('Account'), 'items' => [
        ['label' => $this->t('My profile'), 'url' => ['/admin/account/update']],
        ['label' => $this->t('Logout ({name})', ['name' => Yii::$app->user->fullName]), 'url' => ['/site/auth/logout'], 'linkOptions' => [
            'data' => [
                'type' => 'POST',
                'confirm' => $this->t('Are you sure you want to leave the system') . '?',
            ],
        ]],
    ]],
];
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

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->id,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $items,
        ]);
        NavBar::end();
        ?>

        <div class="container content-wrap">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => $this->t('Home'), 'url' => ['/admin/index/index']],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="content">
                <?= $content ?>
            </div>
        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::$app->id ?> <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?= $this->render('partials-admin/_modal-window') ?>
    <?php $this->endBody() ?>
    </body>

    </html>

<?php $this->endPage() ?>