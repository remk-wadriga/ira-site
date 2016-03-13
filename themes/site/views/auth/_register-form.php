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

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

    <?php $form = ActiveForm::begin([
        'id' => 'register_form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}\n<p>{error}</p></div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
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
