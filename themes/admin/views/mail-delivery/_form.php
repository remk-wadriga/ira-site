<?php
/**
 * @var components\View $this
 * @var models\MailDelivery $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\Cropbox;
use yii\redactor\widgets\Redactor;
?>

<div class="mail-delivery-form">

    <?php $form = ActiveForm::begin([
        'id' => 'mail_delivery_form',
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}\n<p>{error}</p></div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <div class="form-group text-center-align">
        <?= $form->field($model, 'img', [
            'template' => "{input}\n<p>{error}",
        ])->widget(Cropbox::className(), [
            'attributeCropInfo' => 'cropInfo',
            'previewImagesUrl' => [$model->getImgUrl()],
            'pluginOptions' => [
                'variants' => [
                    [
                        'width' => $model->imgWidth,
                        'height' => $model->imgHeight,
                    ],
                ],
            ],
        ]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'message', [
            'template' => "<div class=\"col-lg-12\">{input}</div>",
        ])->widget(Redactor::className(), ['clientOptions' => [
            'plugins' => ['clips', 'fontcolor', 'imagemanager', 'inlinestyle'],
        ]]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $this->t('Create') : $this->t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
