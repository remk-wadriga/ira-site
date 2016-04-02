<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.04.2016
 * Time: 16:40
 *
 * @var components\View $this
 * @var models\search\PostSearch $model
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>

<ul class="comments-wrapper">
    <li>
        <ul>
        </ul><!-- .comments -->
    </li>
</ul><!-- .comments-wrapper -->

<div class="hide">
    <?php $form = ActiveForm::begin([
        'id' => 'filter_post_form',
        'method' => 'GET',
    ]) ?>
    <?= Html::activeTextInput($model, 'filterType') ?>
    <?php ActiveForm::end(); ?>
</div>
