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
    $assetClass = Yii::$app->controller->module->getAssets();
    if (is_array($assetClass)) {
        foreach ($assetClass as $asset) {
            $asset::register($this);
        }
    } else {
        $assetClass::register($this);
    }
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

    <?= $content ?>

    <?php $this->endBody() ?>
    </body>

    </html>

<?php $this->endPage() ?>