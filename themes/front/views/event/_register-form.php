<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 20:41
 *
 * @var components\View $this
 * @var models\EventUser $model
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form =ActiveForm::begin([
    'id' => 'register_to_event_form',
]) ?>

<div class="col-lg-5 anim fadeInLeft">

    <span class="input-group">
        <i class="fa fa-envelope"></i>
        <?= Html::activeTextInput($model, 'email', [
            'class' => 'lg',
            'placeholder' => $model->getAttributeLabel('email'),
        ]) ?>
    </span><!-- .input-group -->

    <span class="input-group">
        <i class="fa fa-user"></i>
        <?= Html::activeTextInput($model, 'name', [
            'class' => 'lg',
            'placeholder' => $model->getAttributeLabel('name'),
        ]) ?>
    </span><!-- .input-group -->

    <span class="input-group">
        <i class="fa fa-mobile"></i>
        <?= Html::activeTextInput($model, 'phone', [
            'class' => 'lg',
            'placeholder' => $model->getAttributeLabel('phone'),
        ]) ?>
    </span><!-- .input-group -->

</div><!-- .col-5 -->

<div class="col-lg-7 anim fadeInRight">
    <span class="input-group">
        <?= Html::activeTextarea($model, 'comment', [
            'class' => 'lg',
            'placeholder' => $model->getAttributeLabel('comment'),
        ]) ?>
    </span><!-- .input-group -->

    <span class="input-group">
        <?= Html::submitButton($this->t('Register'), ['class' => 'submit']) ?>
    </span><!-- .input-group -->
</div>

<?php if (Yii::$app->user->isGuest) : ?>
    <span class="input-group">
        <?= Html::activeCheckbox($model, 'registerInSite', [
            'class' => 'lg toggle-element',
            'data' => [
                'target' => '#register_in_site_block',
            ],
        ]) ?>
    </span>

    <div id="register_in_site_block" class="register-in-site-block<?= !$model->registerInSite ? ' hide' : '' ?>">
        <div class="col-lg-6 anim fadeInLeft">
        <span class="input-group">
            <?= Html::activePasswordInput($model, 'password', [
                'class' => 'lg',
                'placeholder' => $model->getAttributeLabel('password'),
            ]) ?>
        </span>
        </div>

        <div class="col-lg-6 anim fadeInRight">
       <span class="input-group">
            <?= Html::activePasswordInput($model, 'passwordRepeat', [
                'class' => 'lg',
                'placeholder' => $model->getAttributeLabel('passwordRepeat'),
            ]) ?>
        </span>
        </div>
    </div>

<?php endif ?>

<?php ActiveForm::end() ?>
