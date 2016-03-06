<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 0:17
 *
 * @var components\View $this
 * @var array $menuItems
 */

use widgets\Naw;
use widgets\Slider;
use models\Slide;
?>

<div id="templatemo_header_wrapper">
    <div id="templatemo_header">
        <div id="site_title"><a href="<?= Yii::$app->homeUrl ?>"><?= $this->title ?></a></div>
        <div id="templatemo_menu" class="ddsmoothmenu">
            <?= Naw::widget([
                'items' => $menuItems,
            ]) ?>
        </div>

        <div class="clear"></div>

        <?= Slider::widget([
            'model' => Slide::className(),
            'conditions' => ['status' => Slide::STATUS_ACTIVE],
        ]) ?>
    </div> <!-- END of header -->
</div> <!-- END of header wrapper -->
