<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.03.2016
 * Time: 1:25
 *
 * @var components\View $this
 * @var models\User $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\Cropbox;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'user_form',
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}\n<p>{error}</p></div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <div class="form-group text-center-align" >
        <?= $form->field($model, 'avatar', [
            'template' => "{input}\n<p>{error}",
        ])->widget(Cropbox::className(), [
            'attributeCropInfo' => 'cropInfo',
            'previewImagesUrl' => [$model->avatarUrl],
            'pluginOptions' => [
                'variants' => [
                    [
                        'width' => $model->imgWidth,
                        'height' => $model->imgHeight,
                    ],
                ],
            ],
        ]) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'role')->dropDownList($model->getRolesItems()) ?>

        <?= $form->field($model, 'status')->dropDownList($model->getStatusesItems()) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>

        <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $this->t('Create') : $this->t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>