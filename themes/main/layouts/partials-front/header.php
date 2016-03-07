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

use yii\bootstrap\Html;
use models\Slide;
?>


<div class="slider-wrapper">

    <!-- masterslider -->
    <div class="master-slider" id="masterslider" data-height="fullscreen">

        <!-- Slide 1 -->
        <div class="ms-slide slide-1" style="z-index: 10" data-delay="8">

            <!-- slide background -->
            <img src="/img/design/transparent.png" data-src="/img/slider/image1.png" alt="lorem ipsum dolor sit" />

            <h1 class="ms-layer center" style="left:0; top:25px;"
                data-effect="rotatetop(-40,60,l)"
                data-duration="3500"
                data-delay="0"
                data-ease="easeOutExpo"
            >Welcome Human</h1>

            <h2 class="ms-layer center"  style="left:0; top:156px"
                data-effect="left(short)"
                data-duration="3500"
                data-delay="300"
                data-ease="easeOutExpo"
            >The picture you paint will be the one they’ll see.</h2>

            <!-- iPhone mockup -->
            <!--<img src="/img/blank.gif" data-src="/img/slider/iphone.png" alt="layer" class="ms-layer"
                 style="top:280px; left:145px; width:797px; height:595px;"
                 data-effect="bottom(100)"
                 data-duration="1200"
                 data-delay="600"
                 data-ease="easeOutQuad"
                 data-type="image"
            />-->

            <!-- First iPhone Screen Layer -->
            <!--<img src="/img/blank.gif" data-src="/img/slider/slide-1-iphonescreen-1.png" alt="layer" class="ms-layer"
                 style="top:345px; left:295px; width:489px; height:303px;"
                 data-type="image"
                 data-delay="600"
                 data-ease="easeOutQuad"
                 data-effect="bottom(100)"
                 data-duration="1200"
                 data-hide-ease="easeOutExpo"
                 data-hide-effect="top(200)"
                 data-hide-duration="1200"
                 data-hide-time="3000"
            />-->

            <!-- First iPhone Screen Layer -->
            <!--<img src="/img/blank.gif" data-src="/img/slider/slide-1-iphonescreen-1.png" alt="layer" class="ms-layer"
                 style="top:345px; left:295px; width:489px; height:303px;"
                 data-type="image"
                 data-delay="3000"
                 data-ease="easeOutQuad"
                 data-effect="bottom(0)"
                 data-duration="1200"
                 data-hide-ease="easeOutExpo"
                 data-hide-effect="top(200)"
                 data-hide-duration="1200"
                 data-hide-time="4500"
            />-->

            <!-- First iPhone Screen Layer -->
            <!--<img src="/img/blank.gif" data-src="/img/slider/slide-1-iphonescreen-1.png" alt="layer" class="ms-layer"
                 style="top:345px; left:295px; width:489px; height:303px;"
                 data-type="image"
                 data-delay="4500"
                 data-ease="easeOutQuad"
                 data-effect="bottom(0)"
                 data-duration="1200"
                 data-hide-ease="easeOutExpo"
                 data-hide-effect="top(200)"
                 data-hide-duration="1200"
                 data-hide-time="6000"
            />-->

            <!-- First iPhone Screen Layer -->
            <!--<img src="/img/blank.gif" data-src="/img/slider/slide-1-iphonescreen-3.png" alt="layer" class="ms-layer"
                 style="top:345px; left:295px; width:489px; height:303px;"
                 data-type="image"
                 data-delay="6000"
                 data-ease="easeOutQuad"
                 data-effect="bottom(0)"
                 data-duration="1200"
            />-->

        </div>
        <!-- end of slide -->

        <!-- slide 2 -->
        <div class="ms-slide slide-2" style="z-index: 11" data-delay="6">

            <!-- slide background -->
            <img src="/img/design/transparent.png" data-src="/img/slider/laptopglasses.png" alt="lorem ipsum dolor sit"/>

            <h2 class="ms-layer" style="left:7px; top:215px;"
                data-effect="top(100)"
                data-duration="3500"
                data-delay="0"
                data-ease="easeOutExpo"
            >A website like no other.</h2>

            <h1 class="ms-layer"  style="left:0; top:276px"
                data-effect="bottom(short)"
                data-duration="2500"
                data-delay="500"
                data-ease="easeOutExpo"
            >Modern, Clean, Minimal</h1>

            <p class="ms-layer h4" style="left:7px; top:415px; width:460px;"
               data-effect="bottom(short)"
               data-duration="1200"
               data-delay="600"
               data-ease="300"
            >Rigged with over xx homepages, xx header styels, xx sliders,
                xx footer styles, inifinite color options.</p>

            <p class="ms-layer h4" style="left:7px; top:517px; width:460px;"
               data-effect="bottom(short)"
               data-duration="1000"
               data-delay="650"
               data-ease="300"
            ><a class="btn btn-bordered white anim"  style="left:7px; top:460px;" role="button">Buy Dale</a></p>

        </div>
        <!-- end of slide -->

        <!-- slide 3 -->
        <div class="ms-slide slide-video" style="z-index: 9" data-delay="8">

            <!--<img src="/img/design/transparent.png" data-src="/img/slider/laptopglasses.png" alt="lorem ipsum dolor sit"/>-->
            <img src="/img/design/transparent.png" data-src="" alt="lorem ipsum dolor sit"/>

            <video id="video1" class="video-js vjs-default-skin" poster="/videos/CameraLens/CameraLens.jpg"  muted="" autoplay="" loop="" preload="">
                <source src="/videos/CameraLens/CameraLens.mp4" type='video/mp4' />
                <source src="/videos/CameraLens/CameraLens.webm" type='video/webm' />
                <source src="/videos/CameraLens/CameraLens.ogv" type='video/ogg' />
            </video>

            <h2 class="ms-layer" style="left:390px; top:215px;"
                data-effect="right(200)"
                data-duration="3500"
                data-delay="100"
                data-ease="easeOutExpo"
            >Custom Video Backgrounds</h2>

            <h1 class="ms-layer center"  style="left:0; top:276px"
                data-effect="bottom(short)"
                data-duration="2500"
                data-delay="800"
                data-ease="easeOutExpo"
            >Perfected Every Pixel</h1>

            <p class="ms-layer h4" style="left:91px; top:415px; width:460px;"
               data-effect="left(short)"
               data-duration="1200"
               data-delay="1200"
               data-ease="300"
            >All videos you see in the preview are available in the
                download file along with stock photos!</p>

        </div>
        <!-- end of slide -->

    </div> <!-- end of masterslider -->

    <a href="#firstSection"><i class="fa fa-chevron-down" id="go-down"></i></a>

