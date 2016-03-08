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
use widgets\slider\Slider;
use widgets\nav\NavBar;
?>
<?php if (isset($this->params['showMainSlider']) && $this->params['showMainSlider']) : ?>
    <div class="slider-wrapper">
        <?= Slider::widget([
            'modelClass' => Slide::className(),
        ]) ?>

        <a href="#firstSection"><i class="fa fa-chevron-down" id="go-down"></i></a>
    </div><!-- end of slider-wrapper -->
<?php endif ?>

<?= NavBar::widget([
    'items' => $menuItems,
]) ?>