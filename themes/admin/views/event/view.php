<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:06
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;
use yii\widgets\DetailView;
use widgets\typeahead\Typeahead;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($this->t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($this->t('Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a($this->t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $this->getConfirmDeleteText(),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php if ($model->mainImage !== null) : ?>
        <p class="text-center-align">
            <?= Html::img($model->mainImage->url, ['class' => 'big-img']) ?>
        </p>
    <?php endif ?>

    <div class="row">
        <div class="col-lg-6">
            <h3><?= $this->t('Info') ?>:</h3>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'ownerName',
                    'description:ntext',
                    'membersCount',
                    'address',
                    'price:number',
                    'profit:number',
                    'cost:number',
                    [
                        'attribute' => 'type',
                        'value' => $model->typeName,
                    ],
                    [
                        'attribute' => 'status',
                        'value' => $model->statusName,
                    ],
                    [
                        'attribute' => 'dateStart',
                        'value' => $this->dateTime($model->dateStart),
                    ],
                ],
            ]) ?>


            <h3><?= $this->t('Tags') ?>:</h3>
            <div class="row">
                <div class="tags-list event-tags-list">
                    <?= Typeahead::widget([
                        'entity' => $model,
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h3><?= $this->t('Recorded users') ?>:</h3>
            <?php if (!empty($model->usersAllRecords)) : ?>
                <table id="registered_users_list" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><?= $this->t('Email') ?></th>
                            <th><?= $this->t('Name') ?></th>
                            <th><?= $this->t('Date') ?></th>
                            <th><?= $this->t('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->usersAllRecords as $record) : ?>
                            <?= $this->render('_registered-user-item', ['record' => $record]) ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
            <?php if (!$model->isNewRecord) : ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> ' . $this->t('Add user'), ['/admin/api/add-user-to-event', 'eventID' => $model->id], [
                    'class' => 'btn btn-success',
                    'onclick' => 'return Admin.registerUserByEventRecord($(this));',
                    'data' => [
                        'form' => '#register_form,#registered_user_form',
                        'after-load' => 'Main.clickToggleElement();',
                        'add' => '#registered_users_list tbody',
                    ],
                ]) ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($model->images)) : ?>
            <h3><?= $this->t('Images') ?>:</h3>
            <p>
                <?php foreach ($model->images as $image) : ?>
                    <?= Html::img($image->url, ['class' => 'small-img']) ?>
                <?php endforeach ?>
            </p>
        <?php endif ?>
    </div>


</div>