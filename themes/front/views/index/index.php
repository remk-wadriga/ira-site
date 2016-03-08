<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:34
 *
 * @var components\View $this
 */

use yii\helpers\Html;

$this->title = 'TITLE';
$this->params['showMainSlider'] = false;
?>

<section class="content-section" id="firstSection">
    <div class="container">
        <h1 class="anim fadeInDown"><i class="fa fa-gear"></i>OUR <span>SERVICES</span></h1>
        <p class="anim fadeInUp">
            We offer many various services at Dale! We will list a few right here,
            right now just to show you how incredibly awesome we are at our company!
        </p>
    </div>
</section>

<section class="feature-list">
    <div class="container">

        <div class="col-lg-4 feature anim fadeInLeft" data-wow-delay="0.25s">
            <i class="fa fa-trophy"></i>
            <div class="content">
                <h4>Award-Winning Designs</h4>
                <p>Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen risus at semper ullamcorp.</p>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInDown" data-wow-delay="0.25s">
            <i class="fa fa-eye"></i>
            <div class="content">
                <h4>Retina-Ready</h4>
                <p>Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen risus at semper ullamcorp.</p>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInRight" data-wow-delay="0.25s">
            <i class="fa fa-flask"></i>
            <div class="content">
                <h4>Creative Colors</h4>
                <p>Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen risus at semper ullamcorp.
                    Appreicate the  </p>
            </div>
        </div>

        <!-- Second Row -->
        <div class="col-lg-4 feature anim fadeInLeft" data-wow-delay="0.5s">
            <i class="fa fa-expand"></i>
            <div class="content">
                <h4>Responsive Design</h4>
                <p>Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen risus at semper ullamcorp.</p>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInUp" data-wow-delay="0.5s">
            <i class="fa fa-bug"></i>
            <div class="content">
                <h4>SEO Optimized</h4>
                <p>Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen risus at semper ullamcorp.</p>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInRight" data-wow-delay="0.5s">
            <i class="fa fa-coffee"></i>
            <div class="content">
                <h4>Beautiful Code</h4>
                <p>Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen risus at semper ullamcorp.</p>
            </div>
        </div>
        <!-- End of second row -->

    </div>
</section><!-- .feature-list -->

<section class="content-section fixed video blur">
    <span class="shadows"></span>

    <div class="video-wrapper">
        <video id="video1" class="video-js vjs-default-skin" poster="videos/RecordPlayer/poster.jpg" width="1600" height="901" muted="" autoplay="" loop="" preload="">
            <source src="videos/RecordPlayer/RecordPlayer.mp4" type='video/mp4' />
            <source src="videos/RecordPlayer/RecordPlayer.webm" type='video/webm' />
            <source src="videos/RecordPlayer/RecordPlayer.ogv" type='video/ogg' />
        </video>
    </div><!-- .video-wrapper -->

    <div class="container anim fadeInUp">
        <i class="fa fa-quote-left"></i>
        <ul class="testimonials" id="testimonials">

            <li class="ms-slide">
                <img src="/img/design/transparent.png" data-src="/img/design/transparent.png" />
                <h3>Dream more than others think practical. Expect more than others think possible.</h3>
                <cite><strong>Howard Schultz</strong> - Starbucks CEO</cite>
            </li>

            <li class="ms-slide">
                <img src="/img/design/transparent.png" data-src="/img/design/transparent.png"  />
                <h3>I love to compete. To me, business is the ultimate sport. It's always on.</h3>
                <cite><strong>Mark Cuban</strong> - Businessman</cite>
            </li>

            <li class="ms-slide">
                <img src="/img/design/transparent.png" data-src="/img/design/transparent.png"  />
                <h3>Business is a sprint until you find an opportunity, then it's the patience of a marathon runner.</h3>
                <cite><strong>Robert Herjavec</strong> - Businessman</cite>
            </li>

        </ul><!-- .testimonials -->
        <i class="fa fa-quote-right"></i>
    </div><!-- .container -->

    <!-- Optional Nav
    <div class="ms-nav-prev" id="tPrev"></div>
    <div class="ms-nav-next" id="tNext"></div>
    -->

