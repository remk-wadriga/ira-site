<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 0:18
 *
 * @var components\View $this
 * @var string $content
 */

use yii\widgets\Breadcrumbs;
?>

<?php if (isset($this->params['breadcrumbs']) && !empty($this->params['breadcrumbs'])) : ?>
<section class="slug parallax-slug-5" data-stellar-background-ratio="0">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="anim fadeInDown"><?= $this->title ?></h1>
                    <p class="anim fadeInDown" data-wow-delay=".32s"><?= $this->subtitle ?></p>

                    <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => $this->t('Home'), 'url' => Yii::$app->homeUrl],
                        'links' => $this->params['breadcrumbs'],
                        'tag' => 'span',
                        'itemTemplate' => '{link}<i class="fa fa-angle-right"></i>',
                        'activeItemTemplate' => '{link}',
                        'options' => [
                            'class' => 'anim fadeInDown',
                            'data' => [
                                'wow-delay' => '.42s',
                            ],
                        ],
                    ]) ?>
                </div><!-- .col-lg-12 -->
            </div><!-- .row -->
        </div>
    </div><!-- .overlay -->
</section>
<?php endif ?>

<?= $content ?>
