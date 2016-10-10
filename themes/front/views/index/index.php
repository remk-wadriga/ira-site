<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:34
 *
 * @var components\View $this
 * @var models\Event[] $events
 */

use yii\helpers\Html;

$this->title = Yii::$app->name;
$this->params['showMainSlider'] = true;
?>

<section class="content-section" id="firstSection">
    <div class="container">
        <h1 class="anim fadeInDown"><i class="fa fa-gear"></i>Добро пожаловать на сайт центра развития личности  <span>«Альтернатива»</span></h1>
        <p class="anim fadeInUp">
            <p class="text-align-left margin-left-20">Центр развития личности «Альтернатива» – это пространство для личностного роста, самопознания и общения, в котором для вас объединились психология, философия, телесные практики и творчество.</p>
            <p class="text-align-left margin-left-20">Здесь вы можете:</p>
                <p class="text-align-left margin-left-80">- получить консультацию специалиста по вопросам жизненных кризисов</p>
                <p class="text-align-left margin-left-80">- пройти курс психотерапии</p>
                <p class="text-align-left margin-left-80">- посетить интересные психологические тренинги</p>
                <p class="text-align-left margin-left-80">- развить творческие способности на тематических мастер-классах</p>
                <p class="text-align-left margin-left-80">- найти ответы на свои вопросы с помощью методик ассоциативных карт и участия в психологических играх</p>
                <p class="text-align-left margin-left-80">- узнать новую и полезную информацию, посетив наши лекции</p>
                <p class="text-align-left margin-left-80">- найти единомышленников в дискуссионном клубе</p>
            <p class="text-align-left margin-left-20">Мы создали комфортное и безопасное пространство для вашего развития, где вы можете получить нужную помощь и участие со стороны наших специалистов!</p>
            <p class="text-align-left margin-left-20">Мы делаем это, потому что верим в способность к изменению и росту каждого человека!</p>
            <p class="text-align-left margin-left-20">И мы знаем: если даже сейчас что-то идет не так, всегда есть лучшая альтернатива!</p>
        </p>
    </div>
</section>

<section class="feature-list">
    <div class="container">

        <div class="col-lg-4 feature anim fadeInLeft" data-wow-delay="0.25s">
            <i class="fa fa-trophy"></i>
            <div class="content">
                <h4>Индивидуальное консультирование</h4>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInDown" data-wow-delay="0.25s">
            <i class="fa fa-eye"></i>
            <div class="content">
                <h4>Групповая психотерапия</h4>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInRight" data-wow-delay="0.25s">
            <i class="fa fa-flask"></i>
            <div class="content">
                <h4>Тренинги</h4>
            </div>
        </div>

        <!-- Second Row -->
        <div class="col-lg-4 feature anim fadeInLeft" data-wow-delay="0.5s">
            <i class="fa fa-expand"></i>
            <div class="content">
                <h4>Мастер-классы</h4>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInUp" data-wow-delay="0.5s">
            <i class="fa fa-bug"></i>
            <div class="content">
                <h4>Лекции</h4>
            </div>
        </div>

        <div class="col-lg-4 feature anim fadeInRight" data-wow-delay="0.5s">
            <i class="fa fa-coffee"></i>
            <div class="content">
                <h4>Психологические Игры</h4>
            </div>
        </div>
        <!-- End of second row -->

    </div>
</section><!-- .feature-list -->

<section class="content-section fixed video blur">
    <span class="shadows"></span>

    <!--<div class="video-wrapper">
        <video id="video1" class="video-js vjs-default-skin" poster="videos/RecordPlayer/poster.jpg" width="1600" height="901" muted="" autoplay="" loop="" preload="">
            <source src="videos/RecordPlayer/RecordPlayer.mp4" type='video/mp4' />
            <source src="videos/RecordPlayer/RecordPlayer.webm" type='video/webm' />
            <source src="videos/RecordPlayer/RecordPlayer.ogv" type='video/ogg' />
        </video>
    </div>--><!-- .video-wrapper -->

    <div class="container anim fadeInUp">
        <i class="fa fa-quote-left"></i>
        <ul class="testimonials" id="testimonials">

            <li class="ms-slide">
                <h3>Избери лучшее, а привычка сделает его приятным и лёгким.</h3>
                <cite><strong>Пифагор</strong></cite>
            </li>

            <li class="ms-slide">
                <h3>Цель психотерапии — сделать людей свободными.</h3>
                <cite><strong>Ролло Мэй</strong></cite>
            </li>

            <li class="ms-slide">
                <h3>Главная жизненная задача человека - дать жизнь самому себе, стать тем, чем он является потенциально. Самый важный плод его усилий - его собственная личность.</h3>
                <cite><strong>Ролло Мэй</strong></cite>
            </li>

            <li class="ms-slide">
                <h3>Жизнь каждого человека есть путь к самому себе, попытка пути, намек на тропу. Ни один человек
                    никогда не был самим собой целиком и полностью; каждый, тем не менее, стремится к этому, один глухо, другой отчетливей, каждый как может.</h3>
                <cite><strong>Эрих Фромм</strong></cite>
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
        <h1><i class="fa fa-pencil"></i>Почему <span>именно мы</span>?</h1>
        <p class="text-align-left margin-left-70">- Только у нас вы найдете гармоничное соединение философии, психологии, телесных практик и творчества.</p>
        <p class="text-align-left margin-left-70">- Мы используем только академические знания, подтвержденные исследованиями и научными трудами ученых в своих областях.</p>
        <p class="text-align-left margin-left-70">- Мы прошли собственный путь развития и становления, и потому можем смело заявить: это возможно!</p>
        <p class="text-align-left margin-left-70">- Мы используем индивидуальный подход к каждому человеку, осознавая, что нет универсальной формулы,
            помогающей всем, но есть уникальный человек, в котором уже есть все ответы. Наша задача – помочь вам найти путь к этим ответам!</p>
        <p class="text-align-left margin-left-70">- Мы точно знаем, что философия делает нас мудрее, психология – выводит из тупика,
            телесные практики улучшают здоровье и учат языку тела, творчество – исцеляет душу</p>
        <p class="text-align-left margin-left-70">- И мы точно знаем, как сделать все это доступным и интересным!</p>
    </div>
