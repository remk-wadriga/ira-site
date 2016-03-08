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
<div class="<?= $class ?> slide-<?= $index ?>" style="z-index: 10" data-delay="8">

    <!-- slide background -->
    <?= Html::img($slide['backgroundImage'], [
        'alt' => (string)$slide['imgAlt'],
        'data' => [
            'src' => $slide['imgUrl'],
        ],
    ]) ?>

    <h1 class="ms-layer center" style="left:0; top:25px;"
        data-effect="rotatetop(-40,60,l)"
        data-duration="3500"
        data-delay="0"
        data-ease="easeOutExpo"
    ><?= $slide['title'] ?></h1>

    <?php if ($slide['subTitle']) : ?>
        <h2 class="ms-layer center"  style="left:0; top:156px"
            data-effect="left(short)"
            data-duration="3500"
            data-delay="300"
            data-ease="easeOutExpo"
        ><?= $slide['subTitle'] ?></h2>
    <?php endif ?>

    <?php if ($slide['text']) : ?>
        <p class="ms-layer h4" style="left:7px; top:415px; width:460px;"
           data-effect="bottom(short)"
           data-duration="1200"
           data-delay="600"
           data-ease="300"
        ><?= $slide['text'] ?></p>
    <?php endif ?>

    <?php if ($slide['linkUrl']) : ?>
        <?= Html::a($this->t($slide['linkText']), $slide['linkUrl'], [
            'class' => 'btn btn-bordered white anim',
            'style' => 'left:7px; top:460px;',
            'role' => 'button',
        ]) ?>
    <?php endif ?>

</div>
<!-- end of slide -->
