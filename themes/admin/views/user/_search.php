<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.03.2016
 * Time: 1:26
 *
 * @var components\View $this
 * @var models\search\UserSearch $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'date_register') ?>

    <div class="form-group">
        <?= Html::submitButton($this->t('Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton($this->t('Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>