</section><!-- .content-section -->

<section class="content-section anim fadeInDown" data-wow-delay="0.25s">
    <div class="container">
        <h1><i class="fa fa-pencil"></i>OUR <span>WORK</span></h1>
        <p>We offer many various services at Dale! We will list a few right here, right now just to show you how incredibly awesome we are at our company!</p>
    </div>
</section>

<section class="portfolio">
    <div class="container">
        <div class="filter anim fadeInDown" data-wow-delay="0.55s">
            <ul id="filters">
                <li><a class="btn btn-bordered hot btn-sm" role="button" data-filter="*">All</a></li>
                <li><a class="btn btn-bordered btn-sm" role="button" data-filter=".work">Work</a></li>
                <li><a class="btn btn-bordered btn-sm" role="button" data-filter=".projects">Projects</a></li>
            </ul>
        </div>
        <!-- Standard button -->
    </div><!-- container -->
    <div class="gallary">
        <div class="preview">
            <i class="fa fa-spinner fa-spin"></i>
        </div>

        <ul>

            <li class="work">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

            <li class="work projects">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

            <li class="projects">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

            <li class="work">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>
            <!-- End of row -->

            <li class="work">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

            <li class="projects">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

            <li class="projects">
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

            <li>
                <a href="/img/blog-image-2.jpg" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                    <img src="http://placehold.it/400x300g/f8c2c5/ffffff" />
                </a>
            </li>

        </ul>

        <div class="clearfix"></div>
    </div>
</section><!-- portfolio -->

<section class="content-section anim fadeInDown" data-wow-delay="0.25s">
    <div class="container">
        <h1><i class="fa fa-rocket"></i>OUR BADASS <span>TEAM</span></h1>
        <p>
            The great services would not have been remotley possible if it was not for the effort exerted
            by our amazing and talented team, check them out.
        </p>
    </div>
</section><!-- .content-section -->

