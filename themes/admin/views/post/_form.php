<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 20:39
 *
 * @var components\View $this
 * @var models\Post $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use bupy7\cropbox\Cropbox;
use skeeks\yii2\ckeditor\CKEditorWidget;
use skeeks\yii2\ckeditor\CKEditorPresets;
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin([
        'id' => 'post_form',
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
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusesItems()) ?>

    <div class="row">
        <?= $form->field($model, 'text', [
            'template' => "<div class=\"col-lg-12\">{input}</div>",
        ])->widget(CKEditorWidget::className(), [
            'options' => ['rows' => 6],
            'preset' => CKEditorPresets::FULL,
        ]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>