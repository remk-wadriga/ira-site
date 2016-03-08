<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.03.2016
 * Time: 17:55
 *
 * @var components\View $this
 * @var array $items
 * @var string $id
 * @var string $class
 * @var string $navbarClass
 * @var string $logo
 */

use yii\bootstrap\Html;
?>

<span id="<?= $id ?>"></span><!-- place before navigation bar-->
<div class="<?= $class ?>">
    <nav class="<?= $navbarClass ?>" role="navigation">

        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                    <i class="fa fa-bars"></i>
                </button>
                <?= Html::a(Html::img($logo), Yii::$app->homeUrl, ['class' => 'navbar-brand']) ?>
                <ul class="mini"></ul><!-- mobile navigation -->
            </div><!-- .navbar-header -->

            <div class="collapse navbar-collapse">
                <div class="right">

                    <ul class="nav navbar-nav">
                        <!-- Render menu items -->
                        <?php foreach ($items as $item) : ?>
                            <?= $item ?>
                        <?php endforeach ?>
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
                    <input type="text" name="s" placeholder="<?= $this->t('Type then press enter...') ?>" />
                    <button type="submit" class="hidden btn btn-default"><?= $this->t('Submit') ?></button>
                </form>
            </div>
        </div><!-- search-field -->
    </nav>
</div>
