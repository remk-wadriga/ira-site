<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 0:18
 *
 * @var components\View $this
 */

use yii\bootstrap\Html;
?>

<footer class="classic">
    <section class="content-section parallax-bg-3" data-stellar-background-ratio=".15">

        <div class="container">

            <div class="col-lg-12">
                <h1 class="anim fadeInDown">Подписаться на рассылку</h1>
                <div class="center-buttons">
                    <p>
                        <a class="btn btn-bordered white anim fadeInRight" role="button">подписаться</a>
                    </p>
                </div><!-- .center-buttons -->
            </div>

        </div><!-- .container -->

        <div class="foot-wrapper">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 anim fadeInLeft">
                        <span class="logo">
                            <?= Html::img('/img/main_logo.jpg') ?>
                        </span><!-- .logo -->
                        <p>
                            Aenean lacinia bibendum nulla sed leo erat a ante venenatis dapibus posuere velit aliquet.
                            Donec ullamcorper metus auctor fringi. Nillam quis risus.
                        </p>
                    </div><!-- .col-lg-3 -->

                    <div class="col-md-3 anim fadeInLeft">
                        <h5><i class="fa fa-twitter-square"></i>TWITTERSPHERE</h5>

                        <div class="twitter-feed-wrapper">
                            <div id="twitter-feed"></div>
                        </div>

                    </div><!-- .col-lg-3 -->

                    <div class="col-md-3">
                        <h5 class="anim fadeInRight"><i class="fa fa-rocket"></i>PAGES TO VISIT</h5>
                        <ul class="pages">
                            <li class="anim fadeInRight" data-wow-delay="0.35s"><a class="btn btn-bordered white" role="button" href="#">Home</a></li>
                            <li class="anim fadeInRight" data-wow-delay="0.37s"><a class="btn btn-bordered white" role="button" href="#">Portfolio</a></li>
                            <li class="anim fadeInRight" data-wow-delay="0.39s"><a class="btn btn-bordered white" role="button" href="#">About</a></li>

                            <li class="anim fadeInRight" data-wow-delay="0.42s"><a class="btn btn-bordered white" role="button" href="#">Blog</a></li>
                            <li class="anim fadeInRight" data-wow-delay="0.45s"><a class="btn btn-bordered white" role="button" href="#">Contact</a></li>
                            <li class="anim fadeInRight" data-wow-delay="0.49s"><a class="btn btn-bordered white" role="button" href="#">About</a></li>

                            <li class="anim fadeInRight" data-wow-delay="0.51s"><a class="btn btn-bordered white" role="button" href="#">Single Post</a></li>
                            <li class="anim fadeInRight" data-wow-delay="0.54s"><a class="btn btn-bordered white" role="button" href="#">Contact</a></li>
                        </ul><!-- .pages -->
                    </div><!-- .col-lg-3 -->

                    <div class="col-md-3 anim fadeInRight">
                        <h5><i class="fa fa-rss"></i>STAY CONNECTED</h5>

                        <div class="contact-info">
                            <p>
                                Feel free to call us any time, we have a staff
                                dedicated to taking your calls.
                            </p>

                                    <span>
                                    	<i class="fa fa-phone"></i>
                                        +1 (313) 123 - 4321
                                    </span>

                                    <span>
                                    	<i class="fa fa-envelope"></i>
                                        support@example.com
                                    </span>

                            <ul class="social-media" data-wow-delay="0.25s">
                                <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#github"><i class="fa fa-github"></i></a></li>
                                <li><a href="#pintrest"><i class="fa fa-pinterest"></i></a></li>
                            </ul><!-- .social-media -->
                        </div>
                    </div><!-- .col-lg-3 -->

                </div><!-- .row -->

                <div class="row">
                    <div class="col-lg-12">
                        <span class="copyright">Copyright 2014 Empirical Themes LLC - All RIghts Reserved</span>
                    </div><!-- .col-lg-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .foot-wrapper -->


        </div><!-- .container -->
    </section><!-- .content-section -->

</footer>