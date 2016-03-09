<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:20
 *
 * @var components\View $this
 * @var models\Slide $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use bupy7\cropbox\Cropbox;
?>

<div class="Slide-form">

    <?php $form = ActiveForm::begin([
        'id' => 'slide_form',
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}\n<p>{error}</p></div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <div class="from-group" id="crop_result">

    </div>

    <div class="form-group">
        <?= $form->field($model, 'img', [
            'template' => "{input}\n<p>{error}",
        ])->widget(Cropbox::className(), [
            'attributeCropInfo' => 'cropInfo',
            'previewImagesUrl' => [$model->imgUrl],
            'pluginOptions' => [
                'variants' => [
                    [
                        'width' => $model->imgWidth,
                        'height' => $model->imgHeight,
                    ],
                ],
            ],
        ]) ?>

        <div class="form-group">
            <div class="col-lg-6" >
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'subTitle')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>
                <?= $form->field($model, 'status')->dropDownList($model->getStatusItems(), ['prompt' => '']) ?>
            </div>
            <div class="col-lg-6" >
                <?= $form->field($model, 'addUrl')->checkbox([
                    'class' => 'form-group field-slide-addurl toggle-element',
                    'data' => [
                        'target' => '#slide_url_fields',
                    ],
                ]) ?>
                <div id="slide_url_fields" class="slide-url-fields<?= !$model->addUrl ? ' hide' : '' ?>">
                    <?= $form->field($model, 'linkUrl')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'linkText')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'linkTitle')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $this->t('Create') : $this->t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>