<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:20
 *
 * @var components\View $this
 * @var models\search\SlideSearch $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="Slide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'linkUrl') ?>

    <?= $form->field($model, 'linkText') ?>

    <?php // echo $form->field($model, 'link_title') ?>

    <?php // echo $form->field($model, 'img_url') ?>

    <?php // echo $form->field($model, 'img_file') ?>

    <?php // echo $form->field($model, 'img_alt') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>