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

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use models\User;
use dosamigos\fileupload\FileUpload;
use dosamigos\fileupload\FileUploadUI;
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

    <div class="form-group">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'cost')->textInput() ?>

            <?php if (!$model->isNewRecord) : ?>
                <?= $form->field($model, 'profit')->textInput() ?>
            <?php endif ?>

            <?= $form->field($model, 'membersCount')->textInput() ?>

            <?= $form->field($model, 'type')->dropDownList($model->getTypesItems($this->t('Select type'))) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->getStatusesItems()) ?>
        </div>

        <div class="col-lg-6">
            <h4><?= $this->t('Event owner') ?>:</h4>

            <?= $form->field($model, 'hasOwner')->checkbox([
                'class' => 'form-group field-event-hasowner toggle-element',
                'data' => [
                    'target' => '#user_owner_id_field,#user_owner_name_field',
                ],
            ]) ?>

            <div id="user_owner_id_field" class="user-owner-id-field<?= !$model->hasOwner ? ' hide' : '' ?>">
                <?= $form->field($model, 'ownerID')->dropDownList(User::getItems(['role' => [User::ROLE_ADMIN, User::ROLE_TRAINER]], $this->t('Select owner'))) ?>
            </div>
            <div id="user_owner_name_field" class="user-owner-id-field<?= $model->hasOwner ? ' hide' : '' ?>">
                <?= $form->field($model, 'ownerName')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">

        <?= FileUploadUI::widget([
            'model' => $model,
            'attribute' => 'img',
            'url' => ['/admin/api/upload-image', 'modelClass' => $model::className(), 'id' => $model->id],
            'gallery' => true,
        ]) ?>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? $this->t('Create') : $this->t('Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>