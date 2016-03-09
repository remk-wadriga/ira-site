<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:03
 *
 * @var components\View $this
 * @var models\Event $model
 * @var yii\bootstrap\ActiveForm $form
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'owner_id') ?>

    <?= $form->field($model, 'owner_name') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'members_count') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'profit') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'in_main_slider') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>