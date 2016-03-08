<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 1:34
 *
 * @var components\View $this
 * @var array $slides
 * @var string $id
 * @var string $class
 * @var string $dataHeight
 * @var string $slideClass
 */
?>

<!-- masterslider -->
<div class="<?= $class ?>" id="<?= $id ?>" data-height="<?= $dataHeight ?>">
    <?php foreach ($slides as $index => $slide) : ?>
        <?= $this->render('slide-item', [
            'index' => $index + 1,
            'slide' => $slide,
            'class' => $slideClass,
        ]) ?>
    <?php endforeach ?>

</div>
<!-- end of masterslider -->


