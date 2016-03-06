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

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
            'template' => "{label}\n<div class=\"col-lg-11\">{input}\n<p>{error}</p></div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <div class="form-group">

        <div class="col-lg-6">
            <?= $form->field($model, 'img')->widget(Cropbox::className(), [
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
            <?= $form->field($model, 'imgAlt')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'linkUrl')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'linkText')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'linkTitle')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusItems(), ['prompt' => '']) ?>
        </div>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $this->t('Create') : $this->t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>