</section>

<section class="portfolio">
    <!--<div class="container">
        <div class="filter anim fadeInDown" data-wow-delay="0.55s">
            <ul id="filters">
                <li><a class="btn btn-bordered hot btn-sm" role="button" data-filter="*">All</a></li>
                <li><a class="btn btn-bordered btn-sm" role="button" data-filter=".work">Work</a></li>
                <li><a class="btn btn-bordered btn-sm" role="button" data-filter=".projects">Projects</a></li>
            </ul>
        </div>
    </div>--><!-- container -->

    <div class="gallary">
        <div class="preview">
            <i class="fa fa-spinner fa-spin"></i>
        </div>

        <ul>
            <?php foreach ($events as $event) : ?>
                <li class="work">
                    <a href="<?= $event->cpuUrl ?>" id="desc" data-icon="fa-eye" data-lightbox="image-1">
                        <img src="<?= $event->mainImageUrl ?>" />
                    </a>
                </li>
            <?php endforeach ?>
        </ul>

        <div class="clearfix"></div>
    </div>
</section><!-- portfolio -->

<section class="content-section anim fadeInDown" data-wow-delay="0.25s">
    <div class="container">
        <h1><i class="fa fa-rocket"></i>Наша <span>философия</span></h1>
        <p>Главная идея центра состоит в разностороннем развитии личности с помощью гармоничного
            соединения философии, психологии, телесных практик и творчества. Почему это важно? Потому что чего-то одного, как правило, недостаточно.</p>
        <p>Человек всегда хочет большего. Человек всегда способен на большее. Человек – это всегда большее, чем он есть.
            Одной простой схемы, которая могла бы его описать – не существует. Именно поэтому великие умы всех эпох так упорно пытались постичь эту тайну.
            И оставили нам великое наследие, где можно найти очень разные и, порой, такие нужные для нас откровения… Каждый из нас уникален.
            Условия рождения и воспитания, жизненный опыт и выбор пути, испытания и победы – все это рождает неповторимый рисунок души в каждом из нас.
            И этот рисунок всегда сложнее любого практического подхода. Кто-то любит читать книги, кому-то открывается мир через краски,
            для кого-то истина – в движении, кто-то видит бездонную глубину внутри человека… И все эти пути ведут к одному и тому же:
            к постижению себя и мира. Но разными средствами. И пока мы не попробовали все пути ,сложно судить о невозможности чего-либо.
            Мы знаем: если вам не подошел какой-то путь, возможно, он не ваш. И ему всегда найдется лучшая альтернатива!</p>
    </div>
</section><!-- .content-section -->

<section class="content-section parallax-bg-2 team" data-stellar-background-ratio="0.15">

    <div class="container">
        <!--<div class="col-lg-12 anim fadeInDown">

            <div class="relative">
                <div class="master-slider wrapper" id="teamslider">

                    <div class="ms-slide" data-member-id="1" data-title="Optional Title">
                        <img src="/img/design/blank.png" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">ELLEN JOHN</span>
                            <span class="position">Public Relations</span>
                        </div>
                    </div>

                    <div class="ms-slide" data-member-id="2">
                        <img src="/img/design/blank.png" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">PAUL HOLDER</span>
                            <span class="position">Team Motivator</span>
                        </div>
                    </div>

                    <div class="ms-slide" data-member-id="3">
                        <img src="/img/design/blank.png" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">SARAH SMITH</span>
                            <span class="position">Marketing Director</span>
                        </div>
                    </div>

                    <div class="ms-slide" data-member-id="4">
                        <img src="/img/design/blank.png" data-src="http://placehold.it/300x295/f8c2c5/ffffff" alt="lorem ipsum dolor sit"/>

                        <div class="ms-info">
                            <span class="name">MARK DOE</span>
                            <span class="position">Company CEO</span>
                        </div>
                    </div>

                </div>

                <div class="ms-info" id="staff-info"></div>
                <div class="ms-nav-prev"></div>
                <div class="ms-nav-next"></div>
            </div>

        </div>--><!-- .col-lg-12 -->

        <!--<div class="member-box-wrapper">

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
                </div>

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

                </div><
                <div class="shadow-lg"></div>
            </div>

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
                </div>

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

                </div>

                <div class="shadow-lg"></div>
            </div>

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
                </div>

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

                </div>

                <div class="shadow-lg"></div>
            </div>

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
                </div>

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

                </div>

                <div class="shadow-lg"></div>
            </div>

        </div>-->
    </div><!-- .container -->
</section><!-- .team -->

<?php if (Yii::$app->user->isGuest) : ?>
<section class="content-section anim fadeInDown">
    <div class="container">
        <h1><i class="fa fa-pencil-square-o"></i>Присоединяйтесь <span>к нам</span></h1>
    </div>
</section><!-- .content-section -->

<section class="content-section form contact light">
    <div class="container">

        <span id="message"></span><!-- remove #message to stop floating jQuery messages -->

        <?= $this->render('@themes/site/views/auth/_register-form', ['user' => new models\User()]) ?>
    </div><!-- .container -->

    <span id="message_sent"><i class="fa-check fa"></i></span><!-- jQuery display of giant checkmark -->

</section><!-- .content-section .form -->
<?php endif ?>