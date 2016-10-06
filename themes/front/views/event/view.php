<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 20:08
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;
use models\UserClick;

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['/front/event/list']];
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content-section low-rider">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 single">

                <div class="blog">
                        <span class="image anim fadeIn">
                            <?= Html::a(Html::img($model->mainImageUrl), '#') ?>
                        </span><!-- .image -->

                    <div class="date anim fadeIn">
                        <?= Html::a($this->day($model->dateStart), '#', ['class' => 'day']) ?>
                        <?= Html::a($this->month($model->dateStart), '#', ['class' => 'month']) ?>
                    </div><!-- .date -->

                        <span class="title-desc anim fadeIn">
                            <h3><?= $model->name ?></h3>
                            <ul class="meta">
                                <li>
                                    <?= $this->render('@common/user-click-btn', [
                                        'model' => $model,
                                        'type' => UserClick::TYPE_INTEREST,
                                    ]) ?>
                                </li>
                                <?php if (!empty($model->trainers)) : ?>
                                    <?php foreach ($model->trainers as $trainer) : ?>
                                        <li>
                                            <?= Html::a('<i class="fa fa-user"></i>' . $trainer->fullName, '#', [
                                                'title' => $this->t('Trainer: {name}', ['name' => $trainer->fullName]),
                                                'data' => [
                                                    'toggle' => 'tooltip',
                                                ],
                                            ]) ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif ?>
                                <!--<li><a href="#"><i class="fa fa-comment"></i>12</a></li>
                                <li><a href="#"><i class="fa fa-heart"></i>1,201</a></li>
                                <li><a href="#"><i class="fa fa-external-link"></i>31</a></li>-->
                            </ul><!-- .meta -->
                        </span><!-- .title-desc -->

                    <p class="anim fadeIn"><?= $model->description ?></p>

                    <?php if ($model->citation) : ?>
                        <blockquote class="anim fadeIn">
                            <i class="fa fa-quote-left"></i><?= $model->citation ?>
                        </blockquote>
                    <?php endif ?>

                    <?php if (!empty($model->images)) : ?>
                        <p class="fadeIn">
                            <?php foreach ($model->images as $image) : ?>
                                <?= Html::img($image->url, ['class' => 'small-img']) ?>
                            <?php endforeach ?>
                        </p>
                    <?php endif ?>

                </div><!-- .blog -->

                <div class="clearfix"></div>

                <h4 class="anim fadeIn" data-wow-delay=".2s"><?= $this->t('Trainer') ?></h4>

                <?php if ($model->owner !== null) : ?>
                <div class="author anim fadeIn">
                    <img src="<?= $model->owner->avatarUrl ?>" alt="<?= $model->owner->avatarAlt ?>" />
                    <h5><?= $model->owner->fullName ?></h5>
                    <?php /* @todo create social networks links */ ?>
                    <!--<span>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </span>-->
                    <p><?= $model->owner->info ?></p>
                </div><!-- .author -->
                <?php else : ?>
                    <h5><?= $model->ownerName ?></h5>
                <?php endif ?>

                <h4 class="anim fadeIn">
                    <?= $this->t('Comments ({count})', ['count' => count($model->comments)]) ?>
                </h4>
                <?php $blockD = 'comments_block_' . str_replace('\\', '_', $model::className()) . '_' . $model->id ?>
                <ul id="<?= $blockD ?>" class="comments">
                    <?php if (!empty($model->comments)) : ?>
                        <?php foreach ($model->comments as $comment) : ?>
                            <?= $this->render('@frontViews/comment/_item', [
                                'comment' => $comment,
                            ]) ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>

                <?php if (!Yii::$app->user->isGuest) : ?>
                    <?= $this->render('@frontViews/comment/_form-tmpl', [
                        'model' => $model,
                    ]) ?>
                    <?= $this->render('@frontViews/comment/_leave-comment-btn', [
                        'model' => $model,
                    ]) ?>
                    <div class="form contact style-2 comment-form-container"></div>
                <?php else : ?>
                    <h6 class="anim fadeIn animated">
                        <?= Html::a($this->t('Sign in to leave a comment'), ['/site/auth/login']) ?>
                    </h6>
                <?php endif ?>

            </div><!-- .col-lg-9 -->

            <div class="col-lg-3 sidebar">
                <?php if (!empty($model->lastComments)) : ?>
                <h4 class="anim fadeInRight">
                    <?= $this->t('Comments') ?><i class="fa fa-comment"></i>
                </h4>

                <div class="anim fadeInRight">
                    <ul id="carousel" class="comments-wrapper">
                        <li>
                            <ul class="comments">
                                <?php foreach($model->lastComments as $comment) : ?>
                                    <li>
                                        <?= $this->subtext($comment->text) ?>&hellip;
                                        - <?= Html::a($comment->userName, '#') ?>
                                    </li>
                                <?php endforeach ?>
                            </ul><!-- .comments -->
                        </li>
                    </ul><!-- .comments-wrapper -->
                </div>
                <?php endif ?>

                <?php if (!empty($model->tags)) : ?>
                    <h4 class="anim fadeInRight">
                        <?= $this->t('Tags') ?><i class="fa fa-tags"></i>
                    </h4>
                    <div class="anim fadeInRight">
                        <div class="comments-wrapper tags-list">
                            <?= implode("<br />", $model->tags) ?>
                        </div><!-- .testimonials -->
                    </div>
                <?php endif ?>
            </div><!-- .col-lg-4 .sidebar -->


        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- .content-section -->

<section class="content-section callout">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 anim fadeInLeft">
                <p> Aenean fermentum libero eu lectus tristique, quis ornare tortor tristique pretium. </p>
            </div><!-- .col-lg-8 -->
            <div class="col-lg-4 anim fadeInRight">
                <a class="btn btn-bordered white btn-sm anim fadeInRight" role="button">Action 2</a>
                <a class="btn btn-bordered white btn-sm anim fadeInRight" role="button">Buy Dale</a>
            </div><!-- .col-lg-4 -->
        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- .content-section -->
