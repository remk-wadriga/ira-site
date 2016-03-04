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
    ['label' => $this->t('Home'), 'url' => ['/site/index/index']],
];

if (Yii::$app->user->isGuest) {
    $items[] = ['label' => $this->t('Login'), 'url' => ['/site/auth/login']];
    $items[] = ['label' => $this->t('Register'), 'url' => ['/site/auth/register']];
} else {
    $items[] = (
        '<li>'
        . Html::beginForm(['/site/auth/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->fullName . ')',
            ['class' => 'btn btn-link']
        )
        . Html::endForm()
        . '</li>'
    );
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

            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?= Yii::$app->id ?> <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>

</html>

<?php $this->endPage() ?>