<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 1:32
 *
 * @var components\View $this
 * @var integer $index
 * @var array $slide
 * @var string $class
 */

use yii\bootstrap\Html;
?>

<!-- Slide <?= $index ?> -->
<div class="<?= $class ?>">

    <!-- slide background -->
    <?= Html::img($slide['backgroundImage'], [
        'alt' => (string)$slide['imgAlt'],
        'data' => [
            'src' => $slide['imgUrl'],
        ],
    ]) ?>

    <!-- slide text layer -->
    <div class="ms-layer ms-caption" style="top:400px; left:30px;">

        <?php if ($slide['title']) : ?>
            <h2><?= $slide['title'] ?></h2>
        <?php endif ?>

        <?php if ($slide['subTitle']) : ?>
            <h1><?= $slide['subTitle'] ?></h1>
        <?php endif ?>

        <?php if ($slide['text']) : ?>
            <p class="h4">
                <?= $slide['text'] ?>
            </p>
        <?php endif ?>

        <!-- linked slide -->
        <?php if ($slide['linkUrl']) : ?>
            <?= Html::a($this->t($slide['linkText']), $slide['linkUrl'], ['class' => 'btn btn-bordered white anim animated']) ?>
        <?php endif ?>
    </div>

</div>
<!-- end of slide -->