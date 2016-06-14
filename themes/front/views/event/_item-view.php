<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 17:07
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;
?>

<div class="blog anim fadeInLeft">
    <span class="image">
        <?php $image = Html::img($model->mainImageUrl, ['alt' => $model->name]) ?>
        <?= Html::a($image, ['/front/event/view', 'id' => $model->id], [
            'data' => [
                'icon' => 'fa-link',
            ],
        ]) ?>
    </span><!-- .image -->

    <div class="date">
        <?= Html::a($this->day($model->dateStart), '#', ['class' => 'day']) ?>
        <?= Html::a($this->month($model->dateStart), '#', ['class' => 'month']) ?>
    </div><!-- .date -->

    <span class="title-desc">
        <h3><?= $model->name ?></h3>
        <ul class="meta">
            <li><a href="#"><i class="fa fa-user"></i><?= $model->ownerName ?></a></li>
            <!--<li><a href="single.html"><i class="fa fa-comment"></i>12</a></li>
            <li><a href="single.html"><i class="fa fa-heart"></i>1,201</a></li>
            <li><a href="single.html"><i class="fa fa-external-link"></i>31</a></li>-->
        </ul><!-- .meta -->
    </span><!-- .title-desc -->

    <p>
        <?= $this->subtext($model->description) ?>
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

    <?php if ($model->canUserRegister()) : ?>
        <?= $this->render('_register-button', ['model' => $model]) ?>
    <?php endif ?>

    <div class="clearfix"></div>

</div><!-- .blog -->
