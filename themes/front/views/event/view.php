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

$this->title = $model->name;
$this->subtitle = 'am ipsum nunc, egestas eu nisl non, auctor consequat leo.';

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
                                <li><a href="#"><i class="fa fa-user"></i><?= $model->ownerName ?></a></li>
                                <!--<li><a href="#"><i class="fa fa-comment"></i>12</a></li>
                                <li><a href="#"><i class="fa fa-heart"></i>1,201</a></li>
                                <li><a href="#"><i class="fa fa-external-link"></i>31</a></li>-->
                            </ul><!-- .meta -->
                        </span><!-- .title-desc -->

                    <p class="anim fadeIn"><?= $model->description ?></p>

                    <!--<blockquote class="anim fadeIn">
                        <i class="fa fa-quote-left"></i>Nam ipsum nunc, egestas eu nisl non, auctor conse at leo. Phasellus et neque  sit amet sapien ultric vit. Donec pretium, quam id porta eleifend, justo erat taso.
                    </blockquote>-->


                </div><!-- .blog -->

                <div class="clearfix"></div>

                <h4 class="anim fadeIn" data-wow-delay=".2s"><?= $this->t('Trainer') ?></h4>

                <?php if ($model->owner !== null) : ?>
                <div class="author anim fadeIn">
                    <?php /* @todo create user avatars */ ?>
                    <img src="images/blog-author-example.jpg" alt="Dale Blog Post Author Example" />
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
                    Comments (4)
                </h4>

                <ul class="comments">
                    <li class="anim fadeIn" data-wow-delay="0.2s">
                        <div class="wrapper">
                            <img src="images/blog-author-example.jpg" alt="Dale Blog Post Author Example" />
                            <h5>
                                Sarah Smith
                            </h5>
                                <span>
                                    January 07, 2015
                                </span>
                            <p>
                                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis sodales facilis egas
                                gravida quam ut laoreet. Nulla rutrum facilisis egestas. Morbi accumsan massa id lectus placerat lacinia vel rutrum
                                sed est. Integer consequat justo et neque scelerisque, quis congue urna iaculis.
                            </p>
                            <a href="#">
                                Reply
                            </a>
                        </div><!-- .wrapper -->
                    </li>

                    <li>
                        <div class="wrapper anim fadeIn" data-wow-delay="0.2s">
                            <img src="images/blog-author-example.jpg" alt="Dale Blog Post Author Example" />
                            <h5>
                                Sarah Smith
                            </h5>
                                <span>
                                    January 07, 2015
                                </span>
                            <p>
                                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis sodales facilis egas
                                gravida quam ut laoreet. Nulla rutrum facilisis egestas. Morbi accumsan massa id lectus placerat lacinia vel rutrum
                                sed est. Integer consequat justo et neque scelerisque, quis congue urna iaculis.
                            </p>
                            <a href="#">
                                Reply
                            </a>
                        </div><!-- .wrapper -->

                        <ul><!-- nested comments -->
                            <li>
                                <div class="wrapper anim fadeIn" data-wow-delay="0.2s">
                                    <img src="images/blog-author-example.jpg" alt="Dale Blog Post Author Example" />
                                    <h5>
                                        Sarah Smith
                                    </h5>
                                        <span>
                                            January 07, 2015
                                        </span>
                                    <p>
                                        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis sodales facilis egas
                                        gravida quam ut laoreet. Nulla rutrum facilisis egestas. Morbi accumsan massa id lectus placerat lacinia vel rutrum
                                        sed est. Integer consequat justo et neque scelerisque, quis congue urna iaculis.
                                    </p>
                                    <a href="#">
                                        Reply
                                    </a>
                                </div><!-- .wrapper -->
                            </li>

                        </ul><!-- end of nested comments -->

                    </li>

                    <li>
                        <div class="wrapper anim fadeIn" data-wow-delay="0.2s">
                            <img src="images/blog-author-example.jpg" alt="Dale Blog Post Author Example" />
                            <h5>
                                Sarah Smith
                            </h5>
                                <span>
                                    January 07, 2015
                                </span>
                            <p>
                                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis sodales facilis egas
                                gravida quam ut laoreet. Nulla rutrum facilisis egestas. Morbi accumsan massa id lectus placerat lacinia vel rutrum
                                sed est. Integer consequat justo et neque scelerisque, quis congue urna iaculis.
                            </p>
                            <a href="#">
                                Reply
                            </a>
                        </div><!-- .wrapper -->
                    </li>
                </ul>

                <h6 class="anim fadeIn" data-wow-delay="0.24s">
                    Leave a Comment
                </h6>

                <div class="form contact style-2">
                    <form target="#" name="contact">
                            <span class="input-group anim fadeIn" data-wow-delay="0.1s">
                                <i class="fa fa-user"></i>
                                <input type="text" name="contactName" id="contactName" class="lg" placeholder="Name" />
                            </span><!-- .input-group -->

                            <span class="input-group anim fadeIn" data-wow-delay="0.20s">
                                <i class="fa fa-envelope"></i>
                                <input type="text" name="contactEmail" id="contactAddress" class="lg" placeholder="Email Address" />
                            </span><!-- .input-group -->

                            <span class="input-group anim fadeIn" data-wow-delay="0.30s">
                                <textarea name="contactMessage" id="contactMessage" class="lg" placeholder="What's on your mind?"></textarea>
                            </span><!-- .input-group -->

                        <span id="message"></span>

                        <a class="btn btn-sm btn-primary icon anim fadeIn" data-wow-delay=".45s" role="button"><i class="fa fa-long-arrow-right"></i>Post my Comment</a>
                    </form>
                </div>

            </div><!-- .col-lg-9 -->

            <div class="col-lg-3 sidebar">
                <h4 class="anim fadeInRight">
                    <?= $this->t('Comments') ?><i class="fa fa-comment"></i>
                </h4>

                <div class="anim fadeInRight">
                    <ul id="carousel" class="comments-wrapper">
                        <?php /* @todo create comments system */ ?>
                        <li>
                            <ul class="comments">
                                <li>
                                    Quisque accumsan justo ut malesuada sa&hellip;
                                    <a href="single.html">- Username</a>
                                </li>
                                <li>
                                    Suspendisse euismod turpis eu aliquam t&hellip;
                                    <a href="single.html">- Username</a>
                                </li>
                                <li>
                                    Nullam faucibus eros quis nisl gravidas lo&hellip;
                                    <a href="single.html">- Username</a>
                                </li>
                            </ul><!-- .comments -->
                        </li>
                    </ul><!-- .comments-wrapper -->
                </div>

                <h4 class="anim fadeInRight">
                    <?= $this->t('Tags') ?><i class="fa fa-tags"></i>
                </h4>
                <div class="anim fadeInRight">
                    <div class="comments-wrapper">
                        <?php /** @todo Make the tags */ ?>
                        <!-- Tags -->
                    </div><!-- .testimonials -->
                </div>

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
