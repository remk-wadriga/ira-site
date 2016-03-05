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

use yii\helpers\Html;
use widgets\Naw;
?>

<div id="templatemo_header_wrapper">
    <div id="templatemo_header">
        <div id="site_title"><a href="<?= Yii::$app->homeUrl ?>"><?= $this->title ?></a></div>
        <div id="templatemo_menu" class="ddsmoothmenu">
            <?= Naw::widget([
                'items' => $menuItems,
            ]) ?>
        </div>

        <div class="clear"></div>

        <div id="templatemo_slider_wrapper">
            <div id="templatemo_slider">
                <div id="carousel">
                    <div class="panel">

                        <div class="details_wrapper">

                            <div class="details">

                                <div class="detail">
                                    <h2><a href="#">Integer pellentesque velit</a></h2>
                                    <p>Fusce faucibus hendrerit cursus. Aenean faucibus, sapien quis vestibulum eleifend, libero ipsum pulvinar risus, quis dapibus arcu velit vitae erat.</p>
                                    <a href="#" title="Read more" class="more">Read more</a>
                                </div><!-- /detail -->

                                <div class="detail">
                                    <h2><a href="#">Donec lectus massa</a></h2>
                                    <p>Vestibulum sit amet hendrerit nisi. Nulla bibendum neque eget est condimentum ornare vestibulum nunc cursus. Lorem ipsum dolor sit amet elit.</p>
                                    <a href="#" title="Read more" class="more">Read more</a>
                                </div><!-- /detail -->

                                <div class="detail">
                                    <h2><a href="#">Pellentesque tempor velit</a></h2>
                                    <p>Aliquam consequat, diam sit amet iaculis ultrices, diam erat faucibus dolor, libero vel mi. Maecenas dignissim feugiat felis sed dictum.</p>
                                    <a href="#" title="Read more" class="more">Read more</a>
                                </div><!-- /detail -->

                            </div><!-- /details -->

                        </div><!-- /details_wrapper -->

                        <div class="paging">
                            <div id="numbers"></div>
                            <a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
                            <a href="javascript:void(0);" class="next" title="Next">Next</a>
                        </div><!-- /paging -->

                        <a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
                        <a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>

                    </div><!-- /panel -->

                    <div id="slider-image-frame">
                        <div class="backgrounds">

                            <div class="item item_1">
                                <?= Html::img('@web/img/slider/01.jpg', ['alt' => $this->t('Slider 01')]) ?>
                            </div><!-- /item -->

                            <div class="item item_2">
                                <?= Html::img('@web/img/slider/02.jpg', ['alt' => $this->t('Slider 02')]) ?>
                            </div><!-- /item -->

                            <div class="item item_3">
                                <?= Html::img('@web/img/slider/03.jpg', ['alt' => $this->t('Slider 03')]) ?>
                            </div><!-- /item -->

                        </div><!-- /backgrounds -->
                    </div>
                </div>
            </div> <!-- END of templatemo_slider -->
        </div> <!-- END of templatemo_slider_wrapper -->
    </div> <!-- END of header -->
</div> <!-- END of header wrapper -->