<section class="content-section parallax-bg-2 team" data-stellar-background-ratio="0.15">

    <div class="container">
        <div class="col-lg-12 anim fadeInDown">

            <div class="relative">
                <!-- masterslider -->
                <div class="master-slider wrapper" id="teamslider">

                    <div class="ms-slide" data-member-id="1" data-title="Optional Title">
                        <img src="/img/design/blank.jpg" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">ELLEN JOHN</span>
                            <span class="position">Public Relations</span>
                        </div><!-- .ms-info -->
                    </div>

                    <div class="ms-slide" data-member-id="2">
                        <img src="/img/design/blank.jpg" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">PAUL HOLDER</span>
                            <span class="position">Team Motivator</span>
                        </div><!-- .ms-info -->
                    </div>

                    <div class="ms-slide" data-member-id="3">
                        <img src="/img/design/blank.jpg" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">SARAH SMITH</span>
                            <span class="position">Marketing Director</span>
                        </div><!-- .ms-info -->
                    </div>

                    <div class="ms-slide" data-member-id="4">
                        <img src="/img/design/blank.jpg" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">MARK DOE</span>
                            <span class="position">Company CEO</span>
                        </div><!-- .ms-info -->
                    </div>

                </div>

                <div class="ms-info" id="staff-info"></div>
                <div class="ms-nav-prev"></div>
                <div class="ms-nav-next"></div>
            </div><!-- .relative -->

        </div><!-- .col-lg-12 -->

        <div class="member-box-wrapper">

            <!-- Person 1 Box -->
            <div class="member-box" id="1">

                <div class="color-wrapper">
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                    <img src="http://placehold.it/300x295/f8c2c5/ffffff" alt="Team Member Girl" />
                    <strong>Ellen John</strong>
                    <span>Public Relations</span>
                    <ul class="social-media">
                        <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#github"><i class="fa fa-github"></i></a></li>
                        <li><a href="#pintrest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#email"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div><!-- .color-wrapper -->

                <div class="clear-wrapper">
                    <h3>About Me</h3>
                    <p>Phasellus condimentum sed diam vel vulputate. Pellentesque <a href="#">external link</a> nunc.
                        Nullam volutpat dapibus orci, a porttitor dolor dignissim id. Nulla turpis
                        tellus, sodales nec tincidunt in, auctor ac lacus.</p>

                    <h3>Skills</h3>
                    <ul class="bars">
                        <li>
                            <strong>Speaking</strong>
                            <span>90%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="90"></div></div>
                        </li>
                        <li>
                            <strong>People</strong>
                            <span>88%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="80"></div></div>
                        </li>
                        <li>
                            <strong>Marketing</strong>
                            <span>86%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="86"></div></div>
                        </li>
                        <li>
                            <strong>Campaigning</strong>
                            <span>82%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="82"></div></div>
                        </li>
                    </ul>

                </div><!-- .clear-wrapper -->
                <div class="shadow-lg"></div><!-- Remove this to remove the bottom shadow -->
            </div><!-- .member-box -->

            <!-- Person 2 Box -->
            <div class="member-box" id="2">

                <div class="color-wrapper">
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                    <img src="http://placehold.it/300x295/f8c2c5/ffffff" alt="Team Member Girl" />
                    <strong>Paul Holder</strong>
                    <span>Team Motivator</span>
                    <ul class="social-media">
                        <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#github"><i class="fa fa-github"></i></a></li>
                        <li><a href="#pintrest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#email"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div><!-- .color-wrapper -->

                <div class="clear-wrapper">
                    <h3>About Me</h3>
                    <p>Lorem ipsum dolor sit amet, <a href="#">external link</a> consectetur adipiscing elit. Ut urna velit,
                        laoreet a tincidunt non, ullamcorper vitae mauris.  Ut id dui nec enim
                        volutpat vehicula ut eget nunc.</p>

                    <h3>Skills</h3>
                    <ul class="bars">
                        <li>
                            <strong>Communication</strong>
                            <span>95%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="95"></div></div>
                        </li>
                        <li>
                            <strong>Public Relations</strong>
                            <span>90%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="90"></div></div>
                        </li>
                        <li>
                            <strong>Marketing</strong>
                            <span>86%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="86"></div></div>
                        </li>
                        <li>
                            <strong>Campaigning</strong>
                            <span>82%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="82"></div></div>
                        </li>
                    </ul>

                </div><!-- .clear-wrapper -->

                <div class="shadow-lg"></div><!-- Remove this to remove the bottom shadow -->
            </div><!-- .member-box -->

            <!-- Person 3 Box -->
            <div class="member-box" id="3">

                <div class="color-wrapper">
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                    <img src="http://placehold.it/300x295/f8c2c5/ffffff" alt="Team Member Girl" />
                    <strong>Sarah Smith</strong>
                    <span>Marketing Director</span>
                    <ul class="social-media">
                        <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#github"><i class="fa fa-github"></i></a></li>
                        <li><a href="#pintrest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#email"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div><!-- .color-wrapper -->

                <div class="clear-wrapper">
                    <h3>About Me</h3>
                    <p>Phasellus condimentum sed diam vel vulputate. Pellentesque nec lorem nunc.
                        Nullam volutpat dapibus orci, a <a href="#">external link</a> id. Nulla turpis
                        tellus, sodales nec tincidunt in, auctor ac lacus.</p>

                    <h3>Skills</h3>
                    <ul class="bars">
                        <li>
                            <strong>Speaking</strong>
                            <span>90%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="90"></div></div>
                        </li>
                        <li>
                            <strong>People</strong>
                            <span>88%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="80"></div></div>
                        </li>
                        <li>
                            <strong>Marketing</strong>
                            <span>86%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="86"></div></div>
                        </li>
                        <li>
                            <strong>Campaigning</strong>
                            <span>82%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="82"></div></div>
                        </li>
                    </ul>

                </div><!-- .clear-wrapper -->

                <div class="shadow-lg"></div><!-- Remove this to remove the bottom shadow -->
            </div><!-- .member-box -->

            <!-- Person 3 Box -->
            <div class="member-box" id="4">

                <div class="color-wrapper">
                    <a href="#" id="close"><i class="fa fa-times"></i></a>
                    <img src="http://placehold.it/300x295/f8c2c5/ffffff" alt="Team Member Girl" />
                    <strong>Mark Doe</strong>
                    <span>Company Ceo</span>
                    <ul class="social-media">
                        <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#github"><i class="fa fa-github"></i></a></li>
                        <li><a href="#pintrest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#email"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div><!-- .color-wrapper -->

                <div class="clear-wrapper">
                    <h3>About Me</h3>
                    <p>Phasellus condimentum sed diam vel vulputate. Pellentesque nec lorem nunc.
                        Nullam volutpat dapibus orci, a <a href="#">external link</a> id. Nulla turpis
                        tellus, sodales nec tincidunt in, auctor ac lacus.</p>

                    <h3>Skills</h3>
                    <ul class="bars">
                        <li>
                            <strong>Speaking</strong>
                            <span>90%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="90"></div></div>
                        </li>
                        <li>
                            <strong>People</strong>
                            <span>88%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="80"></div></div>
                        </li>
                        <li>
                            <strong>Marketing</strong>
                            <span>86%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="86"></div></div>
                        </li>
                        <li>
                            <strong>Campaigning</strong>
                            <span>82%</span>
                            <div class="progress"><div class="progress-bar" role="progressbar" data-value="82"></div></div>
                        </li>
                    </ul>

                </div><!-- .clear-wrapper -->

                <div class="shadow-lg"></div><!-- Remove this to remove the bottom shadow -->
            </div><!-- .member-box -->

        </div><!-- .member-box-wrapper -->
    </div><!-- .container -->
