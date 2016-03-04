<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 18:20
 *
 * @var components\View $this
 * @var models\User $user
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $this->t('Register');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-page">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $this->t('Please fill out the following fields to register') ?>:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'register_form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($user, 'firstName')->textInput(['autofocus' => true]) ?>

    <?= $form->field($user, 'lastName') ?>

    <?= $form->field($user, 'phone') ?>

    <?= $form->field($user, 'email') ?>

    <?= $form->field($user, 'password')->passwordInput() ?>

    <?= $form->field($user, 'passwordRepeat')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($this->t('Register'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>


