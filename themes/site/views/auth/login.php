<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 03.03.2016
 * Time: 20:45
 *
 * @var components\View $this
 * @var models\User;
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $this->t('Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="register-page">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $this->t('Please fill out the following fields to login') ?>:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login_form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($user, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($user, 'password')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($this->t('Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>