</div><!-- end of slider-wrapper -->

<span id="nav-begins"></span><!-- place before navigation bar-->
<div class="container-wrapper navigation">
    <nav class="navbar navbar-default" role="navigation">

        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="/img/logo.jpg" />
                </a>
                <ul class="mini"></ul><!-- mobile navigation -->
            </div><!-- .navbar-header -->

            <div class="collapse navbar-collapse">
                <div class="right">
                    <ul class="nav navbar-nav">
                        <li class="active dropdown h">
                            <a href="#">Home</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Badass</a></li>
                                <li><a href="#">Dropdown</a></li>
                                <li><a href="#">Menu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown h">
                            <a href="#">Pages</a>
                            <ul class="dropdown-menu">
                                <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single.html">Single</a></li>
                                <li><a href="footer-alternate.html">Footer 2</a></li>
                            </ul>
                        </li>

                        <li class="dropdown h full">
                            <a href="#">Features</a>
                            <section class="container dropdown-menu">
                                	<span class="wrapper">
                                    	<div class="clear-wrapper">
                                            <article>
                                                <strong>PAGE STRUCTURE</strong>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-video-camera"></i>Video Backgrounds</a></li>
                                                    <li><a href="#"><i class="fa fa-picture-o"></i>Parallax Backgrounds</a></li>
                                                    <li><a href="#"><i class="fa fa-sun-o"></i>Light Background</a></li>
                                                    <li><a href="#"><i class="fa fa-moon-o"></i>Dark Background</a></li>
                                                </ul>
                                            </article>

                                            <span class="divider"></span>

                                            <article>
                                                <strong>PAGE ELEMENTS</strong>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-video-camera"></i>Lorem Ipsum</a></li>
                                                    <li><a href="#"><i class="fa fa-picture-o"></i>Dolar Sit</a></li>
                                                    <li><a href="#"><i class="fa fa-sun-o"></i>Amet</a></li>
                                                    <li><a href="#"><i class="fa fa-moon-o"></i>Varun Sitrem</a></li>
                                                </ul>
                                            </article>

                                            <span class="divider"></span>

                                            <article>
                                                <strong>SOME MORE STUFF</strong>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-video-camera"></i>Pricing</a></li>
                                                    <li><a href="#"><i class="fa fa-picture-o"></i>Content</a></li>
                                                    <li><a href="#"><i class="fa fa-sun-o"></i>Features</a></li>
                                                    <li><a href="#"><i class="fa fa-moon-o"></i>Typography</a></li>
                                                </ul>
                                            </article>
                                        </div><!-- .clear-wrapper -->

                                        <div class="color-wrapper">
                                            <strong>FRESH FROM THE BLOG</strong>
                                            <div class="nivo-wrapper">
                                                <div id="slider" class="nivoSlider">
                                                    <img src="/img/citydown.jpg" alt="" name="" width="310" height="150" />
                                                    <img src="/img/oceanscene.jpg" alt="" name="" width="310" height="150" />
                                                </div>
                                            </div>
                                            <p><a href="#">To see more, check out our portfolio page! Prepare to be impressed.</a></p>
                                        </div><!-- .color-wrapper -->
                                    </span>
                            </section><!-- .container.dropdown-menu -->
                        </li><!-- .dropdown.full -->

                        <li><a href="portfolio-1.html">Portfolio</a></li>
                        <li><a href="blog.html">Blog</a></li>
                    </ul>
                    <div class="navbar-form navbar-left">
                        <i class="fa fa-times"></i>
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        <div class="search-field">
            <div class="container">
                <form method="get" role="search">
                    <input type="text" name="s" placeholder="Type then press enter..." />
                    <button type="submit" class="hidden btn btn-default">Submit</button>
                </form>
            </div>
        </div><!-- search-field -->
    </nav>
</div>

