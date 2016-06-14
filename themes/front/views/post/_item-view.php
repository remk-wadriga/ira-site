<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 17:07
 *
 * @var components\View $this
 * @var models\Post $model
 */

use yii\bootstrap\Html;
?>

<div class="blog anim fadeInLeft">
    <span class="image">
        <?php $image = Html::img($model->imgUrl, ['alt' => $model->title]) ?>
        <?= Html::a($image, ['/front/post/view', 'id' => $model->id], [
            'data' => [
                'icon' => 'fa-link',
            ],
        ]) ?>
    </span><!-- .image -->

    <div class="date">
        <?= Html::a($this->day($model->dateCreate), '#', ['class' => 'day']) ?>
        <?= Html::a($this->month($model->dateCreate), '#', ['class' => 'month']) ?>
    </div><!-- .date -->

    <span class="title-desc">
        <h3><?= $model->title ?></h3>
        <ul class="meta">
            <li><a href="#"><i class="fa fa-user"></i><?= $model->ownerName ?></a></li>
            <!--<li><a href="single.html"><i class="fa fa-comment"></i>12</a></li>
            <li><a href="single.html"><i class="fa fa-heart"></i>1,201</a></li>
            <li><a href="single.html"><i class="fa fa-external-link"></i>31</a></li>-->
        </ul><!-- .meta -->
    </span><!-- .title-desc -->

    <p>
        <?= $this->subtext($model->text) ?>
    </p>

    <div class="row" >
        <?php if (!empty($model->tags)) : ?>
            <p class="tags-list">
                <label><?= $this->t('Tags') ?></label>: <?= implode(', ', $model->tags) ?>
            </p>
        <?php endif ?>
    </div>

    <?= Html::a('<i class="fa fa-long-arrow-right"></i>' . $this->t('Read More'), $model->cpuUrl, [
        'class' => 'btn btn-sm btn-primary icon',
        'role' => 'button',
        'data' => [
            'wow-delay' => '.45s',
        ],
    ]) ?>

    <div class="clearfix"></div>

</div><!-- .blog -->
