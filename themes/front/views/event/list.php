<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 20:56
 *
 * @var components\View $this
 * @var models\search\EventSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\bootstrap\Html;
use yii\widgets\ListView;

$this->title = $this->t('Events');
$this->subtitle = 'A badass compnay can only produce baddass work';

//$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['/front/events/list'],];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-section low-rider">
    <div class="container">
        <div class="row">

            <div class="col-lg-9">

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'list-wrapper',
                        'id' => 'events_list_view',
                    ],
                    'layout' => "{items}",
                    'itemView' => '_item-view',
                ]) ?>

                <?php /** @todo Make the pager */ ?>
                <!--<ul class="pagination anim fadeInLeft" data-wow-delay="0.2s">
                    <li><a href="single.html">&laquo;</a></li>
                    <li><a href="single.html">1</a></li>
                    <li><a href="single.html">2</a></li>
                    <li><a href="single.html">3</a></li>
                    <li><a href="single.html">4</a></li>
                    <li><a href="single.html">&raquo;</a></li>
                </ul>--><!-- .pagination -->

            </div><!-- .col-lg-9 -->

            <div class="col-lg-3 sidebar">
                <?= $this->render('_search', [
                    'model' => $searchModel,
                ]) ?>

                <h4 class="anim fadeInRight">
                    <?= $this->t('Filter') ?><i class="fa fa-filter"></i>
                </h4>
                <div class="anim fadeInRight">
                    <?= $this->render('_filter', [
                        'model' => $searchModel,
                    ]) ?>
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

                <!--<h4 class="anim fadeInRight">
                    <?/*= $this->t('Feedbacks') */?><i class="fa fa-comment"></i>
                </h4>
                <div class="anim fadeInRight">
                    <ul class="comments-wrapper">

                        <?php /** @todo Make the random feedbacks */ ?>
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
                            </ul>
                        </li>
                    </ul>
                </div>-->

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
