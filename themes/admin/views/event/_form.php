<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:02
 *
 * @var components\View $this
 * @var models\Event $model
 * @var yii\bootstrap\ActiveForm $form
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use models\User;
use dosamigos\fileupload\FileUploadUI;
use bupy7\cropbox\Cropbox;
use yii\redactor\widgets\Redactor;
use dosamigos\multiselect\MultiSelect;
?>

<div class="event-form">

    <?php $form = ActiveForm::begin([
        'id' => 'event_form',
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
            'previewImagesUrl' => [$model->getMainIMageUrl()],
            'pluginOptions' => [
                'variants' => [
                    [
                        'width' => $model->imgWidth,
                        'height' => $model->imgHeight,
                    ],
                ],
            ],
        ]) ?>

        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'cost')->textInput() ?>

            <?php if (!$model->isNewRecord) : ?>
                <?= $form->field($model, 'profit')->textInput() ?>
            <?php endif ?>

            <?= $form->field($model, 'membersCount')->textInput() ?>

            <?= $form->field($model, 'citation')->textarea(['rows' => 7]) ?>
        </div>

        <div class="col-lg-6">

            <?= $form->field($model, 'trainersIDs')->widget(MultiSelect::className(), [
                'data' => User::getItems(['role' => [User::ROLE_TRAINER, User::ROLE_ADMIN]]),
                'options' => ['multiple' => 'multiple'],
                'clientOptions' => [
                    'numberDisplayed' => 3,
                    'nonSelectedText' => $this->t('Trainers are not selected'),
                    'nSelectedText' => $this->t('trainers selected'),
                ],
            ]) ?>

            <?= $form->field($model, 'type')->dropDownList($model->getTypesItems($this->t('Select type'))) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->getStatusesItems()) ?>

            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'description', [
                'template' => "<div class=\"col-lg-12\">{input}</div>",
            ])->widget(Redactor::className(), ['clientOptions' => [
                'plugins' => ['clips', 'fontcolor', 'imagemanager', 'inlinestyle'],
            ]]) ?>
        </div>
    </div>

    <div class="form-group">
        <div id="event_files_block" class="event-files-block file-upload-files-block">
            <?= FileUploadUI::widget([
                'model' => $model,
                'attribute' => 'img',
                'url' => ['/admin/api/upload-image', 'modelClass' => $model::className(), 'id' => $model->id],
                'load' => true,
                'clientOptions' => [
                    'previewMaxWidth' => 50,
                ],
            ]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $this->t('Create') : $this->t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>