<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:45
 *
 * @var components\View $this
 * @var models\User $user;
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

$this->title = $this->t('Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-section form contact light">
    <div class="container login-page text-center-align">
        <div class="col-lg-5 anim animated">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="row">
                <?php $form = ActiveForm::begin([
                    'id' => 'login_form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "<span class=\"input-group\">{input}</span>",
                    ],
                ]); ?>

                <?= $form->field($user, 'email')->textInput([
                    'class' => 'lg',
                    'placeholder' => $user->getAttributeLabel('email'),
                    'autofocus' => true,
                ]) ?>

                <?= $form->field($user, 'password')->passwordInput([
                    'class' => 'lg',
                    'placeholder' => $user->getAttributeLabel('password'),
                ]) ?>

                <div class="form-group">
                    <span class="input-group">
                        <?= Html::submitButton($this->t('Login'), ['class' => 'submit', 'name' => 'login-button']) ?>
                    </span>
                </div>

                <p>
                    <?= $this->t('You do not have an account') ?>?
                    <?= Html::a($this->t('Sign up'), ['/site/auth/register']) ?>!
                </p>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>