</section><!-- .team -->

<section class="content-section anim fadeInDown">
    <div class="container">
        <h1><i class="fa fa-pencil-square-o"></i>CONTACT <span>US</span></h1>
        <p>
            Our primary concern is dealing with our customers and making sure that they are satisfied.
            Any questions, comments, or concerns you may have are very important to us.
        </p>
    </div>
</section><!-- .content-section -->

<section class="content-section form contact light">
    <div class="container">

        <span id="message"></span><!-- remove #message to stop floating jQuery messages -->

        <form target="#" name="contact">
            <div class="col-lg-5 anim fadeInLeft">

                    <span class="input-group">
                        <i class="fa fa-user"></i>
                        <input type="text" name="contactName" id="contactName" class="lg" placeholder="Name" />
                    </span><!-- .input-group -->

                    <span class="input-group">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="contactEmail" id="contactAddress" class="lg" placeholder="Email Address" />
                    </span><!-- .input-group -->

                   	<span class="input-group">
                        <i class="fa fa-book"></i>
                        <input type="text" name="contactSubject" id="contactSubject" class="lg" placeholder="Subject" />
                    </span><!-- .input-group -->

            </div><!-- .col-5 -->

            <div class="col-lg-7 anim fadeInRight">

                 	<span class="input-group">
                        <textarea name="contactMessage" id="contactMessage" class="lg" placeholder="What's on your mind?"></textarea>
                    </span><!-- .input-group -->

                    <span class="input-group">
                    	<button class="submit" id="submit_contact" data-loading-text="SENDING...">SEND</button>
                    </span><!-- .input-group -->
            </div>
        </form>
    </div><!-- .container -->

    <span id="message_sent"><i class="fa-check fa"></i></span><!-- jQuery display of giant checkmark -->

</section><!-- .content-section .form -->