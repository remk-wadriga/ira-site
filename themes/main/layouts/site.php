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
use widgets\nav\NavBar;
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
    ['label' => $this->t('Home'), 'url' => ['/front/index/index']],
];

if (Yii::$app->user->isGuest) {
    $items[] = ['label' => $this->t('Login'), 'url' => ['/site/auth/login']];
    $items[] = ['label' => $this->t('Register'), 'url' => ['/site/auth/register']];
} else {
    $items[] = ['label' => $this->t('Account'), 'items' => [
        ['label' => $this->t('My profile'), 'url' => ['/site/account/update']],
        ['label' => $this->t('Logout ({name})', ['name' => Yii::$app->user->fullName]), 'url' => ['/site/auth/logout'], 'linkOptions' => [
            'data' => [
                'type' => 'POST',
                'confirm' => $this->t('Are you sure you want to leave the system') . '?',
            ],
        ]],
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
        <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl ?>/favicon.ico" type="image/x-icon" />
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>

        <?= NavBar::widget([
            'items' => $items,
        ]) ?>

        <?= $this->render('partials/flash-message') ?>

        <?= $content ?>

        <?php $this->endBody() ?>
    </body>

</html>

<?php $this->endPage() ?>