<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 19:50
 *
 * @var components\View $this
 * @var models\User $user
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use bupy7\cropbox\Cropbox;
?>

    <?php $form = ActiveForm::begin([
        'id' => 'register_form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<span class=\"input-group\">{input}</span>",
        ],
    ]); ?>

    <div class="col-lg-5 anim fadeInLeft animated">
        <?= $form->field($user, 'firstName')->textInput([
            'class' => 'lg',
            'placeholder' => $user->getAttributeLabel('firstName'),
            'autofocus' => true,
        ])->label('') ?>

        <?= $form->field($user, 'lastName')->textInput([
            'class' => 'lg',
            'placeholder' => $user->getAttributeLabel('lastName'),
        ])->label('') ?>

        <?= $form->field($user, 'phone')->textInput([
            'class' => 'lg',
            'placeholder' => $user->getAttributeLabel('phone'),
        ])->label('') ?>

        <?= $form->field($user, 'email')->textInput([
            'class' => 'lg',
            'placeholder' => $user->getAttributeLabel('email'),
        ])->label('') ?>

        <?= $form->field($user, 'password')->passwordInput([
            'class' => 'lg',
            'placeholder' => $user->getAttributeLabel('password'),
        ])->label('') ?>

        <?= $form->field($user, 'passwordRepeat')->passwordInput([
            'class' => 'lg',
            'placeholder' => $user->getAttributeLabel('passwordRepeat'),
        ])->label('') ?>
    </div>

    <div class="col-lg-7 anim fadeInRight animated">
        <?= $form->field($user, 'avatar', [
            'template' => "{input}\n<p>{error}",
        ])->widget(Cropbox::className(), [
            'attributeCropInfo' => 'cropInfo',
            'previewImagesUrl' => [$user->avatarUrl],
            'pluginOptions' => [
                'variants' => [
                    [
                        'width' => $user->imgWidth,
                        'height' => $user->imgHeight,
                    ],
                ],
            ],
        ]) ?>
        <span class="input-group">
            <?= Html::submitButton($user->isNewRecord ? $this->t('Register') : $this->t('Update'), ['class' => 'submit', 'name' => 'login-button']) ?>
        </span>
    </div>

<?php ActiveForm::end(); ?>
